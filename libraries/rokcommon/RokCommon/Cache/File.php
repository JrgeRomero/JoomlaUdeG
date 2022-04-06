<?php
/**
 * @version   $Id: File.php 10831 2013-05-29 19:32:17Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2020 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokCommon_Cache_File extends RokCommon_Cache_AbstractCache
{

	/**
	 * Directory with ending slash!
	 *
	 * @var string
	 */
	protected $dir = '';

	/**
	 * Extension of cache file - with comma!
	 *
	 * @var string
	 */
	protected $ext = '.cache';

	/**
	 * @var bool
	 */
	protected $_locking = true;


	/**
	 * Constructor
	 *
	 * @param int $lifeTime
	 * @param     $dir
	 *
	 * @throws RokCommon_Cache_Exception
	 * @internal param string $cachedir Directory - without ending slash!
	 */
	public function __construct($dir, $lifeTime = self::DEFAULT_LIFETIME)
	{
		parent::__construct($lifeTime);
		$container = RokCommon_Service::getContainer();
		/** @var $platforminfo RokCommon_IPlatformInfo */
		$platforminfo = $container->platforminfo;
		$dir          = $platforminfo->getRootPath() . $dir;

		if (!empty($dir) && $this->checkDirectory($dir)) $this->dir = $dir; else if (!$this->checkDirectory($this->dir)) {
			throw new RokCommon_Cache_Exception('Unable to use given directory. Check file permissions.');
		}
	}

	/**
	 * Sets data to cache
	 *
	 * @param string $groupName  Name of group of cache
	 * @param string $identifier Identifier of data
	 * @param mixed  $data       Data
	 *
	 * @return boolean
	 */
	public function set($groupName, $identifier, $data)
	{
		if (!$this->checkDirectory($this->createPath($groupName))) return false;
		$written = false;
		$path    = $this->createPath($groupName, $identifier);
		$die     = '<?php die("Access Denied"); ?>' . "\n";

		// Prepend a die string

		$data = $die . $data;

		$fp = @fopen($path, "wb");
		if ($fp) {
			if ($this->_locking) {
				@flock($fp, LOCK_EX);
			}
			$len = strlen($data);
			@fwrite($fp, $data, $len);
			if ($this->_locking) {
				@flock($fp, LOCK_UN);
			}
			@fclose($fp);
			$written = true;
		}

		// Data integrity check
		if ($written && ($data == file_get_contents($path))) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Gets data from cache
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier of data
	 *
	 * @return mixed
	 */
	public function get($groupName, $identifier)
	{

		if (time() - $this->modificationTime($groupName, $identifier) > $this->lifeTime) {
			$this->clearCache($groupName, $identifier);
			return false;
		}
		$data = false;
		$path = $this->createPath($groupName, $identifier);
		if (file_exists($path)) {
			$data = file_get_contents($path);
			if ($data) {
				// Remove the initial die() statement
				$data = preg_replace('/^.*\n/', '', $data);
			}
		}
		return $data;
	}

	/**
	 * Clears cache of specified identifier of group
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier
	 *
	 * @return boolean
	 */
	public function clearCache($groupName, $identifier)
	{
		@unlink($this->createPath($groupName, $identifier));
	}

	/**
	 * Clears cache of specified group
	 *
	 * @param string $groupName Name of group
	 *
	 * @return boolean
	 */
	public function clearGroupCache($groupName)
	{
		$this->deleteDir($this->createPath($groupName));
	}

	/**
	 * Clears all cache generated by this class with this driver
	 *
	 * @return boolean
	 */
	public function clearAllCache()
	{
		$this->deleteDir($this->dir, true);
	}


	/**
	 * Check if cache data exists
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier
	 *
	 * @return boolean
	 */
	public function exists($groupName, $identifier)
	{
		return is_file($this->createPath($groupName, $identifier));
	}

	/**
	 * Gets last modification time of specified cache data
	 *
	 * @param string $groupName  Name of group
	 * @param string $identifier Identifier
	 *
	 * @return int
	 */
	protected function modificationTime($groupName, $identifier)
	{
		return filemtime($this->createPath($groupName, $identifier));
	}


	/**
	 * Sets cache directory
	 *
	 * @param string $dir Path to directory - with ending slash!
	 *
	 * @return bool
	 */
	public function setDirectory($dir)
	{
		if ($this->checkDirectory($dir)) {
			$this->dir = $dir;
		} else {
			return false;
		}
		return true;
	}

	/**
	 * Sets cache file extension
	 *
	 * @param string $ext File extension
	 */
	public function setExtension($ext)
	{
		$this->ext = $ext;
	}

	/**
	 * Check directory if it exists and is writable. It tries to create directory and give it good permissions
	 *
	 * @param string $dir
	 *
	 * @return boolean
	 */
	protected function checkDirectory($dir)
	{
		if (!is_dir($dir) && mkdir($dir, 0777) == false) return false;
		if (!is_writable($dir) && chmod($dir, 0777) == false) return false;
		return true;
	}

	/**
	 * Deletes directory with content
	 *
	 * @param string  $dir Path to directory without ending slash
	 * @param boolean $contentOnly
	 */
	protected function deleteDir($dir, $contentOnly = false)
	{
		if (!$currentDir = @opendir($dir)) return;

		while (FALSE !== ($fileName = @readdir($currentDir))) {
			if ($fileName != "." && $fileName != "..") {

				if (is_dir($dir . '/' . $fileName)) {
					$this->deleteDir($dir . '/' . $fileName . '/');
				} else {
					@unlink($dir . '/' . $fileName);
				}
			}
		}
		@closedir($currentDir);

		if (!$contentOnly) @rmdir($dir);
	}

	/**
	 * Creates path to file/directory
	 *
	 * @param string $groupName
	 * @param string $identifier
	 *
	 * @return string
	 */
	protected function createPath($groupName, $identifier = NULL)
	{
		return $this->dir . '/' . $groupName . '/' . (empty($identifier) ? '' : $identifier . $this->ext);
	}
}
