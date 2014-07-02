<?php
class Quizvideo_Quetions_Block_Adminhtml_Quetions extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_quetions';
    $this->_blockGroup = 'quetions';
    $this->_headerText = Mage::helper('quetions')->__('Quetions/Answers Manager');
    $this->_addButtonLabel = Mage::helper('quetions')->__('Add quetions');
    parent::__construct();
  }
}