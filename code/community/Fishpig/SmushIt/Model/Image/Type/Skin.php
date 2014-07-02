<?php
/**
 * @category    Fishpig
 * @package    Fishpig_SmushIt
 * @license      http://fishpig.co.uk/license.txt
 * @author       Ben Tideswell <ben@fishpig.co.uk>
 */

class Fishpig_SmushIt_Model_Image_Type_Skin extends Fishpig_SmushIt_Model_Image_Type_Abstract
{
	/**
	 * Get the image type code
	 *
	 * @return string
	 */
	public function getType()
	{
		return 'skin';
	}

	/**
	 * Get the URL for catalog_product images
	 *
	 * @param Fishpig_SmushIt_Model_Image $image
	 * @return string|false
	 */
	public function getUrl(Fishpig_SmushIt_Model_Image $image)
	{
		if ($image->getLocalFile()) {
			return $this->getDefaultUrl() . $image->getValue();
		}
		
		return false;
	}
	
	/**
	 * Get the local file for catalog_product images
	 *
	 * @param Fishpig_SmushIt_Model_Image $image
	 * @return string|false
	 */	
	public function getLocalFile(Fishpig_SmushIt_Model_Image $image)
	{
		if ($image->getValue()) {
			$localFile = $this->getDefaultDir() . $image->getValue();
			
			if (is_file($localFile)) {
				return $localFile;
			}
		}
		
		return false;
	}

	/**
	 * Retrieve the backup file
	 *
	 * @return string
	 */
	public function getSmushedFile(Fishpig_SmushIt_Model_Image $image)
	{
		return $this->getBackupDir($image) . str_replace('/', '_', trim($image->getValue(), '/'));
	}
		
	/**
	 * Get the default image directory
	 *
	 * @return string
	 */
	public function getDefaultDir()
	{
		return Mage::getBaseDir('skin') . DS . 'frontend';
	}
	
	/**
	 * Get the default image URL
	 *
	 * @return string
	 */
	public function getDefaultUrl()
	{
		return Mage::getBaseUrl('skin') . 'frontend';
	}
	
	public function refreshImageDatabase()
	{
		$files = $this->_getFilesFromSkinFolder();
		$dbFiles = $this->_getFilesFromDb();

		$delete = array_diff($dbFiles, $files);
		$insert = array_diff($files, $dbFiles);
		
		foreach($insert as $i => $value) {
			$insert[$i] = array(
				'value' => $value,
			);
		}

		$_write = $this->_getWriteAdapter();

		$_write->delete($this->getMainTable(), $_write->quoteInto('value IN (?)', $delete));
		$_write->insertMultiple($this->getMainTable(), $insert);
		
		return $this;
	}
	
	protected function _getFilesFromDb()
	{
		$select = $this->_getReadAdapter()
			->select()
			->distinct()
			->from($this->getMainTable(), 'value');
			
		return $this->_getReadAdapter()->fetchCol($select);
	}
	
	protected function _getFilesFromSkinFolder()
	{
		$baseFiles = $this->rscandir($this->getDefaultDir() . DS . 'base');
		$files = ',' . implode(',', $this->rscandir($this->getDefaultDir()));

		$files = preg_replace('/(\/base\/[^,]+,)/U', '', $files);

		foreach($baseFiles as $baseFile) {
			if (!preg_match('/(\/[^\/]+' . preg_quote(substr($baseFile, 5), '/') . ',)/U', $files, $matches)) {
				$files .= $baseFile . ',';
			}
		}
		
		return explode(',', trim($files, ','));
	}

	/**
	 * Scan $dir and return all directories and files in an array
	 *
	 * @param string $dir
	 * @return array
	 */
	public function rscandir($dir)
	{
		$files = array();
		
		foreach(scandir($dir) as $file) {
			if (trim($file, '.') === '') {
				continue;
			}
			
			$tmp = $dir . DS . $file;
			
			if (!is_dir($tmp)) {
				if (in_array(substr($tmp, -3), $this->_fileTypes)) {
					$files[] = str_replace($this->getDefaultDir(), '', $tmp);
				}
			}
			else {
				$files = array_merge($files, $this->rscandir($tmp));
			}
		}

		return $files;
	}
	
	protected $_fileTypes = array(
		'png',
		'jpg',
		'gif',
	);
	
	/**
	 * Check whether a file has been smushed and if it has, retun the smushed path instead
	 *
	 * @param string $localFile
	 * @return string
	 */
	public function getSmushedImageFromUrl($localFile)
	{
		if (strpos($localFile, $this->getDefaultUrl()) === 0) {
			$file = str_replace('/', '_', ltrim(substr($localFile, strlen($this->getDefaultUrl())), '/'));

			if (is_file($this->getBackupDir() . $file)) {
				return $this->getBackupUrl() . $file;
			}
		}
		
		return $localFile;
	}

}
