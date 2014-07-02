<?php

/**
 * CLS_AddShoppers
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@classyllama.com so we can send you a copy immediately.
 *
 * @category    Code
 * @package     CLS_AddShoppers
 * @copyright   Copyright (c) 2012 Classy Llama Studios, LLC (classyllama.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Conversion track code block
 *
 * @package CLS_AddShoppers
 * @copyright Copyright (c) 2012 Classy Llama Studios, LLC
 * @author Nicholas Vahalik <nick@classyllama.com>
 */
class Clearcode_Addshoppers_Block_Conversion extends Clearcode_Addshoppers_Block_Abstract
{
    /**
     * Stores the order ID for the conversion block
     *
     * @var int
     */
    private $_orderId;

    /**
     * Grabs the order ID of the previously placed order.
     *
     * @return int
     * @copyright Copyright (c) 2012 Classy Llama Studios, LLC
     * @author Nicholas Vahalik <nick@classyllama.com>
     */
    public function getOrderId()
    {
        if($this->_orderId == null) {
            $this->_orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
        }
        return $this->_orderId;
    }

    /**
     * Gets the amount of the last placed order.
     *
     * @return float
     * @copyright Copyright (c) 2012 Classy Llama Studios, LLC
     * @author Nicholas Vahalik <nick@classyllama.com>
     */
    public function getAmount()
    {
        return round(Mage::getModel('sales/order')->loadByIncrementId($this->getOrderId())->subtotal, 2);
    }

    public function getSellShareSection()
    {
        if($this->config->getSalesSharingEnabled()) {
            return $this->getPopupScript();
        }
    }

    private function getPopupScript()
    {
        $html = <<<HTML
<script type="text/javascript">
    AddShoppersTracking = {
        auto: true,
        header: "{$this->getHeaderOption()}",
        image: "{$this->getImageOption()}",
        url: "{$this->getUrlOption()}",
        name: "{$this->getNameOption()}",
        description: "{$this->getDescOption()}"
    }
</script>
HTML;
        return $html;
    }
    
    private function getHeaderOption()
    {
        return $this->config->getPopupTitle();
    }

    private function getImageOption()
    {
        return $this->config->getShareImage();
    }

    private function getUrlOption()
    {
        return $this->config->getShareUrl();
    }

    private function getNameOption()
    {
        return $this->config->getShareTitle();
    }

    private function getDescOption()
    {
        return $this->config->getShareDescription();
    }
}
