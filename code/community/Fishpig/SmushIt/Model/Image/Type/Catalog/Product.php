<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Image_Type_Catalog_Product extends Fishpig_SmushIt_Model_Image_Type_Catalog_Abstract
{
	/**
	 * Get the image type code
	 *
	 * @return string
	 */
	public function getType()
	{
		return 'catalog_product';
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
			$localFile = $this->getDefaultDir() . $image->getValue();
			
			if (is_file($localFile)) {
				return $localFile;
			}
		}
		
		return false;
	}

	/**
	 * Retrieve the backup file
	 *
	 * @return string
	 */
	public function getSmushedFile(Fishpig_SmushIt_Model_Image $image)
	{
		$localFile = basename($image->getLocalFile());

		return $this->getBackupDir($image) . $localFile[0] . '/' . $localFile[1] . '/' . $localFile;
	}
		
	/**
	 * Get the default image directory
	 *
	 * @return string
	 */
	public function getDefaultDir()
	{
		return Mage::getBaseDir('media') . DS . 'catalog' . DS . 'product';
	}
	
	/**
	 * Get the default image URL
	 *
	 * @return string
	 */
	public function getDefaultUrl()
	{
		return Mage::getBaseUrl('media') . 'catalog/product';
	}
}
