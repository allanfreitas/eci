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