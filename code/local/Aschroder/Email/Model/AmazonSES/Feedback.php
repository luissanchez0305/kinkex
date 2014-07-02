<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

abstract class Aschroder_Email_Model_AmazonSES_Feedback extends Varien_Object {
    
    protected $_recipients;
    
    /**
     * 
     * @param string $type
     * @param string $obj
     * @return Aschroder_Email_Model_AmazonSES_Feedback
     */
    public static function factory($type, $obj) {
        $class_name = __CLASS__ . '_' . ucfirst($type);
        return new $class_name($obj);
    }
    
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
    }
    
    public function getFeedbackType() {
    }
    
    public function getFeedbackRecipients() {
        $recipients = array();
        foreach ($this->_recipients as $recipient) {
            $recipients[$recipient->getRecipientEmail()] = $recipient->getRecipientOption();
        }
        return $recipients;
    }
    
    public function getSaveData() {
        $data = array();
        $common = array();
        $common['feedback_type'] = $this->getFeedbackType();
        $common['feedback_id'] = $this->getFeedbackId();
        $common['feedback_time'] = $this->getTimestamp();
        foreach ($this->_recipients as $recipient) {
            $tmp = array_merge(array(), $common);
            $tmp['recipient'] = $recipient->getRecipientEmail();
            $tmp['recipient_options'] = $recipient->getRecipientOption();
            $data[] = $tmp;
        }
        return $data;
    }
}