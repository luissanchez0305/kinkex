<?php

class Quizvideo_Quetions_Model_Quetions extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('quetions/quetions');
    }
}