<?php 
namespace JK\Foundation\Generator;


/**
 * Class GeneratorAdapter
 *
 * @package JK\Foundation\Generator\GeneratorAdapter
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