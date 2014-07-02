<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Observer
{
	/**
	 * Setup the attribute output handler
	 *
	 * @param Varien_Event_Observer $observer
	 * @return $this
	 */
	public function addCategoryImageHandlerObserver(Varien_Event_Observer $observer)
	{
		$observer->getEvent()
			->getHelper()
			->addHandler('categoryAttribute', $this);
		
		return $this;
	}
	
	/**
	 * Try to add smushed images
	 *
	 * @param Mage_Catalog_Helper_Output $outputHelper
	 * @param string $output
	 * @param array $params
	 * @return string
	 */
	public function categoryAttribute(Mage_Catalog_Helper_Output $outputHelper, $outputHtml, $params)
	{
		if (!isset($params['attribute']) || $params['attribute'] !== 'image') {
			return $outputHtml;
		}
		
		if (!isset($params['category'])) {
			return $outputHtml;
		}
		
		if (preg_match('/src="(.*)"/iU', $outputHtml, $match)) {
			$imageUrl = $match[1];
			$smushedUrl = Mage::getSingleton('smushit/image_type_catalog_category')->getSmushedImageFromUrl($imageUrl);
			
			if ($imageUrl !== $smushedUrl) {
				$outputHtml = str_replace($imageUrl, $smushedUrl, $outputHtml);
			}
		}

		return $outputHtml;
	}
		
	public function addSmushedSkinImagesObserver(Varien_Event_Observer $observer)
	{
		return $this;

		if (($headBlock = Mage::getSingleton('core/layout')->getBlock('head')) !== false) {
			$items = $headBlock->getItems();

			foreach($items as $key => $item) {
				if ($item['if'] || $item['type'] !== 'skin_css') {
					continue;
				}
				
				echo 'Orig URL: ' . Mage::getDesign()->getSkinUrl($item['name']) . '<br/>';
				echo 'Smushed: ' . Mage::getBaseDir('media') . DS . 'css' . DS . 'smushit-' . basename($item['name']) . '<br/>';
				echo 'New Value: ' . dirname($item['name']) . DS . 'smushit-' . basename($item['name']);
				exit;
				
				
echo '<pre>';				print_r($item);exit;
				$originalCssFileUrl = Mage::getDesign()->getSkinUrl($item['name']);
				$localFile = $this->getSkinFileDir($item['name']);
				$minifiedFile = Mage::getBaseDir('media') . DS . $cssDir . DS . 'opti-' . $storeId . '-' . str_replace('/', '-', $item['name']);

				$item['name'] = '../../../../media/' . $cssDir . '/' . basename($minifiedFile);

				if (!$refresh && is_file($minifiedFile)) {
					$items[$key] = $item;
				}
				else if (($css = @file_get_contents($localFile)) !== false) {
					if (($css = $this->minifyCssString($css, dirname($originalCssFileUrl) . '/')) !== '') {
						if (@file_put_contents($minifiedFile, $css) && is_file($minifiedFile)) {
							$items[$key] = $item;
						}
					}
				}
			}
			
			$headBlock->setItems($items);
		}

		return $this;
	}
}
