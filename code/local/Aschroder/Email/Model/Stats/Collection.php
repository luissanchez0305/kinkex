<?php

/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_Stats_Collection extends Varien_Data_Collection {

    // hack to get the faux collection working with grids.
    public function addItem(Varien_Object $item) {
        parent::addItem($item);
        $this->_totalRecords = $this->_totalRecords + 1;
    }
}