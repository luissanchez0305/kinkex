<?php
class Quiz_Result_Block_Adminhtml_Result extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_result';
    $this->_blockGroup = 'result';
    $this->_headerText = Mage::helper('result')->__('Customer Results');
    $this->_addButtonLabel = Mage::helper('result')->__('Add Item');
    parent::__construct();
	$this->_removeButton('add');
  }
}