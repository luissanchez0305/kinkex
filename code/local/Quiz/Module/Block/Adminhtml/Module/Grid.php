<?php

class Quiz_Module_Block_Adminhtml_Module_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('moduleGrid');
      $this->setDefaultSort('module_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('module/module')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('module_id', array(
          'header'    => Mage::helper('module')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'module_id',
      ));

      $this->addColumn('quizvideo_title', array(
          'header'    => Mage::helper('module')->__('Quiz Video Title'),
          'align'     =>'left',
          'width'     => '180px',
          'index'     => 'quizvideo_title',
      ));

	 

      $this->addColumn('status', array(
          'header'    => Mage::helper('module')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('module')->__('Edit'),
                'width'     => '50',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('module')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		
		 $this->addColumn('action1',
            array(
                'header'    =>  Mage::helper('module')->__('Delete'),
                'width'     => '50',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('module')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('module')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('module')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('module_id');
        $this->getMassactionBlock()->setFormFieldName('module');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('module')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('module')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('module/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('module')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('module')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}