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
   * CodeIgniter URI Extender Class
   *
   * This class enables the URL to have multiple suffixes. The only difference
   * to you will initially notice is that you do not specify the extension
   * separator ("." - a full stop) in $config['url_suffix'].
   *
   * @package    CodeIgniter
   * @subpackage Libraries
   * @category   Libraries
   * @author     Alexander Baldwin
   * @copyright  (c) 2009 Alexander Baldwin
   * @license    http://www.opensource.org/licenses/mit-license.php MIT License
   * @link       <unknown>
   */
  class MY_URI extends CI_URI {
  	
  	public $url_suffix = false;
  	
  	/**
  	 * Constructor Function
  	 * 
  	 * Call the parent constructor function.
  	 * 
  	 * @access public
  	 * @return void
  	 */
  	function MY_URI() {
  		parent::CI_URI();
  	}
  	
  	/**
  	 * Remove URL Suffix
  	 * 
  	 * Remove the URL suffix and save it to a class property. If the suffix is
  	 * the defined default, don't bother saving it.
  	 * 
  	 * @access public
  	 * @return void
  	 */
  	function _remove_url_suffix() {
  		$regex = '|\.([a-zA-Z0-9]+)$|';
  		if(preg_match($regex, $this->uri_string, $matches)) {
  			if($this->config->item('url_suffix') != $matches[1]) {
  				$this->url_suffix = $matches[1];
  			}
  			$this->uri_string = preg_replace(
  			  '|\.' . preg_quote($matches[1]) . '$|',
  			  '',
  			  $this->uri_string
  			);
  		}
  	}
  	
  }