<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Catalog_Product_Image extends Mage_Catalog_Model_Product_Image
{
	const NO_SELECTION = 'no_selection';
	
	/**
	 * Set the base file to be used for product images
	 *
	 * @param string $file
	 * @return $this
	 */
	public function setBaseFile($file)
	{
		parent::setBaseFile($file);

		// Ensure $file starts with DS as some custom images may not		
		$file = DS . ltrim($file, DS);

		$type = Mage::getSingleton('smushit/image_type_catalog_product');

		if (strpos($file, $type->getDefaultDir()) !== true) {
			$file = $type->getDefaultDir() . $file;
		}

		$baseFile = $type->getSmushedImageFromFile($file);;
		
		if (substr($baseFile, -strlen(self::NO_SELECTION)) === self::NO_SELECTION) {
			return $this;
		}

		if ($baseFile !== $this->_baseFile) {
			if (@exif_imagetype($baseFile) === false) {
				return $this;
			}

			$this->_baseFile = $baseFile;
			
			$base = dirname(dirname(dirname($this->_newFile)));
			$hash = trim(substr($base, strrpos($base, '/')), '/');

			$this->_newFile = dirname(str_replace($hash, 'smushed_' . $hash, $this->_newFile)) . DS . basename($this->_baseFile);
		}

		return $this;	
	}
}
