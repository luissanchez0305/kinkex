<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

abstract class Fishpig_SmushIt_Model_Image_Type_Catalog_Abstract extends Fishpig_SmushIt_Model_Image_Type_Abstract
{
	/**
	 * Get the URL for catalog_product images
	 *
	 * @param Fishpig_SmushIt_Model_Image $image
	 * @return string|false
	 */
	public function getUrl(Fishpig_SmushIt_Model_Image $image)
	{
		if ($image->getLocalFile()) {
			return $this->getDefaultUrl() . '/' . $image->getValue();
		}
		
		return false;
	}
}

