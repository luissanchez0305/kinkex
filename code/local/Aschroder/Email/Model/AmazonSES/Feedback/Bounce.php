<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_AmazonSES_Feedback_Bounce extends Aschroder_Email_Model_AmazonSES_Feedback {
    
    /**
     * 
     * @param Object $obj
     */
    public function loadFromJSON($obj) {
        $this->setBounceType($obj->bounceType);
        $this->setBounceSubType($obj->bounceSubType);
        $this->setTimestamp($obj->timestamp);
        $this->setFeedbackId($obj->feedbackId);
        if (isset($obj->reportingMTA)) {
            $this->setReportingMTA($obj->reportingMTA);
        }
        $this->_recipients = array();
        foreach ($obj->bouncedRecipients as $recipient) {
            $this->_recipients[] = new Aschroder_Email_Model_AmazonSES_Feedback_Bounce_Recipient($recipient);
            
        }
    }
    
    public function getFeedbackType() {
        return "{$this->getBounceType()}-{$this->getBounceSubType()}";
    }
}