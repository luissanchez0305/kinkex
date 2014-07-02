<?php

/**
 * Log Cleaning options
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_System_Config_Source_Clean_Option
{

    public function toOptionArray()
    {
        return array(
            "0"   => Mage::helper('adminhtml')->__('Forever'),
            "7"   => Mage::helper('adminhtml')->__('For 1 week'),
            "30"   => Mage::helper('adminhtml')->__('For 30 days'),
            "90"   => Mage::helper('adminhtml')->__('For 90 days'),
            "180"   => Mage::helper('adminhtml')->__('For 6 months'),
            "365"   => Mage::helper('adminhtml')->__('For 1 year')
        );
    }
}