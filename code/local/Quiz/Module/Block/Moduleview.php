<?php
class Quiz_Module_Block_Moduleview extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getModule()     
     { 
        if (!$this->hasData('module')) {
            $this->setData('module', Mage::registry('module'));
        }
        return $this->getData('module');
        
    }
}