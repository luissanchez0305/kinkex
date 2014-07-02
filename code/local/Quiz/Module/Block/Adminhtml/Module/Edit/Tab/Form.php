<?php

class Quiz_Module_Block_Adminhtml_Module_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('module_form', array('legend'=>Mage::helper('module')->__('Video Details')));
     
      $fieldset->addField('quizvideo_title', 'text', array(
          'label'     => Mage::helper('module')->__('Quiz video Title : '),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'quizvideo_title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('module')->__('Upload Video'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('module')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('module')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('module')->__('Disabled'),
              ),
          ),
      ));
     
    
     
      if ( Mage::getSingleton('adminhtml/session')->getModuleData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getModuleData());
          Mage::getSingleton('adminhtml/session')->setModuleData(null);
      } elseif ( Mage::registry('module_data') ) {
          $form->setValues(Mage::registry('module_data')->getData());
      }
      return parent::_prepareForm();
  }
}