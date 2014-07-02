<?php

class Quizvideo_Quetions_Block_Adminhtml_Quetions_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('quetions_form', array('legend'=>Mage::helper('quetions')->__('Item information')));

	/*
	echo "<pre>";
	print_r($videocollection);
	//$writeConnection = $resource->getConnection('core_write');
	$attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', 'color'); //here, "color" is the attribute_code
	$allOptions = $attribute->getSource()->getAllOptions(true, true);
	*/
	//$resource = Mage::getSingleton('core/resource');
	//$readConnection = $resource->getConnection('core_read');
	//$table = $resource->getTableName('module');
	//$videocollection = $readConnection->fetchCol('SELECT quizvideo_title FROM ' . $table . '');
	
	$videocollection = Mage::getModel('module/module')->getCollection();
	 foreach($videocollection as $item)
  { 
      //  echo "<pre>";
		//print_r($item->getData());
		//exit;
            $_menuItems[] = array(
                        'value'     => $item->getQuizvideoTitle(),
                        'label'     => $item->getQuizvideoTitle(),
                    );
        
  }
   	//echo "<pre>";
	//print_r($videocollection);
	//exit;
	
	
   	$fieldset->addField('quizvideotitle', 'select', array(
          'label'     => Mage::helper('quetions')->__('Quiz Video Title:'),
          'name'      => 'quizvideotitle',
          'values'    => $_menuItems
      ));
	  
	  
      $fieldset->addField('quizquetion', 'text', array(
          'label'     => Mage::helper('quetions')->__('Quiz Quetion:'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'quizquetion',
      ));
				  
	
	  
	   $fieldset->addField('answer_1', 'text', array(
          'label'     => Mage::helper('quetions')->__(' # Answer 1'),
          'required'  => false,
          'name'      => 'answer_1',
      ));
	  
	  
	 $fieldset->addField('answer_2', 'text', array(
          'label'     => Mage::helper('quetions')->__(' # Answer 2'),
          'required'  => false,
          'name'      => 'answer_2',
      ));
	  
	  
	 $fieldset->addField('answer_3', 'text', array(
          'label'     => Mage::helper('quetions')->__(' # Answer 3'),
          'required'  => false,
          'name'      => 'answer_3',
      ));
	  
	  
	  
	  $fieldset->addField('answer_4', 'text', array(
          'label'     => Mage::helper('quetions')->__(' # Answer 4'),
          'required'  => false,
          'name'      => 'answer_4',
      ));
	  
	  
	   $fieldset->addField('answer_5', 'text', array(
          'label'     => Mage::helper('quetions')->__(' # Answer 5'),
          'required'  => false,
          'name'      => 'answer_5',
      ));
	  
	    $fieldset->addField('right_answer', 'text', array(
          'label'     => Mage::helper('quetions')->__(' Right Answer'),
          'required'  => true,
          'name'      => 'right_answer',
      ));
	  
	  $fieldset->addField('point', 'text', array(
          'label'     => Mage::helper('quetions')->__('Define Marks'),
          'required'  => true,
          'name'      => 'point',
      ));
	  

      if ( Mage::getSingleton('adminhtml/session')->getQuetionsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getQuetionsData());
          Mage::getSingleton('adminhtml/session')->setQuetionsData(null);
      } elseif ( Mage::registry('quetions_data') ) {
          $form->setValues(Mage::registry('quetions_data')->getData());
      }
      return parent::_prepareForm();
  }
}