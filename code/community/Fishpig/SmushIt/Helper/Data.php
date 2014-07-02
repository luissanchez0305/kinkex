<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Helper_Data extends Mage_Core_Helper_Data
{		
	/**
	 * Smush multiple images. This can be called via the Shell
	 *
	 * @return $this
	 */
	public function autoSmushImages($limit = 5)
	{
		$lockFile = Mage::getBaseDir('var') . DS . 'locks' . DS . 'smushit.lock';
		
		if (is_file($lockFile)) {
			return $this->log('Lock file already exists.');
		}
		
		if (!is_writable(dirname($lockFile))) {
			return $this->log('Cannot create lock file.');
		}
		
		@touch($lockFile);

		$images = Mage::getResourceModel('smushit/image_collection')
			->addIsSmushedFilter(0)
			->setPageSize($limit)
			->setCurPage(1)
			->setRandomOrder()
			->load();
		
		$this->log($this->__('Smushing %d images.', count($images)));

		foreach($images as $image) {
			try {
				$image->smush();
			}
			catch (Exception $e) {
				$this->log($e->getMessage());
			}
		}
		
		@unlink($lockFile);
		
		return $this;
	}
	
	/**
	 * Log a message to var/log/smushit.log
	 *
	 * @param string $msg
	 * @return $this
	 */
	public function log($msg)
	{
		Mage::log($msg, null, 'smushit.log', true);
		
		return $this;
	}
}

