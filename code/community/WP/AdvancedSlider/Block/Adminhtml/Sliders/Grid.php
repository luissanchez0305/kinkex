<?php

class WP_AdvancedSlider_Block_Adminhtml_Sliders_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('advancedslider_sliders_grid');
        $this->setDefaultSort('slider_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
        $this->setVarNameFilter('filter');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('advancedslider/sliders')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('slider_id', array(
            'header'    => $this->__('ID'),
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'slider_id',
        ));

        $styles = Mage::getSingleton('advancedslider/source_style')->getOptionArray();
        $this->addColumn('style', array(
            'header'    => $this->__('Style'),
            'width'     => '100px',
            'index'     => 'style',
            'type'      => 'options',
            'align'     => 'center',
            'options'   => $styles,
        ));

        $this->addColumn('name', array(
            'header'    => $this->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('width', array(
            'header'    => $this->__('Width (px)'),
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'width',
        ));

        $this->addColumn('height', array(
            'header'    => $this->__('Height (px)'),
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'height',
        ));

        $targets = Mage::getSingleton('advancedslider/source_linktarget')->getOptionArray();
        $this->addColumn('link_target', array(
            'header'    => $this->__('Link Target'),
            'width'     => '100px',
            'index'     => 'link_target',
            'align'     => 'center',
            'type'      => 'options',
            'options'   => $targets,
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

        $this->addColumn('preview', array(
            'header'    => $this->__('Preview'),
            'width'     => '70px',
            'index'     => 'slider_id',
            'align'     => 'center',
            'sortable'  => false,
            'filter'    => false,
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_sliderpreview',
        ));

        $this->addColumn('add_slide', array(
            'header'    => $this->__('Add Slide'),
            'width'     => '70px',
            'index'     => 'slider_id',
            'align'     => 'center',
            'sortable'  => false,
            'filter'    => false,
            'renderer'  => 'advancedslider/adminhtml_widget_grid_column_renderer_addslide',
        ));

        $this->addColumn('edit',
            array(
                'header'    =>  $this->__('Edit'),
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
        $this->setMassactionIdField('slider_id');
        $this->getMassactionBlock()->setFormFieldName('advancedslider_slider_id');

        $statuses = Mage::getSingleton('advancedslider/source_status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => $this->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
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
