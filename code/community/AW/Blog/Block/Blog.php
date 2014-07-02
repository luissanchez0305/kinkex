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
class AW_Blog_Block_Blog extends AW_Blog_Block_Abstract
{

    public function getPosts()
    {

        $collection = parent::_prepareCollection();

        $tag = $this->getRequest()->getParam('tag');
        if ($tag) {
            $collection->addTagFilter(urldecode($tag));
        }

        parent::_processCollection($collection);

        return $collection;
    }

    protected function _prepareLayout()
    {
        if ($this->isBlogPage() && ($breadcrumbs = $this->getCrumbs())) {

            parent::_prepareMetaData(self::$_helper);

            $tag = $this->getRequest()->getParam('tag', false);

            if ($tag) {
                $tag = urldecode($tag);
                $breadcrumbs->addCrumb('blog', array('label' => self::$_helper->getTitle(), 'title' => $this->__('Return to ' . self::$_helper->getTitle()), 'link' => $this->getBlogUrl()));
                $breadcrumbs->addCrumb('blog_tag', array('label' => $this->__('Tagged with "%s"', self::$_helper->convertSlashes($tag)), 'title' => $this->__('Tagged with "%s"', $tag)));
            } else {
                $breadcrumbs->addCrumb('blog', array('label' => self::$_helper->getTitle()));
            }
        }
    }

}
