<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('quetions')};
CREATE TABLE {$this->getTable('quetions')} (
  `quetions_id` int(11) unsigned NOT NULL auto_increment,
  `quizquetion` varchar(255) NOT NULL default '',
  `quizvideotitle` varchar(255) NOT NULL default '',
  `answer_1` varchar(255) NOT NULL default '',
  `answer_2` varchar(255) NOT NULL default '',
  `answer_3` varchar(255) NOT NULL default '',
  `answer_4` varchar(255) NOT NULL default '',
  `answer_5` varchar(255) NOT NULL default '',
  `right_answer` varchar(255) NOT NULL default '',
  `point` varchar(255) NOT NULL default '',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`quetions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 