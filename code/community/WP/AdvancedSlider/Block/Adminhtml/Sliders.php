<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_sliders';
        $this->_blockGroup = 'advancedslider';
        $this->_headerText = $this->__('Web & People: Manage Sliders');
        $this->_addButtonLabel = $this->__('Add Slider');
        parent::__construct();
    }

    protected function _prepareLayout()
    {
        $this->setChild('grid', $this->getLayout()->createBlock('advancedslider/adminhtml_sliders_grid'));
        return parent::_prepareLayout();
    }
}
