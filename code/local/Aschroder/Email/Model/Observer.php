<?php

/**
 * Observer that logs emails after they have been sent
 * and configures transport for sending
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Model_Observer {

    /**
     * Expects observer with data:
     * 'to', 'subject', 'template',
     * 'html', 'email_body'
     *
     * @param $observer
     */
    public function log($observer) {

        $event = $observer->getEvent();
        Mage::helper('aschroder_email')->logEmailSent(
            $event->getTo(),
            $event->getTemplate(),
            $event->getSubject(),
            $event->getEmailBody(),
            $event->getHtml());
    }

    /**
     * Expects observer with:
     * 'mail', the mail about to be sent
     * 'email', the email object initiating the send
     * 'transport', an initially empty transport Object, will be used if set.
     *
     * @param $observer
     */
    public function beforeSend($observer) {
        Mage::helper('aschroder_email')->log($observer->getEvent()->getMail());
        $observer->getEvent()->getTransport()->setTransport(Mage::helper('aschroder_email')->getTransport());
    }

    /**
     * Expects observer with:
     * 'mail', the mail about to be sent
     * 'template', the template being used
     * 'variables', the variables used in the template
     * 'transport', an initially empty transport Object, will be used if set.
     *
     * @param $observer
     */
    public function beforeSendTemplate($observer) {
        Mage::helper('aschroder_email')->log($observer->getEvent()->getMail());
        $observer->getEvent()->getTransport()->setTransport(Mage::helper('aschroder_email')->getTransport());
    }

}
