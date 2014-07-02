<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

	$file = Mage::getBaseDir() . DS . implode(DS, array('app', 'code', 'core', 'Mage', 'Core', 'Model', 'Resource', 'Db', 'Abstract.php'));
	
	if (is_file($file)) {
		abstract class Fishpig_SmushIt_Model_Resource_Image_Hack extends Mage_Core_Model_Resource_Db_Abstract {}
	}
	else {
		abstract class Fishpig_SmushIt_Model_Resource_Image_Hack extends Mage_Core_Model_Mysql4_Abstract {}
	}
	
class Fishpig_SmushIt_Model_Resource_Image extends Fishpig_SmushIt_Model_Resource_Image_Hack
{
	/**
	 * Constant image type ID's
	 *
	 * @var const int
	 */
	const IMAGE_TYPE_ID_CATALOG_PRODUCT = 1;
	const IMAGE_TYPE_ID_CATALOG_CATEGORY = 2;
#	const IMAGE_TYPE_ID_SKIN = 3;
	
	/**
	 * SQL Mappins
	 *
	 * @var const string
	 */
	const SQL_MAP_IS_SMUSHED = 'IF(_smushed.smushed_at > 0, 1, 0)';
	const SQL_MAP_IS_NEW = 'IF(_smushed.image_id IS NULL, 1, 0)';

	/**
	 * Internal vars required for the odd model employed
	 *
	 * @var bool
	 */
	protected $_useIsObjectNew = true;
	protected $_isPkAutoIncrement = false;

	/**
	 * Init the entity type
	 *
	 */
	public function _construct()
	{
		$this->_init('smushit/image', 'image_id');
	}

	/**
	 * Retrieve the SQL required to load a single image
	 *
	 * @param   string $field
	 * @param   mixed $value
	 * @return  Zend_Db_Select
	*/
	protected function _getLoadSelect($field, $value, $object)
	{
		return $this->getLoadSelectObject()
			->where('main_table.' . $field . '=?', $value)
			->limit(1);
	}
	
	/**
	 * Retrieve the load SQL.
	 * This is used by single model's and collections
	 *
	 * @return Varien_Db_Select
	 */
	public function getLoadSelectObject()
	{
		if ($types = $this->getImageTypes()) {
			$queries = array();
			
			foreach($types as $typeId => $type) {
				$typeModel = Mage::getSingleton('smushit/image_type_' . $type);

				if ($typeModel && ($query = $typeModel->getCollectionSql())) {
					$queries[] = (string)$query;
				}
			}
			
			if (count($queries) > 0) {
				$sql = (string)$this->_getReadAdapter()->select()->union($queries);
				
				$select = $this->_getReadAdapter()
					->select()
					->from(array('main_table' => new Zend_Db_Expr('(' . $sql . ')')));
	
				$select->joinLeft(
					array('_smushed' => $this->getMainTable()),
					'_smushed.image_id=main_table.image_id',
					array(
						'smushed_at',
						'percentage_saved',
						'is_smushed' => self::SQL_MAP_IS_SMUSHED,
						'is_new' => self::SQL_MAP_IS_NEW,
					)
				);

				return $select;
			}
		}
		
		return false;
	}
	
	/**
	 * Reset the model after saving
	 * This allows the virtual columns to be reset via the SQL
	 *
	 * @param Mage_Core_Model_Abstract $object
	 * @return $this
	 */
	protected function _afterSave(Mage_Core_Model_Abstract $object)
	{
		return parent::_afterSave(
			$object->load($object->getId())
		);
	}
	
	/**
	 * Retrieve the image type data
	 *
	 * @return array
	 */
	public function getImageTypes()
	{
		return array(
			self::IMAGE_TYPE_ID_CATALOG_PRODUCT => 'catalog_product',
			self::IMAGE_TYPE_ID_CATALOG_CATEGORY => 'catalog_category',
#			self::IMAGE_TYPE_ID_SKIN=> 'skin',
		);
	}
	
	/**
	 * Retrieve the image type labels
	 *
	 * @return array
	 */
	public function getImageTypeLabels()
	{
		return array(
			'catalog_product' => Mage::helper('catalog')->__('Catalog Product'),
			'catalog_category' => Mage::helper('catalog')->__('Catalog Category'),
#			'skin' => Mage::helper('core')->__('Skin'),
		);
	}
	
	/**
	 * Get an image type by ID
	 *
	 * @param int $typeId
	 * @return false|string
	 */
	public function getTypeById($typeId)
	{
		$types = $this->getImageTypes();
		
		return isset($types[$typeId]) ? $types[$typeId] : false;
	}

	/**
	 * Get an image label by type
	 *
	 * @param string $type
	 * @return false|string
	 */	
	public function getLabelByType($type)
	{
		$labels = $this->getImageTypeLabels();
		
		return isset($labels[$type]) ? $labels[$type] : false;
	}

	/**
	 * Smush the image defined in $image
	 *
	 * @param Fishpig_Smushit_Model_Image $image
	 * @return bool
	 */
	public function smush(Fishpig_Smushit_Model_Image $image)
	{
		$localFile = $image->getLocalFile();
		$smushedFile = $image->getSmushedFile();

		if (!$this->_createPath(dirname($smushedFile))) {
			throw new Exception('The Smush.it directory is not writable.');
		}

		if (!is_file($localFile)) {
			throw new Exception('The image does not exist on the server.');
		}
		
		try {
			if (($result = $this->_getApi()->smush($image->getUrl())) === false) {
				throw new Exception('Unable to smush image.');
			}
	
			$optimizedImage = $this->_getApi()->downloadImage($result->getDest());
			
			if (!$optimizedImage) {
				throw new Exception('Unable to download optimized image from Smush.it');
			}
			
			@file_put_contents($smushedFile, $optimizedImage);
	
			if (!is_file($smushedFile)) {
				throw new Exception('Unable to save the Smushed image.');
			}
			
			if (@exif_imagetype($smushedFile) === false) {
				@unlink($smushedFile);
				throw new Exception('Downloaded image is invalid.');
			}
		}
		catch (Exception $e) {
			if ($e->getCode() !== Fishpig_SmushIt_Helper_Api::SMUSHIT_EXCEPTION_NO_SAVINGS) {
				throw $e;
			}
			
			$result = new Varien_Object(array(
				'percent' => 0,
			));
		}
		
		try {
			$image->setPercentageSaved($result->getPercent());
			$image->setSmushedAt(now());
			$image->save();
		}
		catch (Exception $e) {
			@unlink($smushedFile);
			
			throw $e;
		}
	
		return true;
	}
	
	public function revert(Fishpig_SmushIt_Model_Image $image)
	{
		$smushedFile = $image->getSmushedFile();

		if (is_file($smushedFile)) {
			@unlink($smushedFile);
		}
		
		$image->delete();

		if (is_file($smushedFile)) {
			throw new Exception(Mage::helper('core')->__('Unable to delete smushed image. Try deleting the file manually (%s)', $smushedFile));
		}
		
		return $this;
	}

	/**
	 * Get the API class (helper) file
	 *
	 * @return Fishpig_SmushIt_Helper_Image
	 */
	protected function _getApi()
	{
		return Mage::helper('smushit/api');
	}
	
	/**
	 * Create the path in $path
	 *
	 * @param string $path
	 * @return bool
	 */
	protected function _createPath($path)
	{
		if (is_dir($path)) {
			return true;
		}

		$baseDir = Mage::getBaseDir('media');
		$relativePath = explode(DS, trim(substr($path, strlen($baseDir)), DS));
		$pathStr = '';

		foreach($relativePath as $dir) {
			$pathStr .= DS . $dir;
			$absolutePath = $baseDir . $pathStr;

			if (!is_dir($absolutePath)) {
				@mkdir($absolutePath);
				
				if (!is_dir($absolutePath)) {
					return false;
				}
			}
		}

		return true;
	}
}
