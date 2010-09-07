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
   * CodeIgniter Router Extender Class
   *
   * This class extension is to grab the suffix from the URI class, and map it
   * to which file to load.
   *
   * @package    CodeIgniter
   * @subpackage Libraries
   * @category   Libraries
   * @author     Alexander Baldwin
   * @copyright  (c) 2009 Alexander Baldwin
   * @license    http://www.opensource.org/licenses/mit-license.php MIT License
   * @link       <unknown>
   */
  class MY_Router extends CI_Router {
  	
  	/**
  	 * Constructor Function
  	 * 
  	 * Call the parent's constructor function.
  	 * 
  	 * @access public
  	 * @return void
  	 */
  	function MY_Router() {
  		parent::CI_Router();
  	}
  	
  }