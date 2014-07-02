<?php
/**
 *
 *
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
$installer = $this;

$installer->startSetup();

Mage::log("Running upgrade");

$installer->run("
CREATE TABLE `{$this->getTable('aschroder_email/seslog')}` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `notification_type` varchar(10) NOT NULL default '',
  `send_time` varchar(50) NOT NULL default '',
  `aws_message_id` varchar(255) NOT NULL default '',
  `feedback_type` varchar(20) NULL,
  `feedback_id` varchar(255) NOT NULL default '',
  `feedback_time` varchar(50) NOT NULL default '',
  `recipient` varchar(255) NOT NULL default '',
  `recipient_options` text NULL,
  `raw_json` text NOT NULL default '',
  `log_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `log_at` (`log_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();
