<?php
class Quiz_Result_Block_Result extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getResult()     
     { 
        if (!$this->hasData('result')) {
            $this->setData('result', Mage::registry('result'));
        }
        return $this->getData('result');
        
    }
}