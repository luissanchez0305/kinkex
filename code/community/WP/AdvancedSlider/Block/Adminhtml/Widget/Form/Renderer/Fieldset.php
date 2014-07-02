<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Form_Renderer_Fieldset extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset
{
    protected function _construct()
    {
        $this->setTemplate('advancedslider/fieldset.phtml');
    }
}
