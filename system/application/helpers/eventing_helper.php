<?php

  if(!function_exists('a')) {
    function a($segments, $title, $options) {
    }
  }

  if(!function_exists('vardump')) {
    function vardump($var, $html = true) {
      ob_start();
      var_dump($var);
      $out = ob_get_contents();
      ob_end_clean();
      if($html) {
        $out = str_replace(' ', '&#160;', $out);
        $out = nl2br($out, true);
      }
      return $out;
    }
  }

  if(!function_exists('get_called_class')) {
    /**
     * Get Called Class Object
     *
     * To use the native get_called_class(), PHP 5.3 or greater must be
     * installed. Use this implementation by Chris Webb.
     * http://www.septuro.com/2009/07/php-5-2-late-static-binding-get_called_class-and-self-new-self/
     */
    class _get_called_class_object {
      static $i = 0;
      static $fl = null;
  
      static function get_called_class() {
        $bt = debug_backtrace();
        if(self::$fl == $bt[2]['file'].$bt[2]['line']) {
          self::$i++;
        }
        else {
          self::$i = 0;
          self::$fl = $bt[2]['file'].$bt[2]['line'];
        }
        $lines = file($bt[2]['file']);
        preg_match_all(
          '/([a-zA-Z0-9\_]+)::'.$bt[2]['function'].'/',
          $lines[$bt[2]['line']-1],
          $matches
        );
        return $matches[1][self::$i];
      }
    }
    /**
     * Get Called Class
     *
     * @return string
     */
    function get_called_class() {
      return _get_called_class_object::get_called_class();
    }
  }
  
  if(!function_exists('bool')) {
    /**
     * Check Boolean
     *
     * Returns boolean equivelant of value passed to function.
     *
     * @param mixed $var
     * @return boolean
     */
    function bool($var) {
      return $var === true ? true : false;
    }
  }
  
  if(!function_exists('bl')) {
    /**
     * Make Boolean
     *
     * Takes a variable, and makes into a boolean by reference.
     *
     * @param mixed $var
     * @return boolean
     */
    function bl(&$var) {
      $var = bool($var);
      return $var;
    }
  }
  
  if(!function_exists('xplode')) {
    /**
     * Xplode
     *
     * Same as the PHP explode() function, except if the second paramter is
     * an empty string it will return an empty
     * array, instead of an array containing an empty string.
     *
     * @param string $delimiter
     * @param string $string
     * @return array|false
     */
    function xplode($delimiter, $string) {
      if($string === '') {
      	return array();
      }
      $array = explode($delimiter, $string);
      array_unshift($array, null);
      unset($array[0]);
      return $array;
    }
  }
  
  if(!function_exists('elapsed_time')) {
    /**
     * Elapsed Time
     *
     * Return the elapsed time in seconds, between the time specified time
     * passed to the function (must be the return of the function microtime)
     * and now.
     *
     * @param  string|float $start
     * @return false|float
     */
    function elapsed_time($start) {
      // Grab the time now, so we can compare.
      $end = microtime(true);
      // The user probably passed the microtime as a string.
      $regex = '/^0\\.([0-9]+) ([0-9]+)$/';
      if (is_string($start)) {
        $start = preg_match($regex, $start)
        ? (float) preg_replace($regex, '$2.$1', $start)
        : false;
      }
      // We should also check the end time, because microtime(true) will
      // return a string is PHP is less than 5.
      if (is_string($end)) {
        $end = preg_match($regex, $end)
        ? (float) preg_replace($regex, '$2.$1', $end)
        : false;
      }
      if (!is_float($start) || !is_float($end)) {
        return false;
      }
      $elapsed_time = round($end - $start, 3);
      return $elapsed_time;
    }
  }

