<?php
/**
 * @version		$Id: file.php 14401 2010-01-26 14:10:00Z louis $
 * @package		Joomla.Framework
 * @subpackage	Cache
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * File cache storage handler
 *
 * @package		Joomla.Framework
 * @subpackage	Cache
 * @since		1.5
 */
class JCacheStorageFile extends JCacheStorage
{
	/**
	* Constructor
	*
	* @access protected
	* @param array $options optional parameters
	*/
	function __construct( $options = array() )
	{
		parent::__construct($options);

		$config			=& JFactory::getConfig();
		$this->_root	= $options['cachebase'];
		$this->_hash	= $config->getValue('config.secret');
	}

	/**
	 * Get cached data from a file by id and group
	 *
	 * @access	public
	 * @param	string	$id			The cache data id
	 * @param	string	$group		The cache data group
	 * @param	boolean	$checkTime	True to verify cache time expiration threshold
	 * @return	mixed	Boolean false on failure or a cached data string
	 * @since	1.5
	 */
	function get($id, $group, $checkTime)
	{
		$data = false;

		$path = $this->_getFilePath($id, $group);
		$this->_setExpire($id, $group);
		if (file_exists($path)) {
			$data = file_get_contents($path);
			if($data) {
				// Remove the initial die() statement
				$data	= preg_replace('/^.*\n/', '', $data);
			}
		}

		return $data;
	}

	/**
	 * Store the data to a file by id and group
	 *
	 * @access	public
	 * @param	string	$id		The cache data id
	 * @param	string	$group	The cache data group
	 * @param	string	$data	The data to store in cache
	 * @return	boolean	True on success, false otherwise
	 * @since	1.5
	 */
	function store($id, $group, $data)
	{
		$written	= false;
		$path		= $this->_getFilePath($id, $group);
		$expirePath	= $path . '_expire';
		$die		= '<?php die("Access Denied"); ?>'."\n";

		// Prepend a die string

		$data		= $die.$data;

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
			@file_put_contents($expirePath, ($this->_now + $this->_lifetime));
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Remove a cached data file by id and group
	 *
	 * @access	public
	 * @param	string	$id		The cache data id
	 * @param	string	$group	The cache data group
	 * @return	boolean	True on success, false otherwise
	 * @since	1.5
	 */
	function remove($id, $group)
	{
		$path = $this->_getFilePath($id, $group);
		@unlink($path.'_expire');
		if (!@unlink($path)) {
			return false;
		}
		return true;
	}

	/**
	 * Clean cache for a group given a mode.
	 *
	 * group mode		: cleans all cache in the group
	 * notgroup mode	: cleans all cache not in the group
	 *
	 * @access	public
	 * @param	string	$group	The cache data group
	 * @param	string	$mode	The mode for cleaning cache [group|notgroup]
	 * @return	boolean	True on success, false otherwise
	 * @since	1.5
	 */
	function clean($group, $mode)
	{
		jimport('joomla.filesystem.folder');

		$return = true;
		$folder	= $group;

		if(trim($folder) == '') {
			$mode = 'notgroup';
		}

		switch ($mode)
		{
			case 'notgroup':
				$folders = JFolder::folders($this->_root);
				for ($i=0,$n=count($folders);$i<$n;$i++)
				{
					if ($folders[$i] != $folder) {
						$return |= JFolder::delete($this->_root.DS.$folders[$i]);
					}
				}
				break;
			case 'group':
			default:
				if (is_dir($this->_root.DS.$folder)) {
					$return = JFolder::delete($this->_root.DS.$folder);
				}
				break;
		}
		return $return;
	}

	/**
	 * Garbage collect expired cache data
	 *
	 * @access public
	 * @return boolean  True on success, false otherwise.
	 */
	function gc()
	{	
		jimport('joomla.filesystem.file');
		$result = true;
		// files older than lifeTime get deleted from cache
		$files = JFolder::files($this->_root, '_expire', true, true);
		foreach($files As $file) {
			$time = @file_get_contents($file);
			if ($time < $this->_now) {
				$result |= JFile::delete($file);
				$result |= JFile::delete(str_replace('_expire', '', $file));
			}
		}
		return $result;
	}

	/**
	 * Test to see if the cache storage is available.
	 *
	 * @static
	 * @access public
	 * @return boolean  True on success, false otherwise.
	 */
	function test()
	{
		$config	=& JFactory::getConfig();
		$root	= $config->getValue('config.cache_path', JPATH_ROOT.DS.'cache');
		return is_writable($root);
	}

	/**
	 * Check to make sure cache is still valid, if not, delete it.
	 *
	 * @access private
	 *
	 * @param string  $id   Cache key to expire.
	 * @param string  $group The cache data group.
	 */
	function _setExpire($id, $group)
	{
		$path = $this->_getFilePath($id, $group);

		// set prune period
		if(file_exists($path.'_expire')) {
			$time = @file_get_contents($path.'_expire');
			if ($time < $this->_now || empty($time)) {
				$this->remove($id, $group);
			}
		} elseif(file_exists($path)) {
			//This means that for some reason there's no expire file, remove it
			$this->remove($id, $group);
		}
	}

	/**
	 * Get a cache file path from an id/group pair
	 *
	 * @access	private
	 * @param	string	$id		The cache data id
	 * @param	string	$group	The cache data group
	 * @return	string	The cache file path
	 * @since	1.5
	 */
	function _getFilePath($id, $group)
	{
		$folder	= $group;
		$name	= md5($this->_application.'-'.$id.'-'.$this->_hash.'-'.$this->_language).'.php';
		$dir	= $this->_root.DS.$folder;

		// If the folder doesn't exist try to create it
		if (!is_dir($dir)) {

			// Make sure the index file is there
			$indexFile      = $dir . DS . 'index.html';
			@ mkdir($dir) && file_put_contents($indexFile, '<html><body bgcolor="#FFFFFF"></body></html>');
		}

		// Make sure the folder exists
		if (!is_dir($dir)) {
			return false;
		}
		return $dir.DS.$name;
	}
}
