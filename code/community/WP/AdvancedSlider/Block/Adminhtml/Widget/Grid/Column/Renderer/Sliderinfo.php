<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Sliderinfo extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $formatLink = '';
        $id = trim($row->getData($this->getColumn()->getIndex()));
        $link = Mage::helper('adminhtml')->getUrl('advancedslider/sliders/edit', array('id' => $id));
        if ($link)
            $formatLink = '<a title="' . $this->__('Edit Slider') . '" href="' . $link . '">' . $this->__('Edit Slider') . '</a><br />ID: <b>' . $id . '</b>';
        return $formatLink;
    }
}
