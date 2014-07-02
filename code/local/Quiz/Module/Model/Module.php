<?php

class Quiz_Module_Model_Module extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('module/module');
    }
}