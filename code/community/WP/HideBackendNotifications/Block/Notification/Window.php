<?php

class WP_HideBackendNotifications_Block_Notification_Window extends Mage_Adminhtml_Block_Notification_Window
{
    public function canShow()
    {
        if (!Mage::getStoreConfig('hide_backend_notifications/general/enabled'))
        {
            return parent::canShow();
        }
        return false;
    }
}
