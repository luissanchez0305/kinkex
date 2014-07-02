<?php
class Quizvideo_Quetions_Block_Quetions extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getQuetions()     
     { 
        if (!$this->hasData('quetions')) {
            $this->setData('quetions', Mage::registry('quetions'));
        }
        return $this->getData('quetions');
        
    }
}