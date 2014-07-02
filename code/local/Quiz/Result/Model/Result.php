<?php

class Quiz_Result_Model_Result extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('result/result');
    }
}