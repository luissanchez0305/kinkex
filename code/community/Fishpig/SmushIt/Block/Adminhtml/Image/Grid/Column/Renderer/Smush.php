<?php
/**
 * @category    Fishpig
 * @package    Fishpig_AttributeSplashPro
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Block_Adminhtml_Image_Grid_Column_Renderer_Smush extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
	/**
	 * Change the caption and href parameters if the image has already been smushed
	 *
	 * @param array $action
	 * @param string $actionCaption
	 * @param Varien_Object $row
	 * @return $this
	 */
	protected function _transformActionData(&$action, &$actionCaption, Varien_Object $row)
	{
		parent::_transformActionData($action, $actionCaption, $row);
		
		if ($row->isSmushed()) {
			$actionCaption = 'Revert';
			$action['href'] = $this->getUrl('*/*/revert', array('id' => $row->getId()));
		}

		return $this;
	}
}
