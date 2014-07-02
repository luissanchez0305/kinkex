<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_Email_Log extends Mage_Core_Model_Abstract
{
    /**
     * Model initialization
     *
     */
    protected function _construct() {
        $this->_init('aschroder_email/email_log');
    }

    /**
     * Clean Logs
     *
     * @return Aschroder_Email_Model_Email_Log
     */
    public function clean($cutoffTime) {
        $this->getResource()->clean($cutoffTime);
        return $this;
    }
}