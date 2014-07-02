<?php

class WP_AdvancedSlider_Model_Source_Style extends Varien_Object
{
    const STYLE_STANDART    = 'standart';
    const STYLE_NICOLE      = 'nicole';
    const STYLE_KRISTA      = 'krista';
    const STYLE_XANDRA      = 'xandra';
    const STYLE_TRISHA      = 'trisha';

    public static function getOptionArray()
    {
        return array(
            self::STYLE_STANDART    => Mage::helper('advancedslider')->__('Standard'),
            self::STYLE_KRISTA      => Mage::helper('advancedslider')->__('Krista'),
            self::STYLE_NICOLE      => Mage::helper('advancedslider')->__('Nicole'),
            self::STYLE_XANDRA      => Mage::helper('advancedslider')->__('Xandra'),
            self::STYLE_TRISHA      => Mage::helper('advancedslider')->__('Trisha'),
        );
    }
}
