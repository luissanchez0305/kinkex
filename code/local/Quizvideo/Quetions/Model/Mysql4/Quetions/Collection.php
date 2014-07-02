<?php

class Quizvideo_Quetions_Model_Mysql4_Quetions_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('quetions/quetions');
    }
}