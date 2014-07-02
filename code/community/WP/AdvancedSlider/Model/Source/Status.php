<?php

class WP_AdvancedSlider_Model_Source_Status extends Varien_Object
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 2;

    public static function getOptionArray()
    {
        return array(
            self::STATUS_ACTIVE     => Mage::helper('advancedslider')->__('Active'),
            self::STATUS_INACTIVE   => Mage::helper('advancedslider')->__('Inactive'),
        );
    }
}
