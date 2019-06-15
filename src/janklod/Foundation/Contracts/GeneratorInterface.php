<?php 
namespace JK\Foundation\Contracts;


/**
 * @package JK\Foundation\Contracts\GeneratorInterface
*/ 
interface GeneratorInterface
{

/**
 * Generate file
 * 
 * @return string
*/
public function make();


/**
 * Delete generated file
 * 
 * @return bool
*/
public function delete();


/**
 * Blank of custom to generate
 * 
 * @return string
*/
public function blank();


}