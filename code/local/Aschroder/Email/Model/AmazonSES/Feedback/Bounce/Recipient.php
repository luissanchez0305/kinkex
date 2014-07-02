<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_AmazonSES_Feedback_Bounce_Recipient extends Varien_Object {
    
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
        if (isset($obj->action)) {
            $this->setAction($obj->action);
        }
        if (isset($obj->status)) {
            $this->setStatus($obj->status);
        }
        if (isset($obj->diagnosticCode)) {
            $this->setDiagnosticCode($obj->diagnosticCode);
        }
    }
    
    public function getRecipientEmail() {
        return $this->getEmailAddress();
    }
    
    public function getRecipientOption() {
        $option = '{';
        
        if ($this->hasAction()) {
            $option .= '"action":"' . $this->getAction() . '",';
        }
        
        if ($this->hasStatus()) {
            $option .= '"status":"' . $this->getStatus() . '",';
        }
        
        if ($this->hasDiagnosticCode()) {
            $option .= '"diagnosticCode":"' . $this->getDiagnosticCode() . '"';
        }
        
        $option .= "}";
        
        return $option;
    }
}
