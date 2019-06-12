<?php 
namespace JK\Foundation\Console\Generators;


use JK\Foundation\Application;


/**
 * @package JK\Foundation\Console\Generators\CustomGenerator
*/ 
abstract class CustomGenerator
{

/**
 * @var \JK\Console\IO\InputInterface $input
 * @var \JK\FileSystem\File $file
 * @var string $basePath
*/
protected $input;
protected $root = '';
protected $file;



/**
* Constructor
* 
* @param array $arguments
* @return void
*/
public function __construct($input)
{
    // input arguments
    $this->input = $input;

    // Access to file
    $this->file = Application::instance()->file;
}
  

/**
 * Get input argument
 * 
 * Ex: $this->input(1);
 * echo $this->input->argument(2). "\n";
 * 
 * @param type $key 
 * @return type
*/
public function input($key)
{
   return $this->input->argument($key) ?: null;
}


/**
 * Blank of custom to generate
 * 
 * @return string
*/
abstract public function generate();


/**
 * Blank of custom to generate
 * 
 * @return string
*/
abstract public function blank();
}