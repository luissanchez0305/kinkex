<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */
 
class Fishpig_SmushIt_Block_Adminhtml_Image_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	/**
	 * Set the grid block options
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->setId('smushit_grid');
		$this->setDefaultSort('savings');
		$this->setDefaultDir('desc');
		$this->setSaveParametersInSession(true);
	}

	/**
	 * Initialise and set the collection for the grid
	 *
	 */
	protected function _prepareCollection()
	{
		$this->setCollection(Mage::getResourceModel('smushit/image_collection'));
	
		return parent::_prepareCollection();
	}
    
	/**
	 * Add the columns to the grid
	 *
	 */
	protected function _prepareColumns()
	{
		$this->addColumn('type', array(
			'header'	=> $this->__('Type'),
			'align'		=> 'left',
			'index'		=> 'type',
			'type'		=> 'options',
			'options'	=> Mage::getResourceSingleton('smushit/image')->getImageTypeLabels(),
		));

		$this->addColumn('value', array(
			'header'	=> $this->__('Image'),
			'align'		=> 'left',
			'index'		=> 'value',
		));
		
		$this->addColumn('percentage_saved', array(
			'header'	=> $this->__('Compression Percentage'),
			'align'		=> 'left',
			'index'		=> 'percentage_saved',
			'type' => 'number',
		));

		$this->addColumn('is_smushed', array(
			'header'	=> $this->__('Smushed?'),
			'width'		=> '90px',
			'index'		=> 'is_smushed',
			'type'		=> 'options',
			'align' => 'right',
			'options'	=> array(
				1 => $this->__('Yes'),
				0 => $this->__('No'),
			),
		));

		$this->addColumn('smushed_at', array(
			'header' => Mage::helper('cms')->__('Date'),
			'index' => 'smushed_at',
			'type' => 'datetime',
			'align' => 'right',
		));

		$this->addColumn('action', array(
			'type'      => 'action',
			'getter'     => 'getId',
			'actions'   => array(array(
				'caption' => Mage::helper('catalog')->__('Smush'),
				'url'     => array(
				'base'=>'*/*/smush',
				),
				'field'   => 'id'
			)),
			'filter'    => false,
			'sortable'  => false,
			'align' 	=> 'center',
		));
		
		$this->addColumn('action', array(
//			'type'      => 'action',
		'renderer' => 'Fishpig_SmushIt_Block_Adminhtml_Image_Grid_Column_Renderer_Smush',
			'getter'     => 'getId',
			'actions'   => array(array(
				'caption' => Mage::helper('catalog')->__('Smush'),
				'url'     => array(
				'base'=>'*/*/smush',
				),
				'field'   => 'id'
			)),
			'filter'    => false,
			'sortable'  => false,
			'align' 	=> 'center',
		));

		return parent::_prepareColumns();
	}

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('image_id');
		$this->getMassactionBlock()->setFormFieldName('image');
	
		$this->getMassactionBlock()->addItem('smush', array(
			'label'=> $this->__('Smush Images'),
			'url'  => $this->getUrl('*/*/massSmush'),
		));
	}
	
	/**
	 * Retrieve the URL for the row
	 *
	 * @param Varien_Object $row
	 * @return string
	 */
	public function getRowUrl($row)
	{
		return null;
	}
}
