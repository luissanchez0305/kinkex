<?php

class CJM_ColorSelectorPlus_Block_System_Config_About extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{
	public function render(Varien_Data_Form_Element_Abstract $element)
	{
		$html = '
				<h4>Even Design</h4>
				<p style="font-size:10px; color:#666666;">
				Gestión de colores y productos configurables<br><br>

				</p></li></ul></div>';
        
        return $html;
    }
}
