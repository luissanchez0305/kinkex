<?php

class CJM_ColorSelectorPlus_Block_System_Config_Info
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{
	public function render(Varien_Data_Form_Element_Abstract $element)
	{
		$html = '
		<ul>
			<li>
				<h4>Cómo usar el selector de colores e intercambio de productos</h4>
				<p style="font-size:10px; color:#666666;">
				&#8226;&nbsp;Seleccione los códigos de atributos que desea utilizar más adelante. Ctrl + clic para seleccionar varios atributos.<br>&nbsp;&nbsp;Recuerde que el uso de más de tres atributos de muestras por producto no ha sido probado para trabajar.<br>&nbsp;&nbsp;Una vez que los códigos de atributos están seleccionados, vaya a Catálogo-> Atributos-> Administrar atributos y seleccione uno de los atributos de su lista de atributos.<br>&nbsp;&nbsp;Ahora verá una nueva pestaña llamada "Manage Swatches" donde se puede gestionar, editar y ver sus muestras.<br>&nbsp;&nbsp;Para utilizar el cambio de imagen, abra su producto configurable y cargue imágenes para cada opción de atributo de los productos hijos simples que usted tiene.<br>&nbsp;&nbsp;Seleccione la opción a la que representan en el cuadro de selección "Base Image For". Por ejemplo, rojo.<br>&nbsp;&nbsp;Para utilizar más de conmutación entre imágenes, sube tus imágenes más vistas en el producto configurable y seleccione la opción a la que representan en el cuadro de selección "More View Image For".<br>&nbsp;&nbsp;Para vincular los productos simples a su producto configurable padre y seleccionar automáticamente la opción, sólo asegúrese de configurar el producto simple para que sea visible en el catálogo y/o la búsqueda.<br><br>

				</p></li></ul></div>';
        
        return $html;
    }
}
