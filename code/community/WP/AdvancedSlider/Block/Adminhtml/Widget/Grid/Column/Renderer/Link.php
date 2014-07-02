<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Link extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $formatLink = '';
        $link = trim($row->getData($this->getColumn()->getIndex()));
        if ($link)
            $formatLink = '<a title="' . $this->__('Go to the link') . '" target="_blank" href="' . $link . '">' . $this->__('To link') . '</a>';
        return $formatLink;
    }
}
