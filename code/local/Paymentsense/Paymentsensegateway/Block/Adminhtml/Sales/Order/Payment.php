<?php
class Paymentsense_Paymentsensegateway_Block_Adminhtml_Sales_Order_Payment extends Mage_Adminhtml_Block_Sales_Order_Payment
{
    public function setPayment($payment)
    {
    	parent::setPayment($payment);
        $paymentInfoBlock = Mage::helper('payment')->getInfoBlock($payment);

        if ($payment->getMethod() == 'paymentsensegateway')
        {

            $paymentInfoBlock->setTemplate('payment/info/cc_paymentsensegateway.phtml');
        }

        $this->setChild('info', $paymentInfoBlock);
        $this->setData('payment', $payment);
        return $this;
    }

    protected function _toHtml()
    {
        return $this->getChildHtml('info');
    }

}
