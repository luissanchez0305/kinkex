<?php

require_once 'Mage/Customer/controllers/AccountController.php';
class Intell_Customer_AccountController extends Mage_Customer_AccountController
{
         
	public function indexAction()
    {
		//echo "Hello";die;
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');

        $this->getLayout()->getBlock('content')->append(
            $this->getLayout()->createBlock('customer/account_dashboard')
        );
        $this->getLayout()->getBlock('head')->setTitle($this->__('My Account'));
        $this->renderLayout();
    }
	
	/**
     * Login post action
     */
    public function loginPostAction()
    {
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session = $this->_getSession();
		
		//checking is it from checkout
		$session->setCustomerRedirectFlag(0);
		$context = $this->getRequest()->getPost('context');
		$customerAlwaysRedirectToUrl = Mage::getStoreConfig('customer/customerredirect/always');
		if((!$customerAlwaysRedirectToUrl)){
			$session->setCustomerRedirectFlag(1);
		}
		
        if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');
            if (!empty($login['username']) && !empty($login['password'])) {
                try {
                    $session->login($login['username'], $login['password']);
                    if ($session->getCustomer()->getIsJustConfirmed()) {
                        $this->_welcomeCustomer($session->getCustomer(), true);
                    }
                } catch (Mage_Core_Exception $e) {
                    switch ($e->getCode()) {
                        case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
                            $value = Mage::helper('customer')->getEmailConfirmationUrl($login['username']);
                            $message = Mage::helper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
                            break;
                        case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
                            $message = $e->getMessage();
                            break;
                        default:
                            $message = $e->getMessage();
                    }
                    $session->addError($message);
                    $session->setUsername($login['username']);
                } catch (Exception $e) {
                    // Mage::logException($e); // PA DSS violation: this exception log can disclose customer password
                }
            } else {
                $session->addError($this->__('Login and password are required.'));
            }
        }

        $this->_loginPostRedirect();
    }
	
   
    protected function _loginPostRedirect()
    {
		//customer session
		$session = $this->_getSession();  
		$preUrl = $session->getBeforeAuthUrl(true);

		$cusromerRedirectStatus = Mage::getStoreConfig('customer/customerredirect/active');
		$customerRedirectUrl = Mage::getStoreConfig('customer/customerredirect/redirecturl');
		
		$redirectUrl = $preUrl;
		if(($cusromerRedirectStatus) && ($customerRedirectUrl) && ($session->getCustomerRedirectFlag()) && (strpos($preUrl, 'checkout/onepage') == '')){
			$redirectUrl = Mage::getUrl().$customerRedirectUrl;
		}
		
		if(($cusromerRedirectStatus) && ($customerRedirectUrl) && (!$session->getCustomerRedirectFlag())){
			$redirectUrl = Mage::getUrl().$customerRedirectUrl;
		}
		      
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirectUrl($redirectUrl);
            return;
        }
        
        $this->_redirectUrl($preUrl);          
    }
}
