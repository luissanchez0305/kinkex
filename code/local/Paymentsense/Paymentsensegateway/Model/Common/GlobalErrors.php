<?php

class Paymentsense_Paymentsensegateway_Model_Common_GlobalErrors
{	
	/*
	 * failure - probably a wrong card details entered in
	 * error - payment gateway communication and hashing related issues
	 */
	// failure - occurred in the processing of the final callback from the hosted payment form/transparent redirect
	const ERROR_183 = "El pago no se ha realizado correctamente y el checkout fue cancelado. <br/> Por favor, compruebe los datos de su tarjeta de crédito y vuelva a intentarlo.";
	
	// error - occurred during the partial processing of the callback from the transparent redirect page
	const ERROR_260 = "ERROR 260: The payment result couldn't be verified.";
	
	// error - direct integration transaction cannot be completed - problem in the communication with the payment gateway
	const ERROR_261 = "ERROR 261: Couldn't communicate with payment gateway.";
	
	// error - direct integration 3D Secure transaction couldn't be processed - problem in the communication with the paymwent gateway
	const ERROR_431 = "ERROR 431: Couldn't communicate with payment gateway to complete the 3D Secure authentication.";
	
	// failure - occurred during the processing of the data in the callback from the 3D Secure Authentication page
	const ERROR_7655 = "3D Secure payment was not successfull and checkout was cancelled.<br/>Please check your credit card details and try again.";
	
	// failure - server pull result related error: no URL variable present in the payment form to merchant webshop redirection
	const ERROR_309 ="ERROR 309: Missing parameters."; 
	
	// failure - server pull result related error: OrderID or CrossReference is missing from the URL variable list
	const ERROR_304 = "ERROR 304: The payment was rejected for a SECURITY reason: the incoming payment data was tampered with.";
	
	// faulire - server pull result related error: Magento web request to the hosted PaymentFormHandler failed while trying to retrieve the transaction details using the CrossReference
	const ERROR_329 = "ERROR 329: Error happened while trying to validate the transaction result.";
	
	// failure - server pull result related error: empty response due to invalid CrossReference
	const ERROR_381 = "ERROR 381: Invalid transaction details.";
}
?>