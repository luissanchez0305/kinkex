<?php

class Quiz_Result_Block_Adminhtml_Result_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'result';
        $this->_controller = 'adminhtml_result';
        
        $this->_updateButton('save', 'label', Mage::helper('result')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('result')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('result_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'result_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'result_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('result_data') && Mage::registry('result_data')->getId() ) {
            return Mage::helper('result')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('result_data')->getName()));
        } else {
            return Mage::helper('result')->__('Add Item');
        }
    }
}