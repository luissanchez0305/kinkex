<?php

require_once 'Mage/Catalog/controllers/ProductController.php';

class WP_AjaxShippingPriceCalculator_IndexController extends Mage_Catalog_ProductController
{
    public function indexAction()
    {
        $product = $this->_initProduct();
        $this->loadLayout(false);
        $block = $this->getLayout()->getBlock('shipping.calculator.result');
        if ($block)
        {
            $calculator = $block->getCalculator();
            $product->setAddToCartInfo((array)$this->getRequest()->getPost());
            $calculator->setProduct($product);
            $addressInfo = $this->getRequest()->getPost('calculator');
            $calculator->setAddressInfo((array)$addressInfo);
            $block->getSession()->setFormValues($addressInfo);
            try
            {
                $calculator->calculate();
            }
            catch (Mage_Core_Exception $e)
            {
                Mage::getSingleton('catalog/session')->addError($e->getMessage());
            }
            catch (Exception $e)
            {
                Mage::logException($e);
                Mage::getSingleton('catalog/session')->addError(
                    Mage::helper('wp_ajaxshippingpricecalculator')->__('There was an error during processing your shipping request')
                );
            }
        }
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();
    }
}
