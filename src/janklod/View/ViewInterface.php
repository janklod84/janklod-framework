<?php 
namespace JK\View;


/**
 * @package JK\View\ViewInterface
*/
interface ViewInterface
{
	  
/**
 * show render view
 * @return mixed
*/
public function output();


/**
 * stringify output
 * @return string
*/
public function __toString();

}