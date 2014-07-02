<?php

class WP_HideBackendNotifications_Block_Notification_Toolbar extends Mage_Adminhtml_Block_Notification_Toolbar
{
    public function isShow()
    {
        if (!Mage::getStoreConfig('hide_backend_notifications/general/enabled') ||
            Mage::getStoreConfig('hide_backend_notifications/general/only_popup'))
        {
            return parent::isShow();
        }
        return false;
    }

    public function isMessageWindowAvailable()
    {
        if (!Mage::getStoreConfig('hide_backend_notifications/general/enabled') ||
            Mage::getStoreConfig('hide_backend_notifications/general/only_popup'))
        {
            return parent::isMessageWindowAvailable();
        }
        return false;
    }
}
