<?php 
namespace JK\Foundation\Console\Generator;


use JK\Foundation\Contracts\GeneratorInterface;


/**
 * Class GeneratorAdapter
 *
 * @package JK\Foundation\Console\Generator\GeneratorAdapter
*/ 
class GeneratorAdapter
{
     
/**
* Constructor
* 
* @param GeneratorInterface $generator 
* @return void
*/   
public function __construct(GeneratorInterface $generator)
{
    $this->generator = $generator;
}


/**
 * Make file
 * 
 * @return bool
*/
public function make()
{
    return $this->generator->make();
}


/**
 * Delete file
 * 
 * @return bool
*/
public function delete()
{
    return $this->generator->delete();
}



}