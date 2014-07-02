<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Addslide extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $formatLink = '';
        $id = trim($row->getData($this->getColumn()->getIndex()));
        $link = Mage::helper('adminhtml')->getUrl('advancedslider/slides/new', array('slider' => $id));
        if ($link)
            $formatLink = '<a title="' . $this->__('Add Slide') . '" href="' . $link . '">' . $this->__('Add Slide') . '</a>';
        return $formatLink;
    }
}
