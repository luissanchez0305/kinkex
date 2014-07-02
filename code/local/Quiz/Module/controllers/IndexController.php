<?php
class Quiz_Module_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/* 
		$module_id = $this->getRequest()->getParam('id');

  		if($module_id != null && $module_id != '')	{
			$module = Mage::getModel('module/module')->load($module_id)->getData();
		} else {
			$module = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($module == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$moduleTable = $resource->getTableName('module');
			
			$select = $read->select()
			   ->from($moduleTable,array('module_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$module = $read->fetchRow($select);
		}
		Mage::register('module', $module);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	
	public function viewAction()
    {
    
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	
}