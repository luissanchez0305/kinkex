<?php

class Quiz_Module_Model_Mysql4_Module_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('module/module');
    }
}