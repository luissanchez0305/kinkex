<?php

/**
 * Log Cleaning options
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_System_Config_Source_Region
{

    public function toOptionArray()
    {
        return array(
            'US-EAST-1' => Mage::helper('adminhtml')->__('USA East'),
            'US-WEST-1' => Mage::helper('adminhtml')->__('USA West'),
            'EU-WEST-1' => Mage::helper('adminhtml')->__('Europe'),
        );
    }
}