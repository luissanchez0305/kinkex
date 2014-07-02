<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders_Edit_Tab_Slides_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('advancedslider_slider_slides_grid');
        $this->setDefaultSort('grid_slide_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
        $this->setVarNameFilter('filter');
        $this->setUseAjax(true);
    }

    protected function _getSlider()
    {
        return Mage::registry('slider');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('advancedslider/slides')->getCollection()
            ->addFieldToFilter('slider_id', array('eq' => $this->_getSlider()->getId()));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('grid_slide_id', array(
            'index'     => 'slide_id',
            'header'    => $this->__('ID'),
            'width'     => '50px',
        ));

        $this->addColumn('grid_image', array(
            'index'     => 'image',
            'header'    => $this->__('Image'),
            'align'     => 'center',
            'sortable'  => false,
            'filter'    => false,
            'width'     => '150px',
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_image',
        ));

        $this->addColumn('grid_title', array(
            'index'     => 'title',
            'header'    => $this->__('Title'),
            'align'     => 'left',
        ));

        $this->addColumn('grid_link', array(
            'index'     => 'link',
            'header'    => $this->__('Link'),
            'width'     => '80px',
            'align'     => 'center',
            'sortable'  => false,
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_link',
        ));

        $types = Mage::getSingleton('advancedslider/source_type')->getOptionArray();
        $this->addColumn('grid_type', array(
            'index'     => 'type',
            'header'    => $this->__('Type'),
            'width'     => '80px',
            'type'      => 'options',
            'align'     => 'center',
            'options'   => $types,
        ));

        $statuses = Mage::getSingleton('advancedslider/source_status')->getOptionArray();
        $this->addColumn('grid_status', array(
            'index'     => 'status',
            'header'    => $this->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'type'      => 'options',
            'align'     => 'center',
            'options'   => $statuses,
        ));

        $this->addColumn('grid_position', array(
            'index'             => 'sort_order',
            'header'            => $this->__('Position'),
            'type'              => 'number',
            'validate_class'    => 'validate-number',
            'width'             => '60px',
            #'editable'          => true,
            'renderer'          => 'advancedslider/adminhtml_widget_grid_column_renderer_position',
        ));

        $this->addColumn('grid_action',
            array(
                'header'    =>  $this->__('Action'),
                'width'     => '70px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => $this->__('Edit'),
                        'url'       => array('base'=> 'advancedslider/slides/edit'),
                        'field'     => 'id',
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('grid_slide_id');
        $this->getMassactionBlock()->setFormFieldName('advancedslider_slide_id');

        $statuses = Mage::getSingleton('advancedslider/source_status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => $this->__('Change status'),
            'url' => $this->getUrl('*/slides/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'grid_status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => $this->__('Status'),
                    'values' => $statuses
                )
            )
        ));

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/slides/massDelete', array('_current' => true)),
            'confirm' => $this->__('Are you sure?')
        ));

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/slides', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        $chkValue = $row->getSlideId();
        return "javascript: fireCheckboxClick('advancedslider_slider_slides_grid_table', 'advancedslider_slide_id', '$chkValue');";
    }
}
