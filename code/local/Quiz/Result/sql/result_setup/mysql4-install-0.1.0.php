<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('result')};
CREATE TABLE {$this->getTable('result')} (
  `result_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `quizvideo` varchar(255) NOT NULL default '',
  `point` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 