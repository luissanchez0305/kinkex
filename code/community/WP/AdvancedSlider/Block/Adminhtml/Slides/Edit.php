<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'advancedslider';
        $this->_controller = 'adminhtml_slides';

        $this->_updateButton('back', 'label', Mage::helper('adminhtml')->__('Edit Slider'));
        $this->_updateButton('save', 'label', Mage::helper('adminhtml')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('adminhtml')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        if ($sliderId = Mage::registry('advancedslider_slide_data')->getSliderId())
        {
            $this->_addButton('slider_preview', array(
                'label'     => Mage::helper('adminhtml')->__('Preview'),
                'onclick'   => Mage::helper('advancedslider')->getSliderPreviewLink($sliderId),
                'title'     => Mage::helper('advancedslider')->__('Slider Preview'),
            ), -101);

            $this->_addButton('add_slide', array(
                'label'     => Mage::helper('advancedslider')->__('Add Slide'),
                'onclick'   => 'setLocation(\'' . Mage::helper('adminhtml')->getUrl('advancedslider/slides/new', array('slider' => $sliderId)) . '\');',
            ), -102);
        }

        $this->_formScripts[] = "
            function toggleEditor()
            {
                if (tinyMCE.getInstanceById('advancedslider_slide_html') == null)
                {
                    tinyMCE.execCommand('mceAddControl', false, 'advancedslider_slide_html');
                }
                else
                {
                    tinyMCE.execCommand('mceRemoveControl', false, 'advancedslider_slide_html');
                }
            }

            function saveAndContinueEdit()
            {
                editForm.submit($('edit_form').action + 'back/edit/' + getActiveTabName());
            }

            function getActiveTabName()
            {
                if ($('advancedslider_slide_tabs_general').hasClassName('active')) return 'tab/general';
                if ($('advancedslider_slide_tabs_advanced').hasClassName('active')) return 'tab/advanced';
                return '';
            }
        ";
    }

    public function getHeaderText()
    {
        $styleId    = Mage::registry('slider')->getStyle();
        $styles     = Mage::getSingleton('advancedslider/source_style')->getOptionArray();
        $style      = isset($styles[$styleId]) ? $this->htmlEscape($styles[$styleId]) : '';

        if (Mage::registry('advancedslider_slide_data') && Mage::registry('advancedslider_slide_data')->getId())
        {
            return $this->__("Edit Slide '%s' (%s)", $this->htmlEscape(Mage::registry('advancedslider_slide_data')->getTitle()), $style);
        }
        else
        {
            return $this->__('New Slide (%s)', $style);
        }
    }

    public function getBackUrl()
    {
        $id = Mage::registry('advancedslider_slide_data')->getSliderId();
        return Mage::helper('adminhtml')->getUrl('advancedslider/sliders/edit', array('id' => $id, 'tab' => 'slides'));
    }
}
