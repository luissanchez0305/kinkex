<?php

class WP_AdvancedSlider_Block_Adminhtml_Store_Switcher extends Mage_Adminhtml_Block_Template
{
    protected $_storeId = '';

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('webandpeople/advancedslider/store_switcher.phtml');
    }

    public function getWebsites()
    {
        $websites = Mage::app()->getWebsites();
        if ($websiteIds = $this->getWebsiteIds())
        {
            foreach ($websites as $websiteId => $website)
            {
                if (!in_array($websiteId, $websiteIds))
                {
                    unset($websites[$websiteId]);
                }
            }
        }
        return $websites;
    }

    public function getStores($group)
    {
        if (!$group instanceof Mage_Core_Model_Store_Group)
        {
            $group = Mage::app()->getGroup($group);
        }
        $stores = $group->getStores();
        if ($storeIds = $this->getStoreIds())
        {
            foreach ($stores as $storeId => $store)
            {
                if (!in_array($storeId, $storeIds))
                {
                    unset($stores[$storeId]);
                }
            }
        }
        return $stores;
    }

    public function getSwitchUrl()
    {
        return $this->getUrl('*/*/*', array('_current' => true, 'store' => null));
    }

    public function getStoreId()
    {
        return $this->_currentStoreId;
    }

    public function setCurrentStoreId($storeId)
    {
        $this->_currentStoreId = $storeId;
        return $this;
    }
}
