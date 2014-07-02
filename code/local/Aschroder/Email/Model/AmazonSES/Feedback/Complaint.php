<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_AmazonSES_Feedback_Complaint extends Aschroder_Email_Model_AmazonSES_Feedback {
    
    /**
     * 
     * @param Object $obj
     */
    public function loadFromJSON($obj) {
        if (isset($obj->complaintFeedbackType)) {
            $this->setComplaintFeedbackType($obj->complaintFeedbackType);
        }
        $this->setTimestamp($obj->timestamp);
        $this->setFeedbackId($obj->feedbackId);
        
        if (isset($obj->userAgent)) {
            $this->setUserAgent($obj->userAgent);
        }
        if (isset($obj->arrivalDate)) {
            $this->setArrivalDate($obj->arrivalDate);
        }
        $this->_recipients = array();
        foreach ($obj->complainedRecipients as $recipient) {
            $this->_recipients[] = new Aschroder_Email_Model_AmazonSES_Feedback_Complaint_Recipient($recipient);
            
        }
    }
    
    public function getFeedbackType() {
        return $this->getComplaintFeedbackType();
    }
}