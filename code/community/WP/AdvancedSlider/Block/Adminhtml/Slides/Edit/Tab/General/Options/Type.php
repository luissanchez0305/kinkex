<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options_Type
    extends WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options
{
    protected function _getSlider()
    {
        return Mage::registry('slider');
    }

    protected function _getSlide()
    {
        return Mage::registry('slide');
    }

    protected function _addOptionsFields(&$fieldset)
    {
        $types = Mage::getSingleton('advancedslider/source_type')->getOptionArray();
        $style = $this->_getSlider()->getStyle();
        switch ($style)
        {
            case WP_AdvancedSlider_Model_Source_Style::STYLE_STANDART:
            case WP_AdvancedSlider_Model_Source_Style::STYLE_TRISHA:
                $fieldset->addField('type', 'select', array(
                    'name'      => 'type',
                    'label'     => $this->__('Type'),
                    'required'  => false,
                    'values'    => $types,
                    'onchange'  => 'updateFormOptions()',
                ));
                break;

            default:
            case WP_AdvancedSlider_Model_Source_Style::STYLE_NICOLE:
            case WP_AdvancedSlider_Model_Source_Style::STYLE_KRISTA:
            case WP_AdvancedSlider_Model_Source_Style::STYLE_XANDRA:
                $fieldset->addField('type', 'note', array(
                    'name'      => 'type',
                    'label'     => $this->__('Type'),
                    'required'  => false,
                    'text'      => $types[$this->_getSlide()->getType()],
                ));
                break;
        }
    }
}
