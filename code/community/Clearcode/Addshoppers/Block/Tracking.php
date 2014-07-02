<?php

/**
 * CLS_AddShoppers
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@classyllama.com so we can send you a copy immediately.
 *
 * @category    Code
 * @package     CLS_AddShoppers
 * @copyright   Copyright (c) 2012 Classy Llama Studios, LLC (classyllama.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Tracking code block
 *
 * @package CLS_AddShoppers
 * @copyright Copyright (c) 2012 Classy Llama Studios, LLC
 * @author Nicholas Vahalik <nick@classyllama.com>
 */
class Clearcode_Addshoppers_Block_Tracking extends Clearcode_Addshoppers_Block_Abstract
{

    /**
     * If enabled, output the tracking code.
     *
     * @return string HTML Code
     */
    public function _toHtml()
    {
        if ($this->config->getEnabled()){
            return parent::_toHtml();
        }
    }

    /**
     * Returns TRUE if using the schema for finding the image.
     *
     * @return boolean
     */
    public function isUsingSchema()
    {
        return $this->config->getSchemaEnabled();
    }

    public function getOGButtonsStyle()
    {
        if($this->config->getOpenGraphEnabled() == 0)
            return "<style type=\"text/css\"> div.share-buttons-multi {display: none;}</style>";
    }

    /**
     * Returns the image url of the current product.
     *
     * @return string Image URL of current product.
     */
    public function getProductImage()
    {
        $currentProduct = Mage::registry('current_product');
        if($currentProduct) {
            return $currentProduct->getImageUrl();
        }
        return '';
    }

    /**
     * Returns the product's canonical URL
     *
     * @return string Canonical URL page
     * */
    public function getProductUrl()
    {
        return Mage::registry('product')->getProductUrl();
    }

    /**
     * Returns the product's name.
     *
     * @return string Canonical URL page
     * */
    public function getProductDescription()
    {
        return Mage::registry('product')->getProductUrl();
    }

    /**
     * Returns the JSON-encoded configuration for the Tracking system. 
     *
     * @return string
     * */
    public function getJSONConfig()
    {
        $data = array();

        $product = Mage::registry('product');

        if(!$this->isUsingSchema() && !is_null($product)) {
            $data['image'] = $this->getProductImage();
            $data['url'] = $product->getProductUrl();
            $data['product'] = $product->getName();
            $data['description'] = $product->getDescription();
            $data['stock'] = $product->getIsInStock() ? 'In stock' : 'Out of stock';
            $data['price'] = $this->getProductPrice();

            $ratingData = Mage::getModel('rating/rating')->getEntitySummary($product->getId());
            if($ratingData->getCount() > 0) {
                $ratingAverage = ($ratingData->getSum() / $ratingData->getCount()) / 20;
                $data['rating'] = round($ratingAverage);
            }
        }

        return Mage::helper('core')->jsonEncode((object) $data);
    }

    public function getProductPrice()
    {
        $product = Mage::registry('product');
        $price = $product->getFinalPrice();
        $priceWithTax = Mage::helper('tax')->getPrice($product, $product->getFinalPrice(), true);

        $inFlag = Mage::helper('tax')->displayPriceIncludingTax();

        $finalPrice = ($inFlag) ? $priceWithTax : $price;

        return Mage::helper('core')->formatCurrency($finalPrice);
    }

    public function getOGTags()
    {
        $html = "";
        $product = Mage::registry('product');
        if($this->isUsingSchema() && !is_null($product)) {
            //name, url, description, image
            $html .= "<div itemscope itemtype=\"http://schema.org/Product\" style=\"display: none;\">";
            $html .= "  <div itemprop=\"name\">" . $product->getName() . "</div>";
            $html .= "  <div itemprop=\"description\">" . nl2br($product->getShortDescription()) . "</div>";
            $html .= "  <img itemprop=\"image\" src=\"" . $product->getImageUrl() . "\"/>";
            $html .= "  <div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\">";
            $html .= "      <div itemprop=\"price\">" . $this->getProductPrice() . "</div>";
            $html .= "  </div>";
            $html .= "</div>";
        }
        return $html;
    }

    public function getProductRating()
    {
        $product = Mage::registry('product');
        $productId = $product->getId();
        $reviews = Mage::getModel('review/review')
            ->getResourceCollection()
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addEntityFilter('product', $productId)
            ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)
            ->setDateOrder()
            ->addRateVotes();
        /**
         * Getting average of ratings/reviews
         */
        $avg = 0;
        $ratings = array();
        if(count($reviews) > 0) {
            foreach($reviews->getItems() as $review) {
                foreach($review->getRatingVotes() as $vote) {
                    $ratings[] = $vote->getPercent();
                }
            }
            $avg = array_sum($ratings) / count($ratings);
        }
        return ($avg / 100) * 5;
    }

    public function getAvailability()
    {
        $product = Mage::registry('product');
        $stocklevel = (int) Mage::getModel('cataloginventory/stock_item')
                ->loadByProduct($product)->getQty();
        switch($stocklevel) {
            case 0:
                return "Out of stock";
            default:
                return "In stock";
        }
    }
}
