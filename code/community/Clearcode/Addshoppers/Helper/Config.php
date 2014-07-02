<?php

class Clearcode_Addshoppers_Helper_Config
{
    private $storeCode;

    public function __construct($storeCode = null)
    {
        if (isset($storeCode)) {
            $this->storeCode = $storeCode;
        }
        else {
            $this->storeCode = null;
        }
    }

    public function setEnabled($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/enabled', $value);
    }
    
    public function getEnabled()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/enabled');
    }
    
    public function setUrl($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/url', $value);
    }
    
    public function getUrl()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/url');
    }
    
    public function setPlatform($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/platform', $value);
    }
    
    public function getPlatform()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/platform');
    }
    
    public function setActive($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/active', $value);
    }
    
    public function getActive()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/active');
    }
    
    public function setEmail($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/email', $value);
    }
    
    public function getEmail()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/email');
    }
    
    public function setPassword($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/password', $value);
    }
    
    public function getPassword()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/password');
    }
    
    public function setPhone($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/phone', $value);
    }
    
    public function getPhone()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/phone');
    }
    
    public function setCategory($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/category', $value);
    }
    
    public function getCategory()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/category');
    }
    
    public function setApiKey($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/account_id', $value);
    }
    
    public function getApiKey()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/account_id');
    }
    
    public function setShopId($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/shopid', $value);
    }
    
    public function getShopId()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/shopid');
    }
    
    public function setSchemaEnabled($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/use_schema', $value);
    }
    
    public function getSchemaEnabled()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/use_schema');
    }
    
    public function setSocialEnabled($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/social', $value);
    }
    
    public function getSocialEnabled()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/social');
    }
    
    public function setOpenGraphEnabled($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/opengraph', $value);
    }
    
    public function getOpenGraphEnabled()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/opengraph');
    }
    
    public function setSalesSharingEnabled($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/sales_sharing_enable', $value);
    }
    
    public function getSalesSharingEnabled()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/sales_sharing_enable');
    }
    
    public function setPopupTitle($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/popup_title', $value);
    }
    
    public function getPopupTitle()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/popup_title');
    }
    
    public function setShareImage($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/image_share', $value);
    }
    
    public function getShareImage()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/image_share');
    }
    
    public function setShareUrl($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/url_share', $value);
    }
    
    public function getShareUrl()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/url_share');
    }
    
    public function setShareTitle($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/title_share', $value);
    }
    
    public function getShareTitle()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/title_share');
    }
    
    public function setShareDescription($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/description_share', $value);
    }
    
    public function getShareDescription()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/description_share');
    }
    
    public function setButtonsCode($value)
    {
        $this->saveConfigForStore('clearcode_addshoppers/settings/button_code', $value);
    }
    
    public function getButtonsCode()
    {
        return $this->getConfigForStore('clearcode_addshoppers/settings/button_code');
    }

    private function getConfigForStore($path)
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $storeId = ($this->storeCode != null) ? Mage::app()->getStore($this->storeCode)->getId() : Mage::app()->getStore()->getId();

        $query = "SELECT value FROM " . $resource->getTableName('core_config_data') . " WHERE scope_id = '" . $storeId . "' AND path = '" . $path . "'";

        $results = $readConnection->fetchCol($query);

        if(count($results) == 0) {
            $query = "SELECT value FROM " . $resource->getTableName('core_config_data') . " WHERE scope_id = '0' AND path = '" . $path . "'";
            $results = $readConnection->fetchCol($query);
        }

        return isset($results[0]) ? $results[0] : "";
    }

    private function saveConfigForStore($path, $value)
    {
        $configModel = Mage::getResourceModel('core/config');
        $storeId = ($this->storeCode == 'default') ? 0 : Mage::app()->getStore($this->storeCode)->getId();
        $scope = ($this->storeCode != 'default' && $storeId != 0) ? 'stores' : 'default';
        $configModel->saveConfig($path, $value, $scope, $storeId);
    }
}
