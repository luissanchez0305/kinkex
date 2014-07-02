<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmartTabs
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

	$file = Mage::getBaseDir() . DS . implode(DS, array('app', 'code', 'core', 'Mage', 'Core', 'Model', 'Resource', 'Db', 'Collection', 'Abstract.php'));
	
	if (is_file($file)) {
		abstract class Fishpig_SmushIt_Model_Resource_Image_Collection_Hack extends Mage_Core_Model_Resource_Db_Collection_Abstract {}
	}
	else {
		abstract class Fishpig_SmushIt_Model_Resource_Image_Collection_Hack extends Mage_Core_Model_Mysql4_Collection_Abstract {}
	}
	
class Fishpig_SmushIt_Model_Resource_Image_Collection extends Fishpig_SmushIt_Model_Resource_Image_Collection_Hack
{
	/**
	 * Init the entity type
	 *
	 */
	public function _construct()
	{
		$this->_init('smushit/image');

		$this->_map['fields']['image_id'] = 'main_table.image_id';
		$this->_map['fields']['is_smushed'] = Fishpig_SmushIt_Model_Resource_Image::SQL_MAP_IS_SMUSHED;
		$this->_map['fields']['is_new'] = Fishpig_SmushIt_Model_Resource_Image::SQL_MAP_IS_NEW;
	}
	
	/**
	 * Initialise the select object
	 *
	 * @return $this
	 */
	protected function _initSelect()
	{
		$this->_select = $this->getResource()->getLoadSelectObject();
		
		return $this;
	}
	
	/**
	 * Filter the images by images that are smushed or not
	 *
	 * @param int $isSmushed = 1
	 * @return $this
	 */
	public function addIsSmushedFilter($isSmushed = 1)
	{
		return $this->addFieldToFilter('is_smushed', $isSmushed);
	}

	/**
	 * Randomise the order of the images
	 *
	 * @return $this
	 */	
	public function setRandomOrder()
	{
		$this->getSelect()->order('RAND() ASC');
		
		return $this;
	}
}