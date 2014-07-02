<?php
class Quiz_Module_Block_Adminhtml_Module extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_module';
    $this->_blockGroup = 'module';
    $this->_headerText = Mage::helper('module')->__('Manage Videos');
    $this->_addButtonLabel = Mage::helper('module')->__('Add Quiz Video');
    parent::__construct();
  }
}