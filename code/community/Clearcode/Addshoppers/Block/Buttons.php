<?php

/**
 * Buttons block to display the buttons
 *
 * @package CLS_AddShoppers
 * @copyright Copyright (c) 2012 Classy Llama Studios, LLC
 * @author Nicholas Vahalik <nick@classyllama.com>
 */
class Clearcode_Addshoppers_Block_Buttons extends Clearcode_Addshoppers_Block_Abstract
{    
    /**
     * If enabled, return the button code.
     *
     * @return string HTML Code
     * @copyright Copyright (c) 2012 Classy Llama Studios, LLC
     * @author Nicholas Vahalik <nick@classyllama.com>
     */
    public function _toHtml() {
        if ($this->config->getEnabled()){
            return $this->_getButtonsCode();
        }
    }
    
    private function _getButtonsCode()
    {
        if ($this->config->getSocialEnabled()) {
            return $this->config->getButtonsCode();
        }
    }
}
