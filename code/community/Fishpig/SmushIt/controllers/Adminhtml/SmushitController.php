<?php
/**
 * @category    Fishpig
 * @package    Fishpig_AttributeSplashPro
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Adminhtml_SmushitController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * Display the Smush.it image grid
	 *
	 * @return void
	 */
	public function indexAction()
	{
		$this->loadLayout();
		$this->_title('Smush.it');
		$this->renderLayout();
	}
	
	/**
	 * Smush an image
	 *
	 * @return void
	 */
	public function smushAction()
	{
		$image = Mage::getModel('smushit/image')->load($this->getRequest()->getParam('id'));

		if ($image->getId()) {
			try {
				if (($result = $image->smush()) === false) {
					throw new Exception('There was an error smushing this image.');
				}
			
				$image->setData(null)->load($this->getRequest()->getParam('id'));
				
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('adminhtml')->__('The image was smushed and is now %s%% smaller.', $image->getPercentageSaved())
				);
			}
			catch (Exception $e) {
				$this->_addError($e->getMessage());
				Mage::logException($e);
			}
		}
		else {
			$this->_addError('This image does not exist.');
		}
		
		$this->_redirect('*/*');
	}

	public function massSmushAction()
	{
		if ($imageIds = $this->getRequest()->getPost('image')) {
			$images = Mage::getResourceModel('smushit/image_collection')
				->addFieldToFilter('image_id', array('in' => $imageIds))
				->addIsSmushedFilter(0)
				->load();
			
			if (count($images) > 0) {
				$smushed = 0;

				foreach($images as $image) {
					try {
						$image->smush();
						++$smushed;
					}
					catch (Exception $e) {
						Mage::log($e->getMessage(), null, 'smushit.log', true);	
					}
				}
				
				if ($smushed === 1) {
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('1 image has been smushed.'));
				}
				else if ($smushed > 1) {
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('%d images have been smushed.', $smushed));
				}
				else {
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('0 images have been smushed.'));
				}
			}
			else {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('All of the selected images have already been smushed.'));
			}
		}
		else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('No data found.'));
		}
		
		$this->_redirect('*/*');
	}
	
	/**
	 * Revert the image to the original
	 *
	 * @return void
	 */
	public function revertAction()
	{
		$image = Mage::getModel('smushit/image')->load($this->getRequest()->getParam('id'));

		if ($image->getId()) {
			try {
				if ($image->revert()) {
					Mage::getSingleton('adminhtml/session')->addSuccess(
						Mage::helper('adminhtml')->__('The image has been reverted to the original.')
					);
				}
				else {
					$this->_addError('Unable to revert the image to the original.');
				}
			}
			catch (Exception $e) {
				$this->_addError($e->getMessage());
				Mage::logException($e);
			}
		}
		else {
			$this->_addError('This image does not exist.');
		}
		
		$this->_redirect('*/*');
	}

	/**
	 * Display the Extend tab
	 *
	 * @return void
	 */
	public function extendAction()
	{
		$block = $this->getLayout()
			->createBlock('smushit/adminhtml_extend')
			->setModule('Fishpig_SmushIt')
			->setTemplate('large.phtml')
			->setLimit(3)
			->setPreferred(array_flip(array('Fishpig_Bolt', 'Fishpig_NoBots', 'Fishpig_Opti')));

		$this->getResponse()->setBody($block->toHtml());
	}
	
	/**
	 * Add an error message to the session
	 *
	 * @param string $msg
	 * @return $this
	 */
	protected function _addError($msg)
	{
		Mage::getSingleton('adminhtml/session')->addError($this->__($msg));
		
		return $this;
	}
}