<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_slides';
        $this->_blockGroup = 'advancedslider';
        $this->_headerText = $this->__('Web & People: Manage Slides');
        parent::__construct();

        $this->_removeButton('add');
    }

    protected function _prepareLayout()
    {
        $this->setChild('grid', $this->getLayout()->createBlock('advancedslider/adminhtml_slides_grid'));
        return parent::_prepareLayout();
    }
}
