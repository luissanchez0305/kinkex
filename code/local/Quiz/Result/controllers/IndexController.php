<?php
class Quiz_Result_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/result?id=15 
    	 *  or
    	 * http://site.com/result/id/15 	
    	 */
    	/* 
		$result_id = $this->getRequest()->getParam('id');

  		if($result_id != null && $result_id != '')	{
			$result = Mage::getModel('result/result')->load($result_id)->getData();
		} else {
			$result = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($result == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$resultTable = $resource->getTableName('result');
			
			$select = $read->select()
			   ->from($resultTable,array('result_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$result = $read->fetchRow($select);
		}
		Mage::register('result', $result);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}