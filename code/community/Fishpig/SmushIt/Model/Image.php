<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Image extends Mage_Core_Model_Abstract
{	
	/**
	 * Init the entity type
	 *
	 */
	public function _construct()
	{
		$this->_init('smushit/image');
	}
	
	/**
	 * Get the image type
	 *
	 * @return string
	 */
	public function getType()
	{
		if (!$this->hasType()) {
			$this->setType($this->getResource()->getTypeById($this->getTypeId()));
		}
		
		return $this->_getData('type');
	}
	
	/**
	 * Determine whether the image has already been smushed
	 *
	 * @return bool
	 */
	public function isSmushed()
	{
		return (int)$this->_getData('is_smushed') === 1;
	}
	
	/**
	 * Smush an image
	 *
	 * @return bool
	 */
	public function smush()
	{
		if ($this->getId() && $this->getValue()) {
			return $this->getResource()->smush($this);
		}
		
		return false;
	}
	
	/**
	 * Smush an image
	 *
	 * @return bool
	 */
	public function revert()
	{
		if ($this->getId() && $this->getValue()) {
			return $this->getResource()->revert($this);
		}
		
		return false;
	}
	
	/**
	 * Get the image URL
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->getTypeModel()->getUrl($this);
	}

	/**
	 * Get the image path and filename
	 *
	 * @return string
	 */
	public function getLocalFile()
	{
		if (!$this->hasLocalFile()) {
			$this->setLocalFile($this->getTypeModel()->getLocalFile($this));
		}
		
		return $this->_getData('local_file');
	}

	/**
	 * Retrieve the Smush target file
	 *
	 * @return string
	 */
	public function getSmushedFile()
	{
		return $this->getTypeModel()->getSmushedFile($this);
	}
	
	/**
	 * Determine whether the object is new
	 * This is required to correctly save the result to the DB
	 *
	 * @param bool $flag = null
	 * @return bool
	 */
	public function isObjectNew($flag=null)
	{
		return (bool)$this->getIsNew();
	}
	
	/**
	 * Get the type model
	 *
	 * @return Fishpig_SmushIt_Model_Image_Type_Abstract
	 */
	public function getTypeModel()
	{
		if (!$this->hasTypeModel()) {
			$this->setTypeModel(Mage::getSingleton('smushit/image_type_' . $this->getType()));
		}
		
		return $this->_getData('type_model');
	}
}