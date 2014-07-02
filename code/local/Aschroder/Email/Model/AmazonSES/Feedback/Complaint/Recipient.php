<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_AmazonSES_Feedback_Complaint_Recipient extends Varien_Object {
    
    /**
     * 
     * @param Object $obj
     */
    public function __construct($obj) {
        parent::__construct();
        $this->loadFromJSON($obj);
        return $this;
    }
    
    /**
     * 
     * @param Object $obj
     */
    public function loadFromJSON($obj) {
        $this->setEmailAddress($obj->emailAddress);
    }
    
    public function getRecipientEmail() {
        return $this->getEmailAddress();
    }
    
    public function getRecipientOption() {
        return '';
    }
}
