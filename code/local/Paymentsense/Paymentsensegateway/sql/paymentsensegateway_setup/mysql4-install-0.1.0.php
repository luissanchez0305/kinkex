<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

Mage::log('paymentsense installer script started');

try
{
	$installer->run("
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_failed_hosted_payment');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_failed_threed_secure');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_paid');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_pending');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_pending_hosted_payment');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_pending_threed_secure');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_refunded');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_voided');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_preauth');
	DELETE FROM `{$installer->getTable('sales_order_status')}` WHERE (`status`='pys_collected');
	
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_failed_hosted_payment', 'Paguelofacil - Denegada');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_failed_threed_secure', 'Paguelofacil - Failed 3D Secure');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_paid', 'Paguelofacil - Pago Exitoso');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_pending', 'Paguelofacil - Pending Hosted Payment');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_pending_hosted_payment', 'Paguelofacil - Pending Hosted Payment');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_pending_threed_secure', 'Paguelofacil - Pending 3D Secure');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_refunded', 'Paguelofacil - Payment Refunded');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_voided', 'Paguelofacil - Payment Voided');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_preauth', 'Paguelofacil - PreAuthorized');
	INSERT INTO `{$installer->getTable('sales_order_status')}` (`status`, `label`) VALUES ('pys_collected', 'Paguelofacil - Payment Collected');
	");
}
catch(Exception $exc)
{
	Mage::log("Error during script installation: ". $exc->__toString());
}

Mage::log('paymentsense installer script ended');

$installer->endSetup();