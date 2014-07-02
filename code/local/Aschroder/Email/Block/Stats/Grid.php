<?php

/**
 * @author Ashley Schroder (aschroder.com)
 * @copyright  Copyright (c) 2013 ASchroder Consulting Ltd
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Aschroder_Email_Block_Stats_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {

        parent::__construct();
        $this->setId('emailStatsGrid');
        $this->setDefaultSort('date', 'desc');
        $this->setFilterVisibility(false);
        $this->setPagerVisibility(false);
    }

    protected function _prepareCollection() {

        $collection = new Aschroder_Email_Model_Stats_Collection();
        $email_data = Mage::registry('email_data');
        foreach ($email_data as $day => $day_data) {
            $obj = new Varien_Object();
            $obj->setData('date', $day);
            $obj->setData('sends', $day_data["sends"]);
            $obj->setData('rejects', $day_data["rejects"]);
            $obj->setData('bounces', $day_data["bounces"]);
            $obj->setData('comps', $day_data["comps"]);
            $collection->addItem($obj);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();

    }

    protected function _prepareColumns() {
        $this->addColumn('date', array(
            'header' => Mage::helper('aschroder_email')->__('Date'),
            'width' => '60px',
            'index' => 'date',
        ));
        $this->addColumn('sends', array(
            'header' => Mage::helper('aschroder_email')->__('Sends'),
            'width' => '60px',
            'index' => 'sends',
        ));
        $this->addColumn('rejects', array(
            'header' => Mage::helper('aschroder_email')->__('Rejects'),
            'width' => '60px',
            'index' => 'rejects',
        ));
        $this->addColumn('bounces', array(
            'header' => Mage::helper('aschroder_email')->__('Bounces'),
            'width' => '60px',
            'index' => 'bounces',
        ));
        $this->addColumn('comps', array(
            'header' => Mage::helper('aschroder_email')->__('Complaints'),
            'width' => '60px',
            'index' => 'comps',
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
