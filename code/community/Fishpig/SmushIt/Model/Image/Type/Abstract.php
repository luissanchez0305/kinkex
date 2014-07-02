<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

abstract class Fishpig_SmushIt_Model_Image_Type_Abstract extends Mage_Core_Model_Abstract
{
	/**
	 * Get the image type code
	 *
	 * @return string
	 */
	abstract public function getType();
	
	/**
	 * Retrieve the local file
	 *
	 * @return string
	 */
	abstract public function getLocalFile(Fishpig_SmushIt_Model_Image $image);
	
	/**
	 * Get the image URL
	 *
	 * @param Fishpig_SmushIt_Model_Image $image
	 * @return false|string
	 */
	abstract public function getUrl(Fishpig_SmushIt_Model_Image $image);
	
	/**
	 * Get the default image directory type
	 *
	 * @return string
	 */
	abstract public function getDefaultDir();

	/**
	 * Get the default image directory type
	 *
	 * @return string
	 */
	abstract public function getDefaultUrl();
	
	/**
	 * Retrieve the SQL used to get the catalog_product images
	 *
	 * @return Varien_Db_Select
	 */
	public function getCollectionSql()
	{
		return $this->_getReadAdapter()->select()
			->from(array($this->getType() => $this->getMainTable()), '')
			->columns(array(
				'image_id' => "(CONCAT('" . $this->getType() . "_', value_id))",
				'type' => new Zend_Db_Expr("'" . $this->getType() . "'"),
				'value',
			));
	}

	/**
	 * Retrieve the backup file
	 *
	 * @return string
	 */
	public function getSmushedFile(Fishpig_SmushIt_Model_Image $image)
	{
		return $this->getBackupDir() . basename($image->getLocalFile());
	}

	/**
	 * Check whether a file has been smushed and if it has, retun the smushed path instead
	 *
	 * @param string $localFile
	 * @return string
	 */
	public function getSmushedImageFromFile($localFile)
	{
		if (strpos($localFile, $this->getDefaultDir()) === 0) {
			$smushedFile = $this->getBackupDir() . ltrim(substr($localFile, strlen($this->getDefaultDir())), DS);

			if (is_file($smushedFile)) {
				return $smushedFile;
			}
		}
		
		return $localFile;
	}
	
	/**
	 * Check whether a file has been smushed and if it has, retun the smushed path instead
	 *
	 * @param string $localFile
	 * @return string
	 */
	public function getSmushedImageFromUrl($localFile)
	{
		if (strpos($localFile, $this->getDefaultUrl()) === 0) {
			$file = ltrim(substr($localFile, strlen($this->getDefaultUrl())), '/');
			
			if (is_file($this->getBackupDir() . $file)) {
				return $this->getBackupUrl() . $file;
			}
		}
		
		return $localFile;
	}

	/**
	 * Retrieve the backup location
	 *
	 * @return string
	 */
	public function getBackupDir()
	{
		return Mage::getBaseDir('media') . DS . 'smushit' . DS . $this->getType() . DS;
	}
	
	/**
	 * Get the URL to the backup folder
	 *
	 * @return string
	 */
	public function getBackupUrl()
	{
		return Mage::getBaseUrl('media') . 'smushit/' . $this->getType() . '/';
	}
	
	/**
	 * Get the image type table
	 *
	 * @return string
	 */
	public function getMainTable()
	{
		return $this->getTable('smushit/image_type_' . $this->getType());
	}
	
	/**
	 * Get the database read connection
	 *
	 * @return Magento_Db_Adapter_Pdo_Mysql
	 */
	protected function _getReadAdapter()
	{
		return Mage::getSingleton('core/resource')->getConnection('core_read');
	}
	
	/**
	 * Get the database write connection
	 *
	 * @return Magento_Db_Adapter_Pdo_Mysql
	 */
	protected function _getWriteAdapter()
	{
		return Mage::getSingleton('core/resource')->getConnection('core_write');
	}
	
	/**
	 * Convert an entity name to a full database table name
	 *
	 * @param string $entity
	 * @return string
	 */
	public function getTable($entity)
	{
		return Mage::getSingleton('core/resource')->getTableName($entity);
	}
}
