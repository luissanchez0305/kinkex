<?php
/**
 * Magmodules.eu
 * http://www.magmodules.eu
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magmodules.eu so we can send you a copy immediately.
 *
 * @category    Magmodules
 * @package     Magmodules_Kiyohsnippets
 * @author      Magmodules <info@magmodules.eu)
 * @copyright   Copyright (c) 2014 (http://www.magmodules.eu)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Magmodules_Kiyohsnippets_Helper_Data extends Mage_Core_Helper_Abstract {

	function getSnapshopRequest() 
	{
		$kiyoh_shop_id	= Mage::getStoreConfig('kiyohsnippets/api/shop_id');
		$filename 		= 'https://www.kiyoh.nl/widgetfeed.php?company=';

 		if($kiyoh_shop_id) {
			$xml = simplexml_load_file($filename . $kiyoh_shop_id);	
			if($xml) {
				$data = $xml->channel->description;
				$snippets = array(); 				
				
				// AVARAGE SCORE
				if (preg_match("/[0-9]+%/", $data, $matches)) {
					$snippets['avg'] = substr($matches[0], 0, -1);
				}
				
				// NUMBER OF REVIEWS
				$pieces = explode(' ', $data);
				$snippets['qty'] = array_pop($pieces);
				
				// SHOPNAME
				$snippets['shopname'] = 'shopname';								
				
				return $snippets;
			} else {
				return false;
			} 		
		} else {
			return false;		
		}	
	}
	
	function getKiyohLink() {			
		if(Mage::getStoreConfig('kiyohsnippets/api/show_link')) {
			$kiyoh_link = Mage::getStoreConfig('kiyohsnippets/api/kiyoh_link');
			return Mage::helper('kiyohsnippets')->__('on') . ' <a href="' . $kiyoh_link . '" target="_blank">Kiyoh</a>';
		} else {
			return false; 
		}		
	}

	function getKiyohStars($rating) 
	{	
		if(Mage::getStoreConfig('kiyohsnippets/api/show_stars')) {
			$perc  = $rating;
			$html  = '<div class="rating-box">';
			$html .= '	<div class="rating" style="width:' . $perc . '%"></div>';
			$html .= '</div>';
			return $html;
		} else {
			return false;
		}
	}

}
