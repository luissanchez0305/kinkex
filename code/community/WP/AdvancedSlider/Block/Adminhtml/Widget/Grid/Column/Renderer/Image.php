<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $renderOut = '';
        $image = trim($row->getData($this->getColumn()->getIndex()));
        if ($image)
        {
            $url = Mage::helper('advancedslider')->getResizedImageUrl($image, 100);
            if ($url)
            {
                $sourceUrl = Mage::getBaseUrl('media') . $image;
                $popLink = "popWin('$sourceUrl', 'image', 'width=800, height=600, resizable=yes, scrollbars=yes')";
                $renderOut = '<a href="javascript:;" title="' . $this->__('Click Me!') . '" onclick="' . $popLink . '"><img src="' . $url . '" width="100" style="border: 2px solid #CCCCCC;"/></a>';
            }
        }
        return $renderOut;
    }
}
