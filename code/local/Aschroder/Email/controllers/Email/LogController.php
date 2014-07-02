<?php

/**
 * Controller for the Log viewing operations
 *
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Email_LogController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
                ->_setActiveMenu('system/tools')
                ->_title(Mage::helper('aschroder_email')->__('MageSend'))
                ->_title(Mage::helper('aschroder_email')->__('Email Log'))
                ->_addBreadcrumb(Mage::helper('aschroder_email')->__('System'), Mage::helper('aschroder_email')->__('System'))
                ->_addBreadcrumb(Mage::helper('aschroder_email')->__('Tools'), Mage::helper('aschroder_email')->__('Tools'))
                ->_addBreadcrumb(Mage::helper('aschroder_email')->__('Email Log'), Mage::helper('aschroder_email')->__('Email Log'));
        return $this;
    }

    public function indexAction() {

        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('aschroder_email/log'))
                ->renderLayout();
    }

    public function viewAction() {

        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('aschroder_email/log_view'))
                ->renderLayout();
    }

}

