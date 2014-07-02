<?php
$installer = $this;
$installer->startSetup();
$tableName = Mage::getSingleton('core/resource')->getTableName('core_config_data');
$installer->run("
        delete FROM `$tableName` where scope = 'store' and scope_id = 0 and path like 'clearcode_addshoppers%';
    ");
$installer->endSetup();