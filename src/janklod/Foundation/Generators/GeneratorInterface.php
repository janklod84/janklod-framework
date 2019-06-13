<?php 
namespace JK\Foundation\Generators;


/**
 * @package JK\Foundation\Generators\GeneratorInterface
*/ 
interface GeneratorInterface
{

/**
 * Blank of custom to generate
 * 
 * @return string
*/
public function generate();


/**
 * Blank of custom to generate
 * 
 * @return string
*/
public function blank();


}