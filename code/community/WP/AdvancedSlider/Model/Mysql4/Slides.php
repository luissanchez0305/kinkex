<?php

class WP_AdvancedSlider_Model_Mysql4_Slides extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('advancedslider/slides', 'slide_id');
    }
}
