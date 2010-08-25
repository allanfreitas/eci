<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package   CodeIgniter
 * @author    ExpressionEngine Dev Team
 * @copyright Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license   http://codeigniter.com/user_guide/license.html
 * @link    http://codeigniter.com
 * @since   Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

	/**
	 * CodeIgniter Zend Loader Class
	 *
	 * This class enables you to include the Zend Libraries to the include path,
	 * enable the autoloader and use any of the Zend Libraries on the fly.
	 * Providing you actually have the Zend Libraries, of course.
	 * Because of the way Zend uses namespaces in its classes (not to be confused
	 * with real namespaces, supported in PHP since 5.3), you don't need to worry
	 * about any libraries conflicting with any from CodeIgniter.
	 * Please remember to read the license regarding Zend's Framework before
	 * using.
	 *
	 * @package   CodeIgniter
	 * @subpackage  Libraries
	 * @category  Libraries
	 * @author    Alexander Baldwin
	 * @copyright  (c) 2009 Alexander Baldwin
	 * @license    MIT License
	 * @link    <unknown>
	 */
  class MY_Zend {

    protected $path = false,
              $loaded = false;

    /**
     * Constructor Function
     *
     * If the path has been passed in the params array, try to load the Zend
     * Libraries automatically.
     *
     * @access public
     * @param array $params
     * @return boolean
     */
    public function __construct($params = false) {
    	log_message('debug', 'Zend Class Initialized');
    	// If parameters have been passed whilst loading the library...
      if(is_array($params)) {
      	if(isset($params['path']) && is_string($params['path'])) {
      		$this->set_path($params['path']);
      		return $this->load();
      	}
      }
    }

    /**
     * Set Path
     * 
     * Set the path to the Zend Libraries, with simple checks (like, you know,
     * does it exist?).
     * 
     * @access public
     * @param string $path
     * @return boolean
     */
    public function set_path($path) {
    	$path = realpath($path);
    	$valid = is_string($path) && is_dir($path . '/Zend');
    	if($valid) {
    		// Set the path, getting rid of double path separators that may creep in
    		// due to inconsistant path. I'm looking at you Windows!
    		$this->path = realpath($path);
    	}
    	return $valid;
    }
    
    /**
     * Load Zend Libraries
     * 
     * Perform checks to make sure the Zend Libraries are there, then include
     * the Zend Autoloader and grab an instance of it.
     * 
     * @access public
     * @return boolean
     */
    public function load() {
    	if($this->loaded) {
    		return true;
    	}
    	if(!is_string($this->path)) {
    		return false;
    	}
    	$autoloader = 'Zend_Loader_Autoloader';
    	// Get the path from the class name, just like Zend does. We are using
    	// ".php" as the extension, instead of using the EXT constant because we
    	// are referencing a file that is part of a separate framework.
    	$relpath = str_replace('_', '/', $autoloader) . '.php';
    	$abspath = $this->path . '/' . $relfile;
    	// Check that the include path was successfully altered, that the file
    	// exists, and can be accessed using the relative path (second check that
    	// the include path was successfully altered).
    	if (!$this->set_include($path)
    	 || !file_exists($abspath)
    	 || !file_exists($relpath)
    	) {
    		return false;
    	}
    	// Include the file and grab an instance of the class.
    	require_once $autoloader;
    	if(!class_exists('Zend_Loader_Autoloader')) {
    		return false;
    	}
    	Zend_Loader_Autoloader::getInstance();
    	// Set a flag saying that we have now loaded it, so we don't repeat
    	// ourselves.
    	$this->loaded = true;
    	log_message('debug', 'Zend Libraries Loaded');
    	return true;
    }

    /**
     * Set Include Path
     * 
     * Nifty function for adding a path to PHP's global include path variable.
     * 
     * @access protected
     * @param string $path
     * @return boolean
     */
    protected function set_include($path) {
    	$path = realpath($path);
    	if(!is_string($path)) {
    		return false;
    	}
    	return set_include_path(
        implode(
          PATH_SEPARATOR,
          array(
            $path,
            get_include_path()
          )
        )
      );
    }
    
  }
