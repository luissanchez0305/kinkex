<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_Seslog extends Mage_Core_Model_Abstract
{
    public function _construct() {
        parent::_construct();
        $this->_init('aschroder_email/seslog');
    }

    /**
     * Clean Logs
     *
     * @return Aschroder_Email_Model_Seslog
     */
    public function clean($cutoffTime) {
        $this->getResource()->clean($cutoffTime);
        return $this;
    }

}