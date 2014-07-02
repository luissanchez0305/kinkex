<?php

class WP_AdvancedSlider_Block_Adminhtml_Widget_Grid_Column_Renderer_Position extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value  = (int)$row->getData($this->getColumn()->getIndex());
        $id     = (int)$row->getData('slide_id');
        $input  = sprintf('<input type="text" class="input-text " value="%d" name="slides_position[%d]" />', $value, $id);
        return $input;
    }
}
