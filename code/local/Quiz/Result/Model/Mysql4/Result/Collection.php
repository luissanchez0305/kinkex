<?php

class Quiz_Result_Model_Mysql4_Result_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('result/result');
    }
}