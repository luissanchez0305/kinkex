<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders_Edit_Tab_General_Options extends Mage_Adminhtml_Block_Widget_Form
{
    private $_options = null;

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('advancedslider/form.phtml');
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('advancedslider_slider_options', array());
        $fieldset->setRenderer(Mage::getBlockSingleton('advancedslider/adminhtml_widget_form_renderer_fieldset'));
        $this->_addOptionsFields($fieldset);
        $form->setValues($this->_options);
        return parent::_prepareForm();
    }

    public function setOptions($options)
    {
        $default = $this->_getOptionsDefault();
        $options = is_array($options) ? $options : array();
        $this->_options = array_merge($default, $options);
        return $this;
    }

    protected function _getOptionsDefault()
    {
        return array();
    }

    protected function _addOptionsFields(&$fieldset)
    {
        // ---
    }
}
