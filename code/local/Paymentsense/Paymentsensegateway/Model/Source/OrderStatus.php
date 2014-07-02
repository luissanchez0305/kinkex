<?php

class Paymentsense_Paymentsensegateway_Model_Source_OrderStatus
{
	public function toOptionArray()
    {
        return array(
        	 // override the order status and ONLY offer "processing" by default 
            array(
                'value' => 'processing',
                'label' => Mage::helper('paymentsensegateway')->__('Processing')
            ),
        );
    }
}