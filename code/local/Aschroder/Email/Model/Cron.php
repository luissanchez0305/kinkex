<?php

/**
 * Cron functionality
 * - log cleaning
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Model_Cron {


    public function daily() {

        $helper = Mage::helper('aschroder_email');

        // If log cleaning is enabled, delete any records older than the threshold $days
        if ($days = $helper->getLogCleanDays()) {
            $helper->log("Running email log cleaning for $days days");
            $helper->cleanLogsOver($days);
        } else {
            $helper->log("Skipped email log cleaning");
        }

    }

}
