<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Image_Type_Catalog_Category extends Fishpig_SmushIt_Model_Image_Type_Catalog_Abstract
{
	/**
	 * Get the image type code
	 *
	 * @return string
	 */
	public function getType()
	{
		return 'catalog_category';
	}
	
	/**
	 * Get the local file for catalog_product images
	 *
	 * @param Fishpig_SmushIt_Model_Image $image
	 * @return string|false
	 */	
	public function getLocalFile(Fishpig_SmushIt_Model_Image $image)
	{
		if ($image->getValue()) {
			$localFile = $this->getDefaultDir() . DS . $image->getValue();

			if (is_file($localFile)) {
				return $localFile;
			}
		}
		
		return false;
	}
	
	/**
	 * Retrieve the SQL used to get the catalog_product images
	 *
	 * @return Varien_Db_Select
	 */
	public function getCollectionSql()
	{
		$imageAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_category', 'image');

		return parent::getCollectionSql()->where('attribute_id=?', $imageAttribute->getId());
	}
	
	/**
	 * Get the default image directory
	 *
	 * @return string
	 */
	public function getDefaultDir()
	{
		return Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category';
	}
	
	/**
	 * Get the default image URL
	 *
	 * @return string
	 */
	public function getDefaultUrl()
	{
		return Mage::getBaseUrl('media') . 'catalog/category';
	}
}
