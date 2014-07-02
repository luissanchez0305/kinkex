<?php

class WP_AdvancedSlider_Model_Source_Slidersource extends Varien_Object
{
    const SOURCE_STANDART   = 'standart';
    const SOURCE_NICOLE     = 'nicole';
    const SOURCE_KRISTA     = 'krista';
    const SOURCE_XANDRA     = 'xandra';
    const SOURCE_TRISHA     = 'trisha';

    public static function toOptionArray()
    {
        $options[self::SOURCE_STANDART] = array(
            'value' => self::SOURCE_STANDART,
            'label' => Mage::helper('advancedslider')->__('Files of Standard Slider')
        );
        $options[self::SOURCE_NICOLE] = array(
            'value' => self::SOURCE_NICOLE,
            'label' => Mage::helper('advancedslider')->__('Files of Nicole Slider')
        );
        $options[self::SOURCE_KRISTA] = array(
            'value' => self::SOURCE_KRISTA,
            'label' => Mage::helper('advancedslider')->__('Files of Krista Slider')
        );
        $options[self::SOURCE_XANDRA] = array(
            'value' => self::SOURCE_XANDRA,
            'label' => Mage::helper('advancedslider')->__('Files of Xandra Slider')
        );
        $options[self::SOURCE_TRISHA] = array(
            'value' => self::SOURCE_TRISHA,
            'label' => Mage::helper('advancedslider')->__('Files of Trisha Slider')
        );
        return $options;
    }
}
