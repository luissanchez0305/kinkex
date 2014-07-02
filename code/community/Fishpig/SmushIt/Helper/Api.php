<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Helper_Api extends Mage_Core_Helper_Data
{		
	/**
	 * Smush.it API end point URL
	 *
	 * @const string
	 */
	const END_POINT = 'http://www.smushit.com/ysmush.it/ws.php';
	
	
	const SMUSHIT_EXCEPTION_NO_SAVINGS = 3455;
	
	/**
	 * Smush an image and return the Smush.it response
	 *
	 * @param string $url
	 * @return Varien_Object
	 */
	public function smush($url)
	{
		if (!$this->_hasValidCurlMethods()) {
			$ch = curl_init();
	
			curl_setopt($ch, CURLOPT_URL, $this->_getEndPointUrl($url));
			curl_setopt($ch, CURLOPT_USERAGENT, 'Smush.it/Magento');
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
			$response = curl_exec($ch);
	
			if (curl_errno($ch) || curl_error($ch)) {
				throw new Exception(Mage::helper('wordpress')->__('CURL (%s): %s', curl_errno($ch), curl_error($ch)));
			}
	
			curl_close($ch);
		}
		else {
			$curl = new Varien_Http_Adapter_Curl();
	
			$curl->setConfig(array(
				'header' => false,
				'timeout' => 30,
			));
	
			$curl->addOption(CURLOPT_USERAGENT, 'Smush.it/Magento');
	
			$curl->write(Zend_Http_Client::GET, $this->_getEndPointUrl($url), '1.1');
	
			$response = $curl->read();
	
			if ($curl->getErrno() || $curl->getError()) {
				throw new Exception(Mage::helper('core')->__('CURL (%s): %s', $curl->getErrno(), $curl->getError()));
			}
	
			$curl->close();
		}

		$result = new Varien_Object(json_decode($response, true));
		
		if ($result->getError()) {
			if ($result->getError() === 'No savings') {
				throw new Exception($this->__('The image cannot is already optimized and cannot be made smaller.'), self::SMUSHIT_EXCEPTION_NO_SAVINGS);
			}
			
			throw new Exception($this->__('Smush.it Error: %s', $result->getError()));
		}
		
		return $result;
	}

	/**
	 * Download a smushed image from Smush.it
	 *
	 * @param string $url
	 * @return blob
	 */
	public function downloadImage($url)
	{
		if (!$this->_hasValidCurlMethods()) {
			$ch = curl_init();
	
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Smush.it/Magento');
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
			$response = curl_exec($ch);
	
			if (curl_errno($ch) || curl_error($ch)) {
				throw new Exception(Mage::helper('wordpress')->__('CURL (%s): %s', curl_errno($ch), curl_error($ch)));
			}
	
			curl_close($ch);
		}
		else {
			
			$curl = new Varien_Http_Adapter_Curl();
	
			$curl->setConfig(array(
				'header' => false,
				'timeout' => 30,
			));
	
			$curl->addOption(CURLOPT_USERAGENT, 'Smush.it/Magento');
			$curl->addOption(CURLOPT_RETURNTRANSFER, true);
	
			$curl->write(Zend_Http_Client::GET, $url, '1.1');
	
			$response = $curl->read();
	
			if ($curl->getErrno() || $curl->getError()) {
				throw new Exception(Mage::helper('core')->__('CURL (%s): %s', $curl->getErrno(), $curl->getError()));
			}
	
			$curl->close();
		}

		return $response;
	}
	
	/**
	 * Retrieve end point URL for a image $url
	 *
	 * @param string $url
	 * @return string
	 */
	protected function _getEndPointUrl($url)
	{
		return self::END_POINT . '?img=' . str_replace('https://', 'http://', $url);
	}
	
	/**
	 * Has valid CURL methods
	 *
	 * @return bool
	 */
	protected function _hasValidCurlMethods()
	{
		return method_exists('Varien_Http_Adapter_Curl', 'addOption');
	}
}
