<?php

class Quiz_Module_Block_Adminhtml_Module_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('module_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('module')->__('Quiz Video Details'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('module')->__('Quiz Video Details'),
          'title'     => Mage::helper('module')->__('Quiz Video Details'),
          'content'   => $this->getLayout()->createBlock('module/adminhtml_module_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}