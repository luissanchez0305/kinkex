<?php

class Quiz_Result_Block_Adminhtml_Result_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('result_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('result')->__('Customer Result information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('result')->__('Customer Results'),
          'title'     => Mage::helper('result')->__('Customer Results'),
          'content'   => $this->getLayout()->createBlock('result/adminhtml_result_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}