<?php

/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Block_Log_View extends Mage_Catalog_Block_Product_Abstract {

    public function __construct() {
        parent::__construct();
        $this->setTemplate('aschroder_email/view.phtml');
        $this->setEmailId($this->getRequest()->getParam('email_id', false));
    }

    public function getEmailData() {
        if ($this->getEmailId()) {
            return Mage::getModel('aschroder_email/email_log')
                            ->load($this->getEmailId());
        } else {
            throw new Exception("No Email Id given");
        }
    }

    public function getBackUrl() {
        return Mage::helper('adminhtml')->getUrl('*/email_log');
    }

}