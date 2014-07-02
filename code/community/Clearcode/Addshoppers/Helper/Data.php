<?php

class Clearcode_Addshoppers_Helper_Data extends Mage_Core_Helper_Abstract
{
     
      protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('<module>/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
       // return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('<module>/adminhtml_<module>'));
        $this->renderLayout();
    }
}
