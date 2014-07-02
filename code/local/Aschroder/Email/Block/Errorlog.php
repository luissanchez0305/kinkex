<?php
/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Aschroder_Email_Block_Errorlog extends Mage_Adminhtml_Block_Widget_Grid_Container {
	
    /**
     * Block constructor
     */
    public function __construct() {

    	$this->_blockGroup = 'aschroder_email';
        $this->_controller = 'errorlog';
        $this->_headerText = Mage::helper('aschroder_email')->__('Email Errors');
        parent::__construct();
        
        // Remove the add button
        $this->_removeButton('add');

        // Add the setup button
        $this->_addButton('setup', array(
                'label'     => Mage::helper('aschroder_email')->__('Setup SNS'),
                'onclick'   => "setLocation('".$this->getUrl('adminhtml/email_errorlog/create')."')",
        ));

        // Add the test button
        $this->_addButton('test', array(
        'label'     => Mage::helper('aschroder_email')->__('Test SNS'),
        'onclick'   => "setLocation('".$this->getUrl('adminhtml/email_errorlog/test')."')",
        ));

    }


}
