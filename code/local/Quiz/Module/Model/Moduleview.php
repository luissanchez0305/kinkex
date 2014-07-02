<?php

class Quiz_Module_Model_Moduleview extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('module/module');
    }
}