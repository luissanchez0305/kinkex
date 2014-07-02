<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

 	// Include the FPAdmin Extend Block class
	require_once(Mage::getModuleDir('', 'Fishpig_SmushIt') . DS . implode(DS, array('FPAdmin', 'Block', 'Adminhtml', 'Extend.php')));
	 
class Fishpig_SmushIt_Block_Adminhtml_Extend extends Fishpig_FPAdmin_Block_Adminhtml_Extend {}
