<?php

class Quizvideo_Quetions_Model_Mysql4_Quetions extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the quetions_id refers to the key field in your database table.
        $this->_init('quetions/quetions', 'quetions_id');
    }
}