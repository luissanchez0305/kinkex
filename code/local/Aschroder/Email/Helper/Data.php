<?php

/**
 * Various Helper functions.
 *
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Helper_Data extends Mage_Core_Helper_Abstract {

    const LOG_FILE = 'aschroder_email.log';

    public function isEnabled() {
        return Mage::getStoreConfig('aschroder_email/general/enable');
    }

    public function isLogEnabled() {
        return Mage::getStoreConfig('aschroder_email/general/log');
    }

    public function isDebugLoggingEnabled() {
        return Mage::getStoreConfig('aschroder_email/general/log_debug');
    }

    public function isLogBounceEnabled() {
        return Mage::getStoreConfig('aschroder_email/general/log_bounce');
    }

    public function getDevelopmentMode() {
        return Mage::getStoreConfig('aschroder_email/general/development');
    }

    public function getTransport($id = null) {

        if ($this->isEnabled()) {
            // Big thanks to Christopher Valles
            // https://github.com/christophervalles/Amazon-SES-Zend-Mail-Transport

            $path = Mage::getModuleDir('', 'Aschroder_Email');
            include_once $path . '/lib/AmazonSES.php';

            $transport = new App_Mail_Transport_AmazonSES(
                array(
                    'accessKey' => Mage::getStoreConfig('aschroder_email/general/aws_access_key', $id),
                    'privateKey' => Mage::getStoreConfig('aschroder_email/general/aws_private_key', $id)
                ),
                $this->getRegion()
            );
        } else {
            $this->log("Disabled");
            return null;
        }

        $this->log("Returning transport");

        return $transport;
    }

    public function log($m) {
        if ($this->isDebugLoggingEnabled()) {
            Mage::log($m, null, self::LOG_FILE);
        }
    }

    public function logEmailSent($to, $template, $subject, $email, $isHtml) {
        if ($this->isLogEnabled()) {
            $log = Mage::getModel('aschroder_email/email_log')
                    ->setEmailTo($to)
                    ->setTemplate($template)
                    ->setSubject($subject)
                    ->setEmailBody($isHtml ? $email : nl2br($email))
                    ->save();
        }
        return $this;
    }

    public function getSNSClient() {

        $path = Mage::getModuleDir('', 'Aschroder_Email');
        include_once $path . '/lib/amazonsns.class.php';

        $access = Mage::getStoreConfig('aschroder_email/general/aws_access_key');
        $secret = Mage::getStoreConfig('aschroder_email/general/aws_private_key');

        $AmazonSNS = new AmazonSNS($access, $secret, $this->getRegion());
        return $AmazonSNS;

    }

    public function createTopic() {

        $AmazonSNS = $this->getSNSClient();
        $this->log("Creating SNS Topic and Subscribing");
        $topicArn = $AmazonSNS->createTopic('MageSend_EmailTopic');
        $this->log("Created topic: " . $topicArn);
        $url = Mage::getUrl('aschroder_email/index/index');
        // check if it's really a secure URL
        $isSecure = substr($url, 0, 8) == "https://";
        $AmazonSNS->subscribe($topicArn, ($isSecure ? 'https' : 'http'), $url);

        $this->log("Topic Created and Subscription requested");
    }
    public function confirmSubscription($topic, $token) {

        $AmazonSNS = $this->getSNSClient();
        $result = $AmazonSNS->confirmSubscription($topic, $token);
        $this->log("Confirmed subscription: " . $result);
    }

    public function sendBounceTest() {

        $mail = new Zend_Mail();
        $mail->setBodyText("Dummy Email");
        $testFrom = Mage::getStoreConfig('trans_email/ident_general/email');
        $mail->setFrom($testFrom, $testFrom)
            ->addTo("bounce@simulator.amazonses.com", "bounce@simulator.amazonses.com")
            ->setSubject("Dummy Email");

        $transport = $this->getTransport();
        try {
            $mail->send($transport);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError("Could not send SNS Bounce Test, reason: " . $e->getMessage());
        }

    }
    public function sendComplaintTest() {

        $mail = new Zend_Mail();
        $mail->setBodyText("Dummy Email");
        $testFrom = Mage::getStoreConfig('trans_email/ident_general/email');
        $mail->setFrom($testFrom, $testFrom)
            ->addTo("complaint@simulator.amazonses.com", "complaint@simulator.amazonses.com")
            ->setSubject("Dummy Email");

        $transport = $this->getTransport();
        try {
            $mail->send($transport);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError("Could not send SNS Complaint Test, reason: " . $e->getMessage());
        }

    }
    public function sendOOTOTest() {

        $mail = new Zend_Mail();
        $mail->setBodyText("Dummy Email");
        $testFrom = Mage::getStoreConfig('trans_email/ident_general/email');
        $mail->setFrom($testFrom, $testFrom)
            ->addTo("ooto@simulator.amazonses.com", "ooto@simulator.amazonses.com")
            ->setSubject("Dummy Email");

        $transport = $this->getTransport();
        try {
            $mail->send($transport);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError("Could not send SNS OOTO Test, reason: " . $e->getMessage());
        }

    }

    public function getLogCleanDays() {

        $days = Mage::getStoreConfig('aschroder_email/general/log_clean');
        return intval($days);
    }

    public function cleanLogsOver($days) {

        // This is the 'cut off' timestamp in seconds
        $cutoffTime = Mage::getModel('core/date')->gmtTimestamp() - ($days * 60 * 60 * 24);

        # Delete logged emails and errors older than $cutoffTime
        Mage::getModel('aschroder_email/email_log')->clean($cutoffTime);
        Mage::getModel('aschroder_email/seslog')->clean($cutoffTime);
    }

    public function getRegion() {
        $this->log("region=" . Mage::getStoreConfig('aschroder_email/general/region'));
        return Mage::getStoreConfig('aschroder_email/general/region');
    }

}
