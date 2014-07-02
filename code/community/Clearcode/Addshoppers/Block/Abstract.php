<?php

/**
 * Common methods for all blocks
 * 
 * @author Dominik Czajka <d.czajka@clearcode.cc >
 */
class Clearcode_Addshoppers_Block_Abstract extends Mage_Core_Block_Template
{
    /**
     *
     * @var Clearcode_Addshoppers_Helper_Config 
     */
    protected $config;
    
    public function __construct()
    {
        $this->config = new Clearcode_Addshoppers_Helper_Config();
    }

    /**
     * Returns the store account ID
     *
     * @return string AddShoppers Account ID
     */
    public function getAccountId()
    {
        return $this->config->getApiKey();
    }

    /**
     * Returns shop ID
     * 
     * @return string AddShoppers Shop ID
     */
    public function getShopId()
    {
        return $this->config->getShopId();
    }
}