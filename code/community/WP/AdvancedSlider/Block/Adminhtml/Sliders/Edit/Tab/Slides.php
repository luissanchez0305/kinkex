<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders_Edit_Tab_Slides extends Mage_Adminhtml_Block_Widget_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('advancedslider/slider_slides.phtml');
    }

    protected function _prepareLayout()
    {
        $layout = $this->getLayout();
        $this->setChild('grid', $layout->createBlock('advancedslider/adminhtml_sliders_edit_tab_slides_grid', 'slider.slides.grid'));
        return parent::_prepareLayout();
    }
}
