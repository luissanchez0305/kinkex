<?php

class HM_QuickContact_IndexController extends Mage_Core_Controller_Front_Action
{		
    const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'contacts/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'contacts/email/email_template';
	
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('quickcontactForm');
        $this->renderLayout();
    }
	    
    public function postAction()
    {			
		$post = $this->getRequest()->getPost();		
		if(!$post) exit;
		$translate = Mage::getSingleton('core/translate');
        $translate->setTranslateInline(false);
		try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    echo '<div class="error-msg">'.Mage::helper('contacts')->__('Por favor ingrese los campos obligatorios.').'</div>';
					exit; 
                }

                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    echo '<div class="error-msg">'.Mage::helper('contacts')->__('Por favor ingrese los campos obligatorios.').'</div>';
					exit; 
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    echo '<div class="error-msg">'.Mage::helper('contacts')->__('Por favor intriduzca un email válido.').'</div>';
					exit; 
                }
				
				if (!isset($postObject['telephone']) || strlen($postObject['telephone'])<1) {
					$postObject['telephone'] = '';
				}		
				
               		
				$mailTemplate = Mage::getModel('core/email_template');				
				$mailTemplate->setDesignConfig(array('area' => 'frontend'))
					->setReplyTo($post['email'])
					->sendTransactional(
						Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                        null,
                        array('data' => $postObject)
					);

				if (!$mailTemplate->getSentSuccess()) {					
					echo '<div class="error-msg">'.Mage::helper('contacts')->__('No se puede enviar el mensaje. Por favor, inténtelo de nuevo más tarde.').'</div>';
					exit;
				}				
				$translate->setTranslateInline(true);

                echo '<div class="success-msg">'.Mage::helper('contacts')->__('Su mensaje fue enviado y será respondido a la brevedad posible. Gracias por contactar con nosotros.').'</div>';
			} catch (Exception $e) {
				$translate->setTranslateInline(true);
				echo '<div class="error-msg">'.Mage::helper('contacts')->__('No se puede enviar el mensaje. Por favor, inténtelo de nuevo más tarde.').$e.'</div>';
				exit;
			}		
	}	
}
?>