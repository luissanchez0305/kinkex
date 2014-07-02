<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Core_Design_Package extends Mage_Core_Model_Design_Package
{
	/**
	 * Check whether Smushed image exists
	 *
	 * @param string $file = null
	 * @param array $params = array
	 * @return string
	 */
	public function getSkinUrl($file = null, array $params = array())
	{
		$type = Mage::getSingleton('smushit/image_type_skin');

		return $type->getSmushedImageFromUrl(
			parent::getSkinUrl($file, $params)
		);
	}
}
