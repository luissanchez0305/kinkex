<?php
/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_Mysql4_Seslog_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
	
    protected function _construct() {
        $this->_init('aschroder_email/seslog');
    }
}