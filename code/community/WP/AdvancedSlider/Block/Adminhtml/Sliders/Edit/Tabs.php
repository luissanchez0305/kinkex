<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('advancedslider_slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Slider Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('general', array(
            'label'     => $this->__('General'),
            'title'     => $this->__('General'),
            'content'   => $this->getLayout()->createBlock('advancedslider/adminhtml_sliders_edit_tab_general')->toHtml(),
            'active'    => $this->getRequest()->getParam('tab') == 'general',
        ));

        if ($id = $this->getRequest()->getParam('id'))
        {
            $this->addTab('slides', array(
                'label'     => $this->__('Slides'),
                'title'     => $this->__('List of Slides'),
                'content'   => $this->getLayout()->createBlock('advancedslider/adminhtml_sliders_edit_tab_slides')->toHtml(),
                'active'    => $this->getRequest()->getParam('tab') == 'slides',
            ));
        }

        return parent::_beforeToHtml();
    }
}
