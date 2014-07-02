<?php
/**
 *
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Model_Sendfriend extends Mage_Sendfriend_Model_Sendfriend {

    public function send() {

        if ($this->isExceedLimit()){
            Mage::throwException(Mage::helper('sendfriend')->__('You have exceeded limit of %d sends in an hour', $this->getMaxSendsToFriend()));
        }

        /* @var $translate Mage_Core_Model_Translate */
        $translate = Mage::getSingleton('core/translate');
        $translate->setTranslateInline(false);

        /* @var $mailTemplate Mage_Core_Model_Email_Template */
        $mailTemplate = Mage::getModel('core/email_template');

        $message = nl2br(htmlspecialchars($this->getSender()->getMessage()));
        $sender  = array(
            'name'  => $this->_getHelper()->htmlEscape($this->getSender()->getName()),
            'email' => $this->_getHelper()->htmlEscape($this->getSender()->getEmail())
        );

        // SES uses the General contact email as the 'from' address. We set the
        // reply-to header to ensure the friend gets any reply email.
        $sesSender  = array(
            'name'  => $this->_getHelper()->htmlEscape($this->getSender()->getName()),
            'email' => Mage::getStoreConfig('trans_email/ident_general/email', Mage::app()->getStore()->getId())
        );

        $mailTemplate->setDesignConfig(array(
            'area'  => 'frontend',
            'store' => Mage::app()->getStore()->getId()
        ));

        foreach ($this->getRecipients()->getEmails() as $k => $email) {
            $name = $this->getRecipients()->getNames($k);
            $mailTemplate->setReplyTo($sender['email']);
            $mailTemplate->sendTransactional(
                $this->getTemplate(),
                $sesSender,
                $email,
                $name,
                array(
                    'name'          => $name,
                    'email'         => $email,
                    'product_name'  => $this->getProduct()->getName(),
                    'product_url'   => $this->getProduct()->getUrlInStore(),
                    'message'       => $message,
                    'sender_name'   => $sender['name'],
                    'sender_email'  => $sender['email'],
                    'product_image' => Mage::helper('catalog/image')->init($this->getProduct(),
                        'small_image')->resize(75),
                )
            );
        }

        $translate->setTranslateInline(true);
        $this->_incrementSentCount();

        return $this;
    }

}
