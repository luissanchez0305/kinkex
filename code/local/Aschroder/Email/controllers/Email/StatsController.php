<?php

/**
 * Controller for the Log viewing operations
 *
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Email_StatsController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
                ->_setActiveMenu('system/tools')
                ->_title(Mage::helper('aschroder_email')->__('MageSend'))
                ->_title(Mage::helper('aschroder_email')->__('Email Stats'))
                ->_addBreadcrumb(Mage::helper('aschroder_email')->__('System'), Mage::helper('aschroder_email')->__('System'))
                ->_addBreadcrumb(Mage::helper('aschroder_email')->__('Tools'), Mage::helper('aschroder_email')->__('Tools'))
                ->_addBreadcrumb(Mage::helper('aschroder_email')->__('Email Stats'), Mage::helper('aschroder_email')->__('Email Stats'));
        return $this;
    }

    public function indexAction() {

        $email_data = $this->getEmailData();
        if ($email_data) {

            Mage::register('email_data', $email_data);

            $graph = $this->getLayout()->createBlock('aschroder_email/graph');
            $grid = $this->getLayout()->createBlock('aschroder_email/stats');

            $this->_initAction()
                ->_addContent($graph)
                ->_addContent($grid)
                ->renderLayout();

        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Could not connect to Amazon SES or extension is disabled, no stats data to display.'));
            $this->_initAction()
                ->renderLayout();
        }

    }

    private function getEmailData() {

        try {

            $_helper = Mage::helper('aschroder_email');
            $transport = $_helper->getTransport();

            if (!$transport) {
                return false;
            }

            $xmlString = $transport->getSendStats();

            if (!$xmlString) {
                return false;
            }
            $xml = new SimpleXMLElement($xmlString);


            $date_data = array();

            //collect the data by date
            foreach ($xml->GetSendStatisticsResult->SendDataPoints->member as $member) {

                $timestamp = $member->Timestamp;
                $date = substr($timestamp, 0, 10);

                // collect this data
                $sends = $member->DeliveryAttempts;
                $rejects = $member->Rejects;
                $bounces = $member->Bounces;
                $comps = $member->Complaints;

                // add existing data if any
                if (isset($date_data[$date])) {
                    $sends += $date_data[$date]["sends"];
                    $rejects += $date_data[$date]["rejects"];
                    $bounces += $date_data[$date]["bounces"];
                    $comps += $date_data[$date]["comps"];

                }

                $date_data[$date] = array(
                    "sends" => $sends,
                    "rejects" => $rejects,
                    "bounces" => $bounces,
                    "comps" => $comps,
                );

            }
            ksort($date_data);
            return $date_data;

        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addException($e, Mage::helper('adminhtml')->__('Could not connect to Amazon SES.'));
            return false;
        }
    }

}

