<?php
class Quizvideo_Quetions_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/quetions?id=15 
    	 *  or
    	 * http://site.com/quetions/id/15 	
    	 */
    	/* 
		$quetions_id = $this->getRequest()->getParam('id');

  		if($quetions_id != null && $quetions_id != '')	{
			$quetions = Mage::getModel('quetions/quetions')->load($quetions_id)->getData();
		} else {
			$quetions = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($quetions == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$quetionsTable = $resource->getTableName('quetions');
			
			$select = $read->select()
			   ->from($quetionsTable,array('quetions_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$quetions = $read->fetchRow($select);
		}
		Mage::register('quetions', $quetions);
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