<?php

class Quiz_Result_Block_Adminhtml_Result_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('result_form', array('legend'=>Mage::helper('result')->__('Result Data')));
     
      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('result')->__('Customer Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
      ));
	  
	    $fieldset->addField('email', 'text', array(
          'label'     => Mage::helper('result')->__('Customer Email'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'email',
      ));
	  
	   $fieldset->addField('quizvideo', 'text', array(
          'label'     => Mage::helper('result')->__('Quiz Video'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'quizvideo',
      ));
	  
	    $fieldset->addField('point', 'text', array(
          'label'     => Mage::helper('result')->__('Obtain Marks'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'point',
      ));
	  
     
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('result')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('result')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('result')->__('Disabled'),
              ),
          ),
      ));
     
      
      if ( Mage::getSingleton('adminhtml/session')->getResultData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getResultData());
          Mage::getSingleton('adminhtml/session')->setResultData(null);
      } elseif ( Mage::registry('result_data') ) {
          $form->setValues(Mage::registry('result_data')->getData());
      }
      return parent::_prepareForm();
  }
}