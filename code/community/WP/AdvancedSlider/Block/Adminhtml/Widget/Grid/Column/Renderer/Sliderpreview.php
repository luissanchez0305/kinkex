<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Sliderpreview extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $renderOut = '';
        $id = trim($row->getData($this->getColumn()->getIndex()));
        if ($id)
        {
            $popLink = Mage::helper('advancedslider')->getSliderPreviewLink($id);
            $renderOut = '<a href="javascript:;" title="' . $this->__('Open in new window') . '" onclick="' . $popLink . '">' . $this->__('Preview') . '</a>';
        }
        return $renderOut;
    }
}
