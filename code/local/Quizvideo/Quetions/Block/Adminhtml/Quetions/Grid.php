<?php

class Quizvideo_Quetions_Block_Adminhtml_Quetions_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('quetionsGrid');
      $this->setDefaultSort('quetions_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('quetions/quetions')->getCollection();
	 
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  

  protected function _prepareColumns()
  {
      $this->addColumn('quetions_id', array(
          'header'    => Mage::helper('quetions')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'quetions_id',
      ));
	  
	
		$sets = Mage::getModel('module/module')->getCollection()->addFieldToSelect('quizvideo_title');
		$sets_rebuild = array();
		foreach($sets as $row) {
	    		$sets_rebuild[] = $row['quizvideo_title'];
		}
		$sets = $sets_rebuild;
		//echo "<pre>";
		///print_r($sets);
		//echo "</pre>";
		
		
		$this->addColumn('quizvideotitle', array(
          'header'    => Mage::helper('quetions')->__('Quiz Video Title'),
          'align'     =>'left',
          'index'     => 'quizvideotitle',
          'type'      => 'options',
          'options'   =>  $sets,
          'filter_condition_callback' => array($this, '_applyMyFilter'),
      ));
   
	
		   $this->addColumn('quizquetion', array(
          'header'    => Mage::helper('quetions')->__('Quiz Quetion'),
          'align'     =>'left',
          'index'     => 'quizquetion',
      ));
	   
	    $this->addColumn('answer_1', array(
          'header'    => Mage::helper('quetions')->__('Answer 1'),
          'align'     =>'left',
          'index'     => 'answer_1',
      ));
	  
	  
	    $this->addColumn('answer_2', array(
          'header'    => Mage::helper('quetions')->__('Answer 2'),
          'align'     =>'left',
          'index'     => 'answer_2',
      ));
	  
	  
	  $this->addColumn('answer_3', array(
          'header'    => Mage::helper('quetions')->__('Answer 3'),
          'align'     =>'left',
          'index'     => 'answer_3',
      ));
	  
	  
	    $this->addColumn('answer_4', array(
          'header'    => Mage::helper('quetions')->__('Answer 4'),
          'align'     =>'left',
          'index'     => 'answer_4',
      ));
	  
	  
	    $this->addColumn('answer_5', array(
          'header'    => Mage::helper('quetions')->__('Answer 5'),
          'align'     =>'left',
          'index'     => 'answer_5',
      ));
	  
	    $this->addColumn('right_answer', array(
          'header'    => Mage::helper('quetions')->__('Right Answer'),
          'align'     =>'left',
          'index'     => 'right_answer',
      ));
	  
	    $this->addColumn('point', array(
          'header'    => Mage::helper('quetions')->__('Marks'),
          'align'     =>'left',
          'index'     => 'point',
      ));
	  

  			$this->addColumn('action',
            array(
                'header'    =>  Mage::helper('quetions')->__('Edit'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('quetions')->__('Edit'),
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
                'header'    =>  Mage::helper('quetions')->__('Delete'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('quetions')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('quetions')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('quetions')->__('XML'));
	  
      return parent::_prepareColumns();
  }
  
  protected function _applyMyFilter(Varien_Data_Collection_Db $collection, Mage_Adminhtml_Block_Widget_Grid_Column $column)
		{
				
			
		   $select = Mage::getModel('module/module')->getCollection()->getSelect();
		   $field = $column->getIndex();
		   $value = $column->getFilter()->getValue();
		//   echo $value;
		  $select->having("$field=?", $value);
		  // echo $select;
		}  
 

   protected function _prepareMassaction()
    {
        $this->setMassactionIdField('quetions_id');
        $this->getMassactionBlock()->setFormFieldName('quetions');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('quetions')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('quetions')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('quetions/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('quetions')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('quetions')->__('Status'),
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