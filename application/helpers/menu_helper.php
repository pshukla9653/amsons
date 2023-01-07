<?php 

if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('activate_menu')) 
{
  function activate_menu($controller) 
  {
    // Getting CI class instance.
    $CI = get_instance();
    // Getting router class to active.
    $class = $CI->router->fetch_class();
    return ($class == $controller) ? 'active' : '';
  }  
}

if(!function_exists('active_link')) 
{
  function active_link($controller,$method_call) 
  {
    // Getting CI class instance.
    $CI = get_instance();
    // Getting router method to active.
    $class = $CI->router->fetch_class();
	$method = $CI->router->fetch_method();
    return ($class == $controller && $method == $method_call) ? 'active' : '';
  }  
}




if(!function_exists('date_dif')) 
{
  function date_dif($d1,$d2) 
  {
	$date1=date_create($d1);
	$date2=date_create($d2);
	$diff=date_diff($date1,$date2);
	return $diff->format("%R%a");   
  }  
}



?>