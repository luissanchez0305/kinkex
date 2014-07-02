<?php

/**
 * Receipt the notification from Amazon SNS
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_IndexController extends Mage_Core_Controller_Front_Action {


   /*
     * This action is the end point for SNS notifications from Amazon.
     *
     */

    public function indexAction() {

        $_helper = Mage::helper('aschroder_email');

        if (!$_helper->isLogBounceEnabled()) {
            return; // do nothing
        }

        $json = $this->getRequest()->getRawBody();
        $obj = json_decode($json);
        if (!$obj || !isset($obj->Type)) {
            return;
        }
        $_helper->log("Received SNS message of type: " .$obj->Type);

        if ($obj->Type == "SubscriptionConfirmation") {

            $_helper->log("Got Subscription Confirmation");
            $_helper->confirmSubscription($obj->TopicArn, $obj->Token);

        } else {

            $amazon_ses = new Aschroder_Email_Model_AmazonSES($obj->Message);
            $save_data = $amazon_ses->getSaveData();
            foreach ($save_data as $save_item) {
                $model = Mage::getModel('aschroder_email/seslog');
                $model->addData($save_item);
                try {
                    $model->save();
                } catch (Exception $e) {
                    $_helper->log("Failed to save Amazon feedback message: " . $e->getMessage());
                }
            }
            $_helper->log("Processed Message");
        }
    }

}

