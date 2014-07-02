<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options_Html
    extends WP_AdvancedSlider_Block_Adminhtml_Slides_Edit_Tab_General_Options
{
    protected function _addOptionsFields(&$fieldset)
    {
        $config['document_base_url']        = $this->getData('store_media_url');
        $config['store_id']                 = $this->getData('store_id');
        $config['add_variables']            = false;
        $config['add_widgets']              = Mage::helper('advancedslider')->getWysiwygAddWidgetsStatus();
        $config['add_directives']           = true; // --- since ver. 1.4.2.0
        $config['use_container']            = true;
        $config['hidden']                   = true;
        $config['container_class']          = 'hor-scroll';
        $config['directives_url']           = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $config['files_browser_window_url'] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index');

        $fieldset->addField('html', 'editor', array(
            'name'        => 'html',
            'label'       => $this->__('HTML'),
            'title'       => $this->__('HTML'),
            'style'       => 'height:200px;',
            'config'      => Mage::getSingleton('cms/wysiwyg_config')->getConfig($config),
            'wysiwyg'     => true,
            'required'    => false,
        ));
    }
}
