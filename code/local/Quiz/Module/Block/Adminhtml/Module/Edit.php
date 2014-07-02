<?php

class Quiz_Module_Block_Adminhtml_Module_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'module';
        $this->_controller = 'adminhtml_module';
        
        $this->_updateButton('save', 'label', Mage::helper('module')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('module')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('module_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'module_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'module_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('module_data') && Mage::registry('module_data')->getId() ) {
            return Mage::helper('module')->__("Edit Video Details '%s'", $this->htmlEscape(Mage::registry('module_data')->getquizVideoTitle()));
        } else {
            return Mage::helper('module')->__('Add Video Details');
        }
    }
}