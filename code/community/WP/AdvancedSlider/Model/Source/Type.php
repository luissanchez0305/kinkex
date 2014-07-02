<?php

class WP_AdvancedSlider_Model_Source_Type extends Varien_Object
{
    const TYPE_IMAGE    = 1;
    const TYPE_HTML     = 2;

    public static function getOptionArray()
    {
        return array(
            self::TYPE_IMAGE    => Mage::helper('advancedslider')->__('Image'),
            self::TYPE_HTML     => Mage::helper('advancedslider')->__('HTML'),
        );
    }
}
