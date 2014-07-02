<?php

class WP_AdvancedSlider_Model_Source_Linktarget extends Varien_Object
{
    const TARGET_NEW    = '_blank';
    const TARGET_SELF   = '_self';

    public static function getOptionArray()
    {
        return array(
            ''                  => Mage::helper('advancedslider')->__("Don't use Links"),
            self::TARGET_NEW    => Mage::helper('advancedslider')->__('New window'),
            self::TARGET_SELF   => Mage::helper('advancedslider')->__('Same window'),
        );
    }
}
