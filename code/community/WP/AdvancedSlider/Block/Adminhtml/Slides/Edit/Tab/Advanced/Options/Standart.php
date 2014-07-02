<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_Advanced_Options_Standart
    extends WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_Advanced_Options
{
    protected function _addOptionsFields(&$fieldset)
    {
        $fieldset->addField('info', 'note', array(
            'name'      => 'info',
            'label'     => $this->__('No additional options.'),
            'required'  => false,
        ));
    }
}
