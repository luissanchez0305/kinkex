<?php

class WP_Advancedslider_Model_Mysql4_Slides_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('advancedslider/slides');
    }
}
