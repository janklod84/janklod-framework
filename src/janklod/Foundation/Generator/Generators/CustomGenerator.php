<?php 
namespace JK\Foundation\Generator\Generators;


use JK\Foundation\Application;
use JK\FileSystem\FileGenerator;
use JK\Foundation\Generator\GeneratorInterface;



/**
 * @package JK\Foundation\Generators\FileGenerator
*/ 
abstract class CustomGenerator extends FileGenerator implements GeneratorInterface
{

/**
 * @var InputInterface    $input      [ Input interface  ]
 * @var InputInterface    $output     [ Output interface ]
 * @var File              $file       [ File ]
 * @var string            $directory  [ Name of Directory ]
 * @var string            $name       [ Name of file or class name]
 * @var string            $success    [ Success Message ]
 * @var string            $fail       [ Fail  Message  ]
*/
protected $input;
protected $output;
protected $root;
protected $directory  = '';
protected $name    = '';
protected $success = 'Success operation!';
protected $fail    = 'Something went wrong'; // default message


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
 * Add name
 * 
 * @param string $name 
 * @return void
*/
public function addName($name='')
{
     $this->name = $name;
}


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
 * Add fail message
 * 
 * @param string $message 
 * @return void
*/
public function fail($message='')
{
     $this->fail = $message;
}


/**
* Generate controller
* 
* @return void
*/
public function make()
{
     $this->callAction([$this, 'put']);
}


/**
 * Delete generated file
 * 
 * @return bool
*/
public function delete()
{
   $this->callAction([$this, 'remove']);
}


/**
 * call Action
 * 
 * @param callable $callable
 * @return void
*/
protected function callAction(callable $callable)
{
	if(call_user_func($callable))
    {
       $this->output->writeln($this->success);

    }else{
       $this->output->writeln($this->fail);
    }
}



/**
 * Blank of custom to generate
 * 
 * @return string
*/
abstract public function blank();

}