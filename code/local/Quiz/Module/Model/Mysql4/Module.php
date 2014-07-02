<?php

class Quiz_Module_Model_Mysql4_Module extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the module_id refers to the key field in your database table.
        $this->_init('module/module', 'module_id');
    }
}