<?php

class AW_Blog_Block_Last extends AW_Blog_Block_Menu_Sidebar implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        $this->setTemplate('aw_blog/widget_post.phtml');        
        if ($this->_helper()->getEnabled()) {            
            return $this->setData('blog_widget_recent_count', $this->getBlocksCount())->renderView();
        }
    }

}