<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options extends Mage_Adminhtml_Block_Widget_Form
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

        $fieldset = $form->addFieldset('advancedslider_slide_options', array());

        $fieldset->setRenderer(Mage::getBlockSingleton('advancedslider/adminhtml_widget_form_renderer_fieldset'));

        $this->_addOptionsFields($fieldset);

        $form->setValues($this->_options);

        return parent::_prepareForm();
    }

    public function setOptions($options)
    {
        $this->_options = $options;
        return $this;
    }

    public function getOption($name)
    {
        if (isset($this->_options[$name])) return $this->_options[$name];
        return '';
    }

    public function setOptionsDefault()
    {
        // ---
    }

    protected function _addOptionsFields(&$fieldset)
    {
        // ---
    }
}
