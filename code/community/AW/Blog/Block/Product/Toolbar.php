<?php

/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/LICENSE-L.txt
 *
 * @category   AW
 * @package    AW_Blog
 * @copyright  Copyright (c) 2009-2010 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/LICENSE-L.txt
 */
class AW_Blog_Block_Product_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{
    public function setCollection($collection)
    {
        parent::setCollection($collection);

        if ($this->getCurrentOrder() && $this->getCurrentDirection()) {
            $this->_collection->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
        }

        return $this;
    }

    public function getCurrentOrder()
    {
        $order = $this->getRequest()->getParam($this->getOrderVarName());

        if(!$order) {
            return $this->_orderField;
        }

        if(array_key_exists($order, $this->getAvailableOrders())) {
            return $order;
        }

        return $this->_orderField;

    }

    public function getCurrentMode()
    {
        return null;
    }

    public function getAvailableLimit()
    {
        return $this->getPost()->getAvailLimits();
    }

    public function getCurrentDirection()
    {
        $dir = $this->getRequest()->getParam($this->getDirectionVarName());

        if(in_array($dir, array('asc', 'desc'))) {
            return $dir;
        }

        return Mage::helper('blog')->defaultPostSort(Mage::app()->getStore()->getId());
    }

    public function setDefaultOrder($field)
    {
        $this->_orderField = $field;
    }


    public function getLimit()
    {
        return $this->getRequest()->getParam($this->getLimitVarName());
    }

}
