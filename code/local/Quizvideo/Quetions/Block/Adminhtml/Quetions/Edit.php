<?php

class Quizvideo_Quetions_Block_Adminhtml_Quetions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'quetions';
        $this->_controller = 'adminhtml_quetions';
        
        $this->_updateButton('save', 'label', Mage::helper('quetions')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('quetions')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('quetions_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'quetions_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'quetions_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('quetions_data') && Mage::registry('quetions_data')->getId() ) {
            return Mage::helper('quetions')->__("Edit Quetions '%s'", $this->htmlEscape(Mage::registry('quetions_data')->getQuizvideotitle()));
        } else {
            return Mage::helper('quetions')->__('Add Quetions');
        }
    }
}