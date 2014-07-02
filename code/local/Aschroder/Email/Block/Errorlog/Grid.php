<?php

/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Block_Errorlog_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('emailLogGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('aschroder_email/seslog')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => Mage::helper('aschroder_email')->__('Error Id'),
            'width' => '60px',
            'index' => 'id',
        ));
        $this->addColumn('send_time', array(
            'header' => Mage::helper('aschroder_email')->__('Sent'),
	    'type'      => 'datetime',
            'width' => '60px',
            'index' => 'send_time',
        ));
        $this->addColumn('notification_type', array(
            'header' => Mage::helper('aschroder_email')->__('Notification Type'),
            'width' => '80px',
            'index' => 'notification_type',
        ));
        $this->addColumn('feedback_type', array(
            'header' => Mage::helper('aschroder_email')->__('Feedback Type'),
            'width' => '80px',
            'index' => 'feedback_type',
        ));
        $this->addColumn('recipient', array(
            'header' => Mage::helper('aschroder_email')->__('Recipient'),
            'width' => '80px',
            'index' => 'recipient',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row) {
        return false;
    }

}
