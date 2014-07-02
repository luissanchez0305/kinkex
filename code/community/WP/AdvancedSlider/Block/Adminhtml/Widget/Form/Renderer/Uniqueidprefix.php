<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Form_Renderer_Uniqueidprefix extends Mage_Adminhtml_Block_Widget_Form_Renderer_Element
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $id = $element->getId();
        $name = $element->getName();
        $value = $element->getValue();
        if (!$value) $value = time();
        $html = '<input id="' . $id . '" name="' . $name . '" style="display:none;" type="text" value="' . $value . '"/>';
        return $html;
    }
}
