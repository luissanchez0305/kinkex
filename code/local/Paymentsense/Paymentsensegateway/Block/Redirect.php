<?php 

class Paymentsense_Paymentsensegateway_Block_Redirect extends Mage_Core_Block_Abstract
{
	/**
	 * Build the redirect form to be submitted to the hosted payment form or the transparent redirect page
	 * 
	 */
	protected function _toHtml()
    {
    	$model = Mage::getModel('paymentsensegateway/direct');
    	$pmPaymentMode = $model->getConfigData('mode');
    	
    	switch ($pmPaymentMode)
    	{
    		case Paymentsense_Paymentsensegateway_Model_Source_PaymentMode::PAYMENT_MODE_HOSTED_PAYMENT_FORM:
    			$html = self::_redirectToHostedPaymentForm();
    			break;
    		case Paymentsense_Paymentsensegateway_Model_Source_PaymentMode::PAYMENT_MODE_TRANSPARENT_REDIRECT:
    			$html = self::_redirectToTransparentRedirect();
    			break;
    	}

        return $html;
    }
    
    /**
     * Build the redirect form for the Hosted Payment Form payment type
     *
     * @return unknown
     */
    private function _redirectToHostedPaymentForm()
    {
    	$html = '';
    	$model = Mage::getModel('paymentsensegateway/direct');
    	$szActionURL = "https://secure.paguelofacil.com/LinkDeamon.cfm?";
    	$cookies = Mage::getSingleton('core/cookie')->get();
    	$szServerResultURLCookieVariables;
    	$szServerResultURLFormVariables = '';
    	$szServerResultURLQueryStringVariables = '';
    	
    	// create a Magento form
        $form = new Varien_Data_Form();
        $form->setAction($szActionURL)
            ->setId('HostedPaymentForm')
            ->setName('HostedPaymentForm')
            ->setMethod('GET')
            ->setUseContainer(true);

        $form->addField("CCLW", 'hidden', array('name'=>"CCLW", 'value'=>Mage::getSingleton('checkout/session')->getMerchantid()));
        $form->addField("CMTN", 'hidden', array('name'=>"CMTN", 'value'=>(Mage::getSingleton('checkout/session')->getAmount()/100)));
        $form->addField("OrderID", 'hidden', array('name'=>"OrderID", 'value'=>Mage::getSingleton('checkout/session')->getOrderid()));
        $form->addField("CDSC", 'hidden', array('name'=>"CDSC", 'value'=>"Compra en ".$_SERVER['HTTP_HOST']." ID de compra #".Mage::getSingleton('checkout/session')->getOrderid()));
        $form->addField("HashDigest", 'hidden', array('name'=>"HashDigest", 'value'=>Mage::getSingleton('checkout/session')->getHashdigest()));
        $form->addField("CurrencyCode", 'hidden', array('name'=>"CurrencyCode", 'value'=>Mage::getSingleton('checkout/session')->getCurrencycode()));
        $form->addField("TransactionType", 'hidden', array('name'=>"TransactionType", 'value'=>Mage::getSingleton('checkout/session')->getTransactiontype()));
        $form->addField("TransactionDateTime", 'hidden', array('name'=>"TransactionDateTime", 'value'=>Mage::getSingleton('checkout/session')->getTransactiondatetime()));
        $form->addField("CallbackURL", 'hidden', array('name'=>"CallbackURL", 'value'=>Mage::getSingleton('checkout/session')->getCallbackurl()));
        
        $form->addField("CustomerName", 'hidden', array('name'=>"CustomerName", 'value'=>Mage::getSingleton('checkout/session')->getCustomername()));
        $form->addField("Address1", 'hidden', array('name'=>"Address1", 'value'=>Mage::getSingleton('checkout/session')->getAddress1()));
        $form->addField("Address2", 'hidden', array('name'=>"Address2", 'value'=>Mage::getSingleton('checkout/session')->getAddress2()));
        $form->addField("Address3", 'hidden', array('name'=>"Address3", 'value'=>Mage::getSingleton('checkout/session')->getAddress3()));
        $form->addField("Address4", 'hidden', array('name'=>"Address4", 'value'=>Mage::getSingleton('checkout/session')->getAddress4()));
        $form->addField("City", 'hidden', array('name'=>"City", 'value'=>Mage::getSingleton('checkout/session')->getCity()));
        $form->addField("State", 'hidden', array('name'=>"State", 'value'=>Mage::getSingleton('checkout/session')->getState()));
        $form->addField("PostCode", 'hidden', array('name'=>"PostCode", 'value'=>Mage::getSingleton('checkout/session')->getPostcode()));
        $form->addField("CountryCode", 'hidden', array('name'=>"CountryCode", 'value'=>Mage::getSingleton('checkout/session')->getCountrycode()));
        $form->addField("CV2Mandatory", 'hidden', array('name'=>"CV2Mandatory", 'value'=>Mage::getSingleton('checkout/session')->getCv2mandatory()));
        $form->addField("Address1Mandatory", 'hidden', array('name'=>"Address1Mandatory", 'value'=>Mage::getSingleton('checkout/session')->getAddress1mandatory()));
        $form->addField("CityMandatory", 'hidden', array('name'=>"CityMandatory", 'value'=>Mage::getSingleton('checkout/session')->getCitymandatory()));
        $form->addField("PostCodeMandatory", 'hidden', array('name'=>"PostCodeMandatory", 'value'=>Mage::getSingleton('checkout/session')->getPostcodemandatory()));
        $form->addField("StateMandatory", 'hidden', array('name'=>"StateMandatory", 'value'=>Mage::getSingleton('checkout/session')->getStatemandatory()));
        $form->addField("CountryMandatory", 'hidden', array('name'=>"CountryMandatory", 'value'=>Mage::getSingleton('checkout/session')->getCountrymandatory()));
        $form->addField("ResultDeliveryMethod", 'hidden', array('name'=>"ResultDeliveryMethod", 'value'=>Mage::getSingleton('checkout/session')->getResultdeliverymethod()));
        $form->addField("ServerResultURL", 'hidden', array('name'=>"ServerResultURL", 'value'=>Mage::getSingleton('checkout/session')->getServerresulturl()));
        $form->addField("PaymentFormDisplaysResult", 'hidden', array('name'=>"PaymentFormDisplaysResult", 'value'=>Mage::getSingleton('checkout/session')->getPaymentformdisplaysresult()));
        $form->addField("ServerResultURLCookieVariables", 'hidden', array('name'=>"ServerResultURLCookieVariables", 'value'=>Mage::getSingleton('checkout/session')->getServerresulturlcookievariables()));
        $form->addField("ServerResultURLFormVariables", 'hidden', array('name'=>"ServerResultURLFormVariables", 'value'=>Mage::getSingleton('checkout/session')->getServerresulturlformvariables()));
        $form->addField("ServerResultURLQueryStringVariables", 'hidden', array('name'=>"ServerResultURLQueryStringVariables", 'value'=>Mage::getSingleton('checkout/session')->getServerresulturlquerystringvariables()));

        // reset the session items
        Mage::getSingleton('checkout/session')->setHashdigest(null)
	        									->setMerchantid(null)
			  		   							->setAmount(null)
			  		   							->setCurrencycode(null)
			  		   							->setOrderid(null)
			  		   							->setTransactiontype(null)
			  		   							->setTransactiondatetime(null)
			  		   							->setCallbackurl(null)
			  		   							->setOrderdescription(null)
			  		   							->setCustomername(null)
			  		   							->setAddress1(null)
			  		   							->setAddress2(null)
			  		   							->setAddress3(null)
			  		   							->setAddress4(null)
			  		   							->setCity(null)
			  		   							->setState(null)
			  		   							->setPostcode(null)
			  		   							->setCountrycode(null)
			  		   							->setCv2mandatory(null)
			  		   							->setAddress1mandatory(null)
			  		   							->setCitymandatory(null)
			  		   							->setPostcodemandatory(null)
			  		   							->setStatemandatory(null)
			  		   							->setCountrymandatory(null)
			  		   							->setResultdeliverymethod(null)
			  		   							->setServerresulturl(null)
			  		   							->setPaymentformdisplaysresult(null)
			  		   							->setServerresulturlcookievariables(null)
			  		   							->setServerresulturlformvariables(null)
			  		   							->setServerresulturlquerystringvariables(null);
        
        $html = '<html><body>';
        $html.= $form->toHtml();
        $html.= '<div align="center"><img src="'.$this->getSkinUrl("images/paymentsense.gif").'"><p></div>';
        $html.= '<div align="center"><img src="https://pfserver.net/img/loadingPF.gif"><p></div>';
        $html.= '<div align="center">Verificando sus Dato, por favor espere...</div>';
        $html.= '<script type="text/javascript">document.getElementById("HostedPaymentForm").submit();</script>';
        $html.= '</body></html>';
    	
    	return $html;
    }
    
    /**
     * Build the redirect form for the Transparent Redirect payment type
     *
     * @return unknown
     */
    private function _redirectToTransparentRedirect()
    {
    	$html;
    	$model = Mage::getModel('paymentsensegateway/direct');
    	//$szActionURL = "https://secure.paguelofacil.com/PostDeamon.cfm?CCLW=18011D0B9623B253D689FC54A44D1153D1873CA26D23F1E1D90A8F5A6F8BA1B3&Unifier=KK";
    	$szActionURL = "https://secure.paguelofacil.com/PostDeamon.cfm?CCLW=76C6D0297B3517196800737A68EEE763B209342A08B7DF4B7A7B0795B6FC8B73&Unifier=KK";
        //$szActionURL = "http://pfserver.net/demo/magento/index.php/paymentsensegateway/payment/callbacktransparentredirect";
    	$szPaRes = Mage::getSingleton('checkout/session')->getPares();
    	
    	if(isset($szPaRes))
    	{
    		$html = self::_submitPaRes($szActionURL);
    	}
    	else
    	{
    		$html = self::_submitTransaction($szActionURL);
    	}
    	
    	return $html;
    }
    
    /**
     * Build the submit 
     *
     * @param unknown_type $szActionURL
     * @return unknown
     */
    private function _submitTransaction($szActionURL)
    {
      $tipo_cc = substr(Mage::getSingleton('checkout/session')->getCardnumber(), 0, 1);
      
      if($tipo_cc==4){
        $tipo="VISA";
      }else{
        $tipo="MC";
      }

    	$html = '';
    	
    	// create a Magento form
        $form = new Varien_Data_Form();
        $form->setAction($szActionURL)
            ->setId('TransparentRedirectForm')
            ->setName('TransparentRedirectForm')
            ->setMethod('post')
            //->setMethod('get')
            ->setUseContainer(true);
    	$customer = Mage::getSingleton('customer/session')->getCustomer();
      	//$form->addField("OperNumber", 'hidden', array('name'=>"OperNumber", 'value'=>"EC123456789"));
        //$form->addField("Status", 'hidden', array('name'=>"Status", 'value'=>"1"));
       //$form->addField("MensajeSistema", 'hidden', array('name'=>"MensajeSistema", 'value'=>"Mensaje")); 
    	//$form->addField("CCLW", 'hidden', array('name'=>"CCLW", 'value'=>Mage::getSingleton('checkout/session')->getMerchantid()));
    	//$form->addField("Unifier", 'hidden', array('name'=>"Unifier", 'value'=>"KK"));
        $form->addField("HashDigest", 'hidden', array('name'=>"HashDigest", 'value'=>Mage::getSingleton('checkout/session')->getHashdigest()));
        $form->addField("MerchantID", 'hidden', array('name'=>"MerchantID", 'value'=>Mage::getSingleton('checkout/session')->getMerchantid()));
        //$form->addField("Amount", 'hidden', array('name'=>"Amount", 'value'=>Mage::getSingleton('checkout/session')->getAmount()));
        $form->addField("CurrencyCode", 'hidden', array('name'=>"CurrencyCode", 'value'=>Mage::getSingleton('checkout/session')->getCurrencycode()));
        $form->addField("OrderID", 'hidden', array('name'=>"OrderID", 'value'=>Mage::getSingleton('checkout/session')->getOrderid()));
        $form->addField("TransactionType", 'hidden', array('name'=>"TransactionType", 'value'=>"Paguelo Facil"));
        $form->addField("TransactionDateTime", 'hidden', array('name'=>"TransactionDateTime", 'value'=>Mage::getSingleton('checkout/session')->getTransactiondatetime()));
        $form->addField("CallbackURL", 'hidden', array('name'=>"CallbackURL", 'value'=>Mage::getSingleton('checkout/session')->getCallbackurl()));
        $form->addField("OrderDescription", 'hidden', array('name'=>"OrderDescription", 'value'=>Mage::getSingleton('checkout/session')->getOrderdescription()));
        $form->addField("Address1", 'hidden', array('name'=>"Address1", 'value'=>Mage::getSingleton('checkout/session')->getAddress1()));
        $form->addField("Address2", 'hidden', array('name'=>"Address2", 'value'=>Mage::getSingleton('checkout/session')->getAddress2()));
        //$form->addField("Address3", 'hidden', array('name'=>"Address3", 'value'=>Mage::getSingleton('checkout/session')->getAddress3()));
        //$form->addField("Address4", 'hidden', array('name'=>"Address4", 'value'=>Mage::getSingleton('checkout/session')->getAddress4()));
        $form->addField("City", 'hidden', array('name'=>"City", 'value'=>Mage::getSingleton('checkout/session')->getCity()));
        $form->addField("State", 'hidden', array('name'=>"State", 'value'=>Mage::getSingleton('checkout/session')->getState()));
        $form->addField("PostCode", 'hidden', array('name'=>"PostCode", 'value'=>Mage::getSingleton('checkout/session')->getPostcode()));
        $form->addField("CountryCode", 'hidden', array('name'=>"CountryCode", 'value'=>Mage::getSingleton('checkout/session')->getCountrycode()));
        // $form->addField("CardName", 'hidden', array('name'=>"CardName", 'value'=>Mage::getSingleton('checkout/session')->getCardname()));
        // $form->addField("CardNumber", 'hidden', array('name'=>"CardNumber", 'value'=>Mage::getSingleton('checkout/session')->getCardnumber()));
        // $form->addField("ExpiryDateMonth", 'hidden', array('name'=>"ExpiryDateMonth", 'value'=>Mage::getSingleton('checkout/session')->getExpirydatemonth()));
        // $form->addField("ExpiryDateYear", 'hidden', array('name'=>"ExpiryDateYear", 'value'=>Mage::getSingleton('checkout/session')->getExpirydateyear()));
        // $form->addField("StartDateMonth", 'hidden', array('name'=>"StartDateMonth", 'value'=>Mage::getSingleton('checkout/session')->getStartdatemonth()));
        // $form->addField("StartDateYear", 'hidden', array('name'=>"StartDateYear", 'value'=>Mage::getSingleton('checkout/session')->getStartdateyear()));
        // $form->addField("IssueNumber", 'hidden', array('name'=>"IssueNumber", 'value'=>Mage::getSingleton('checkout/session')->getIssuenumber()));
        // $form->addField("CV2", 'hidden', array('name'=>"CV2", 'value'=>Mage::getSingleton('checkout/session')->getCv2()));
        
        $form->addField("Monto", 'hidden', array('name'=>"Monto", 'value'=>(Mage::getSingleton('checkout/session')->getAmount()/100))); 
        $form->addField("Deal", 'hidden', array('name'=>"Deal", 'value'=>Mage::getSingleton('checkout/session')->getCurrencycode()));
        $form->addField("USR", 'hidden', array('name'=>"USR", 'value'=>$customer->getEmail())); 
        $form->addField("Nombres", 'hidden', array('name'=>"Nombres", 'value'=>Mage::getSingleton('checkout/session')->getCardname()));
        $form->addField("Apellidos", 'hidden', array('name'=>"Apellidos", 'value'=>"   "));
        $form->addField("IDUu", 'hidden', array('name'=>"IDUu", 'value'=>"0"));
        $form->addField("Email", 'hidden', array('name'=>"Email", 'value'=>$customer->getEmail())); 
        $form->addField("Direccion", 'hidden', array('name'=>"Direccion", 'value'=>Mage::getSingleton('checkout/session')->getAddress1()));
        
        $form->addField("NumeroTarjeta", 'hidden', array('name'=>"NumeroTarjeta", 'value'=>Mage::getSingleton('checkout/session')->getCardnumber()));
        $form->addField("SecurityCode", 'hidden', array('name'=>"SecurityCode", 'value'=>Mage::getSingleton('checkout/session')->getCv2()));
        $form->addField("ExpMes", 'hidden', array('name'=>"ExpMes", 'value'=>Mage::getSingleton('checkout/session')->getExpirydatemonth()));
        $form->addField("ExpAno", 'hidden', array('name'=>"ExpAno", 'value'=>Mage::getSingleton('checkout/session')->getExpirydateyear()));

        $form->addField("Logo", 'hidden', array('name'=>"Logo", 'value'=>"kinkex.png"));// plugin personalizado  ONsite.
        $form->addField("Servicio", 'hidden', array('name'=>"Servicio", 'value'=>"Compra en ".$_SERVER['HTTP_HOST'].""));  // plugin personalizado  ONsite.
        $form->addField("Concepto", 'hidden', array('name'=>"Concepto", 'value'=>"Compra en ".$_SERVER['HTTP_HOST'].""));// plugin personalizado  ONsite.
        $form->addField("Login", 'hidden', array('name'=>"Login", 'value'=>"Invitado"));
        $form->addField("Telefono", 'hidden', array('name'=>"Telefono", 'value'=>"5072037875"));// plugin personalizado  ONsite.
        $form->addField("ReturnURL", 'hidden', array('name'=>"ReturnURL", 'value'=>Mage::getSingleton('checkout/session')->getCallbackurl()));
        //$form->addField("Company", 'hidden', array('name'=>"Company", 'value'=>"Paguelofacil Dev"));// plugin personalizado  ONsite.
        $form->addField("Company", 'hidden', array('name'=>"Company", 'value'=>"LOS AMIGOS POR EL BIENESTAR"));// plugin personalizado  ONsite.
        $form->addField("TipoTarjeta", 'hidden', array('name'=>"TipoTarjeta", 'value'=>$tipo));
        //$form->addField("Acreditar", 'hidden', array('name'=>"Acreditar", 'value'=>"Paguelofacil SA"));// plugin personalizado  ONsite.
        $form->addField("Acreditar", 'hidden', array('name'=>"Acreditar", 'value'=>"KINKEX S.A."));// plugin personalizado  ONsite.


       	 // reset the session items
        Mage::getSingleton('checkout/session')->setHashdigest(null)
	        									->setMerchantid(null)
			  		   							->setAmount(null)
			  		   							->setCurrencycode(null)
			  		   							->setOrderid(null)
			  		   							->setTransactiontype(null)
			  		   							->setTransactiondatetime(null)
			  		   							->setCallbackurl(null)
			  		   							->setOrderdescription(null)
			  		   							->setAddress1(null)
			  		   							->setAddress2(null)
			  		   							->setAddress3(null)
			  		   							->setAddress4(null)
			  		   							->setCity(null)
			  		   							->setState(null)
			  		   							->setPostcode(null)
			  		   							->setCountrycode(null)
			  		   							->setCardname(null)
			  		   							->setCardnumber(null)
			  		   							->setExpirydatemonth(null)
			  		   							->setExpirydateyear(null)
			  		   							->setStartdatemonth(null)
			  		   							->setStartdateyear(null)
			  		   							->setIssuenumber(null)
			  		   							->setCv2(null);
        
        $html = '<html><body>';
        $html.= $form->toHtml();
        $html.= '<div align="center"><img src="'.$this->getSkinUrl("images/paymentsense.gif").'"><p></div>';
        $html.= '<div align="center"><img src="'.$this->getSkinUrl("images/opc-ajax-loader.gif").'"><p></div>';
        $html.= '<div align="center">Verificando sus Datos, por favor espere...</div>';
        $html.= '<script type="text/javascript">document.getElementById("TransparentRedirectForm").submit();</script>';
        $html.= '</body></html>';
    	
    	return $html;
    }
    
    /**
     * Build the form for the Transparent Redirect 3DSecure authentication payment 
     *
     * @param unknown_type $szActionURL
     * @return unknown
     */
    private function _submitPaRes($szActionURL)
    {
    	$html = '';
    	
    	// create a Magento form
        $form = new Varien_Data_Form();
        $form->setAction($szActionURL)
	            ->setId('SubmitPaResForm')
	            ->setName('SubmitPaResForm')
	            ->setMethod('POST')
	            ->setUseContainer(true);
    	
      	$form->addField("HashDigest", 'hidden', array('name'=>"HashDigest", 'value'=>Mage::getSingleton('checkout/session')->getHashdigest()));
      	$form->addField("MerchantID", 'hidden', array('name'=>"MerchantID", 'value'=>Mage::getSingleton('checkout/session')->getMerchantid()));
      	$form->addField("CrossReference", 'hidden', array('name'=>"CrossReference", 'value'=>Mage::getSingleton('checkout/session')->getCrossreference()));
      	$form->addField("TransactionDateTime", 'hidden', array('name'=>"TransactionDateTime", 'value'=>Mage::getSingleton('checkout/session')->getTransactiondatetime()));
      	$form->addField("CallbackURL", 'hidden', array('name'=>"CallbackURL", 'value'=>Mage::getSingleton('checkout/session')->getCallbackurl()));
      	$form->addField("PaRES", 'hidden', array('name'=>"PaRES", 'value'=>Mage::getSingleton('checkout/session')->getPares()));
      	
       	 // reset the session items
        Mage::getSingleton('checkout/session')->setHashdigest(null)
    											->setMerchantid(null)
    											->setCrossreference(null)
    											->setTransactiondatetime(null)
    											->setCallbackurl(null)
    											->setPares(null);
        
        
        $html = '<html><body>';
        $html.= $form->toHtml();
        $html.= '<script type="text/javascript">document.getElementById("SubmitPaResForm").submit();</script>';
        $html.= '</body></html>';
    	
    	return $html;
    }
}