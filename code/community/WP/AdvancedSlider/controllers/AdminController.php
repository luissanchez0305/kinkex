<?php

class WP_AdvancedSlider_AdminController extends Mage_Adminhtml_Controller_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        $this->_checkAjaxSession();
    }

    public function _checkAjaxSession()
    {
        if ($this->getRequest()->getParam('isAjax'))
        {
            if (!Mage::getSingleton('admin/session')->isLoggedIn() || !$this->_isAllowed())
            {
                die($this->getResponse()->setBody($this->_getDeniedJson()));
            }
        }
    }

    protected function _getDeniedJson()
    {
        return Mage::helper('core')->jsonEncode(
            array(
                'ajaxExpired'  => 1,
                'ajaxRedirect' => $this->getUrl('adminhtml/index/login')
            )
        );
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = "application/octet-stream")
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die();
    }
}
