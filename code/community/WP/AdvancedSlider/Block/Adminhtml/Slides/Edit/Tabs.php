<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('advancedslider_slide_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Slide Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('general', array(
            'label'     => $this->__('General'),
            'title'     => $this->__('General'),
            'content'   => $this->getLayout()->createBlock('advancedslider/adminhtml_slides_edit_tab_general')->toHtml(),
            'active'    => $this->getRequest()->getParam('tab') == 'general',
        ));

        $this->addTab('advanced', array(
            'label'     => $this->__('Advanced Options'),
            'title'     => $this->__('Advanced Options'),
            'content'   => $this->getLayout()->createBlock('advancedslider/adminhtml_slides_edit_tab_advanced')->toHtml(),
            'active'    => $this->getRequest()->getParam('tab') == 'advanced',
        ));

        return parent::_beforeToHtml();
    }
}
