<?php

class Quiz_Result_Block_Adminhtml_Result_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('resultGrid');
      $this->setDefaultSort('result_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('result/result')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('result_id', array(
          'header'    => Mage::helper('result')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'result_id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('result')->__('Customer Name'),
          'align'     =>'left',
          'index'     => 'name',
      ));
	  
	   $this->addColumn('email', array(
          'header'    => Mage::helper('result')->__('Customer Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));
	  
	    $this->addColumn('quizvideo', array(
          'header'    => Mage::helper('result')->__('Quiz Video'),
          'align'     =>'left',
          'index'     => 'quizvideo',
      ));
	  
	   $this->addColumn('point', array(
          'header'    => Mage::helper('result')->__('Obtain Result in Marks'),
          'align'     =>'left',
          'index'     => 'point',
      ));
	  
	  

      $this->addColumn('status', array(
          'header'    => Mage::helper('result')->__('Status'),
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
                'header'    =>  Mage::helper('result')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('result')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('result')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('result')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('result_id');
        $this->getMassactionBlock()->setFormFieldName('result');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('result')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('result')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('result/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('result')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('result')->__('Status'),
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