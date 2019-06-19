<?php 
namespace JK\Exception\Contracts;


interface ErrorInterface
{

/**
 * Set Handler
 * 
 * @return void
 */
public function setHandler();

/**
 * Register Handler
 * 
 * @return void
*/
public function register();

}