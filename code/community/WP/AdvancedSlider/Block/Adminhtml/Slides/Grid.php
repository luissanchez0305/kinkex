<?php

class WP_AdvancedSlider_Block_Adminhtml_Slides_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('advancedslider_slides_grid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
        $this->setVarNameFilter('filter');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('advancedslider/slides')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slide_id', array(
            'header'    => $this->__('ID'),
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'slide_id',
        ));

        $this->addColumn('image', array(
            'header'    => $this->__('Image Preview'),
            'align'     => 'center',
            'index'     => 'image',
            'sortable'  => false,
            'filter'    => false,
            'width'     => '150px',
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_image',
        ));

        $this->addColumn('title', array(
            'header'    => $this->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));

        $this->addColumn('link', array(
            'header'    => $this->__('Link'),
            'width'     => '80px',
            'index'     => 'link',
            'align'     => 'center',
            'sortable'  => false,
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_link',
        ));

        $types = Mage::getSingleton('advancedslider/source_type')->getOptionArray();
        $this->addColumn('type', array(
            'header'    => $this->__('Type'),
            'width'     => '80px',
            'index'     => 'type',
            'type'      => 'options',
            'align'     => 'center',
            'options'   => $types,
        ));

        $statuses = Mage::getSingleton('advancedslider/source_status')->getOptionArray();
        $this->addColumn('status', array(
            'header'    => $this->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'align'     => 'center',
            'options'   => $statuses,
        ));

        $this->addColumn('sort_order', array(
            'header'    => $this->__('Position in Slider'),
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'sort_order',
        ));

        $this->addColumn('slider_id', array(
            'header'    => $this->__('Slider ID'),
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'slider_id',
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_sliderinfo',
        ));

        $this->addColumn('action',
            array(
                'header'    =>  $this->__('Action'),
                'width'     => '70px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => $this->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));
        $this->addExportType('*/*/exportXml', $this->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('advancedslider_slide_id');

        $statuses = Mage::getSingleton('advancedslider/source_status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => $this->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus'),
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
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => $this->__('Are you sure?')
        ));

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
