<?php 
namespace JK\Foundation\Generators;


use JK\Foundation\Application;
use JK\FileSystem\FileGenerator;



/**
 * @package JK\Foundation\Generators\FileGenerator
*/ 
abstract class CustomGenerator 
extends FileGenerator 
implements GeneratorInterface
{

/**
 * @var InputInterface    $input      [ Input interface  ]
 * @var InputInterface    $output     [ Output interface ]
 * @var File              $file       [ File ]
 * @var string            $directory  [ Name of Directory ]
 * @var string            $name       [ Name of File ]
 * @var string            $message    [ Message for file generated successfully ]
*/
protected $input;
protected $output;
protected $root;
protected $directory = '';
protected $message   = 'File successfully generated!';


/**
* Constructor
* 
* @param InputInterface $input
* @param OutputInterface $output
* @return void
*/
public function __construct($input, $output)
{
    // input and output
    $this->input = $input;
    $this->output = $output;
    $this->root   = Application::instance()->root();
    parent::__construct($this->root);
    $this->before();
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
 * Do something before generated action
 * 
 * @return void
*/
protected function before(){}



/**
 * Add success message
 * 
 * @param string $message
 * @return void
 */
public function success($message='')
{
     $this->success = $message;
}


/**
 * Blank of custom to generate
 * 
 * @return mixed
*/
public function generate()
{
	if($this->put())
    {
       $this->output->writeln($this->success);

    }else{
       $this->output->writeln('Something went wrong!');
    }
}


/**
 * Blank of custom to generate
 * 
 * @return string
*/
abstract public function blank();
}