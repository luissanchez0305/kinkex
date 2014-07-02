<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Smushit
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	$this->startSetup();

	$this->run("
		-- DROP TABLE IF EXISTS {$this->getTable('smushit_image_skin')};
		
		CREATE TABLE IF NOT EXISTS {$this->getTable('smushit_image_skin')} (
			`value_id` int(11) unsigned NOT NULL auto_increment,
			`value` VARCHAR(255) NOT NULL default '',
			PRIMARY KEY (`value_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Smush.it: Skin Images';
	");	
	
	$this->endSetup();
