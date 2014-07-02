<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('advancedslider/form_slider_container.phtml');

        $this->_objectId = 'id';
        $this->_blockGroup = 'advancedslider';
        $this->_controller = 'adminhtml_sliders';

        $this->_updateButton('save', 'label', Mage::helper('adminhtml')->__('Save'));
        $this->_updateButton('save', 'onclick', 'saveSliderData();');
        $this->_updateButton('delete', 'label', Mage::helper('adminhtml')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        if ($id = $this->getRequest()->getParam('id'))
        {
            $this->_addButton('preview', array(
                'label'     => Mage::helper('adminhtml')->__('Preview'),
                'onclick'   => Mage::helper('advancedslider')->getSliderPreviewLink($id),
            ), -101);

            $this->_addButton('add_slide', array(
                'label'     => Mage::helper('advancedslider')->__('Add Slide'),
                'onclick'   => 'setLocation(\'' . Mage::helper('adminhtml')->getUrl('advancedslider/slides/new', array('slider' => $id)) . '\');',
            ), -102);
        }

        $this->_formScripts[] = "
            function saveSliderData()
            {
                removeMassactionValidations();
                editForm.submit();
            }

            function saveAndContinueEdit()
            {
                removeMassactionValidations();
                editForm.submit($('edit_form').action + 'back/edit/' + getActiveTabName());
            }

            function removeMassactionValidations()
            {
                // --- remove classes of Massaction elements ---
                if ($('advancedslider_slider_slides_grid_massaction-select'))
                    $('advancedslider_slider_slides_grid_massaction-select').removeClassName('required-entry');
                if ($('visibility'))
                    $('visibility').removeClassName('required-entry');
            }

            function getActiveTabName()
            {
                if ($('advancedslider_slider_tabs_general').hasClassName('active')) return 'tab/general';
                if ($('advancedslider_slider_tabs_slides').hasClassName('active')) return 'tab/slides';
                return '';
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('advancedslider_slider_data') && Mage::registry('advancedslider_slider_data')->getId())
        {
            $styleId    = Mage::registry('advancedslider_slider_data')->getStyle();
            $styles     = Mage::getSingleton('advancedslider/source_style')->getOptionArray();
            $style      = isset($styles[$styleId]) ? $this->htmlEscape($styles[$styleId]) : '';
            return $this->__("Edit Slider '%s' (%s)", $this->htmlEscape(Mage::registry('advancedslider_slider_data')->getName()), $style);
        }
        else
        {
            return $this->__('New Slider');
        }
    }

    protected function _prepareLayout()
    {
        if ($id = $this->getRequest()->getParam('id'))
        {
            $block = $this->getLayout()->createBlock('adminhtml/template')->setTemplate('advancedslider/embed_code.phtml');
            $block->addData(array('sliderId' => $id));
            $this->setChild('embed_code', $block);
        }
        return parent::_prepareLayout();
    }
}
