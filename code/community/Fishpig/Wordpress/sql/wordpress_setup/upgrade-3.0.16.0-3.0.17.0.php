<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */
	
	$this->startSetup();

	$autoLoginTable = $this->getTable('wordpress_autologin');
	$configTable = $this->getTable('core_config_data');

	$select = $this->getConnection()
		->select()
		->from($autoLoginTable, array('username', 'password', 'user_id'));

	try {	
		if ($results = $this->getConnection()->fetchAll($select)) {
			foreach($results as $result) {
				foreach(array('username', 'password') as $field) {
					if ($result[$field]) {
						try {
							$this->getConnection()->insert(
								$configTable,
								array(
									'scope' => 'default',
									'scope_id' => 0,
									'path' => 'wordpress/autologin/' . $field . '_' . $result['user_id'],
									'value' => $result[$field],
								)
							);
						}
						catch (Exception $e) {
							if (strpos($e->getMessage(), 'Duplicate entry') === false) {
								throw $e;
							}
						}
					}
				}
			}
		}

		$this->getConnection()->query('DROP TABLE ' . $autoLoginTable);
	}
	catch (Exception $e) {
		Mage::helper('wordpress')->log($e);
		throw $e;
	}

	$this->endSetup();
