<?php 
namespace JK\Template;


/**
 * @package JK\Template\ViewInterface
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