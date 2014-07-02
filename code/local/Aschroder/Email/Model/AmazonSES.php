<?php
/**
 * 
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Model_AmazonSES extends Varien_Object {
    
    /**
     * 
     * @param string $obj
     */
    public function __construct($obj) {
        parent::__construct();
        $this->loadFromJSON($obj);
        return $this;
    }
    
    /**
     * 
     * @param string $json
     */
    public function loadFromJSON ($json) {
        $obj = json_decode($json);
        $this->setRawJson($json);
        $notificationTypeName = (string)(strtolower(substr($obj->notificationType,0,1)).substr($obj->notificationType,1));
        $this->setFeedbackObject(Aschroder_Email_Model_AmazonSES_Feedback::factory($obj->notificationType, $obj->{$notificationTypeName}));
        $this->setMail(new Aschroder_Email_Model_AmazonSES_Mail($obj->mail));
        $this->setNotificationType($obj->notificationType);
    }
    
    public function getSaveData() {
        $data = $this->getFeedbackObject()->getSaveData();
        foreach ($data as &$row) {
            $row['notification_type'] = $this->getNotificationType();
            $row['send_time'] = $this->getMail()->getTimestamp();
            $row['aws_message_id'] = $this->getMail()->getMessageId();
        }
        return $data;
    }
}
