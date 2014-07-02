<?php

class Quizvideo_Quetions_Block_Adminhtml_Quetions_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('quetions_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('quetions')->__('Quetions Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('quetions')->__('Quetions Information'),
          'title'     => Mage::helper('quetions')->__('Quetions Information'),
          'content'   => $this->getLayout()->createBlock('quetions/adminhtml_quetions_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}