<?php

class Quiz_Result_Model_Mysql4_Result extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the result_id refers to the key field in your database table.
        $this->_init('result/result', 'result_id');
    }
}