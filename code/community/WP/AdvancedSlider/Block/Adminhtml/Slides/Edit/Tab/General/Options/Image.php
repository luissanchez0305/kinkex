<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options_Image
    extends WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options
{
    protected function _addOptionsFields(&$fieldset)
    {
        $fieldset->addField('image', 'image', array(
            'name'      => 'image',
            'label'     => $this->__('Image'),
            'required'  => false,
        ));
    }
}
