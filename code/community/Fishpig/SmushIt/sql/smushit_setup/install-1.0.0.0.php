<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Smushit
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	$this->startSetup();

	$this->run("

		CREATE TABLE IF NOT EXISTS {$this->getTable('smushit_image')} (
			`image_id` varchar(32) NOT NULL,
			`percentage_saved` DECIMAL(5,2) unsigned default NULL,
			`smushed_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
			PRIMARY KEY (`image_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Smush.it';
	");	
	
	$this->endSetup();
