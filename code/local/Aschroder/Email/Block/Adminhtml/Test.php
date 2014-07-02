<?php

/**
 * This is the Self test Button
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Block_Adminhtml_Test
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{


 protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {

        $this->setElement($element);

        return $this->_getAddRowButtonHtml($this->__('Run Self Test'));
    }


  protected function _getAddRowButtonHtml($title) {

	$url = Mage::helper('adminhtml')->getUrl("*/email_test/index/");

	return $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setLabel($this->__($title))
                ->setOnClick("window.location.href='".$url."'")
                ->toHtml();
    }
}
