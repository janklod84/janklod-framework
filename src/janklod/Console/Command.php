<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface; 

/**
 * Command Register [ Chain commands ]
 * @package JK\Console\Command 
*/ 
abstract class Command implements CommandInterface
{

/**
 * @var string $signature      [ Signature of command   ]
 * @var string $description   [ Description of command ]
*/
protected $signature   = 'command:test';
protected $description = 'description of command';


/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
   if(is_callable([$this, 'configure']))
   {  $this->configure(); }
}


/**
 * Add signature argument
 * 
 * @param string $signature 
 * @return void
*/
public function addSignature($signature='')
{
	  $this->signature = $signature;
	  return $this;
}


/**
 * Add description
 * 
 * @param string $description
 * @return self
*/
public function addDescription($description='')
{
   $this->description = $description;
   return $this;
}


/**
 * Get signature
 * 
 * @return string
*/
public function signature()
{
    return $this->signature;
}


/**
 * Get description
 * 
 * @return string
*/
public function description()
{
    return $this->description;
}


/**
 * Determine if input match signature
 * 
 * @param InputInterface $input 
 * @return bool
 */
public function match($input)
{
   return $input->argument(0) === $this->signature;
}


/**
 * Configuration command
 * 
 * @return void
*/
public function configure(){}


/**
 * Execute command
 * 
 * @param JK\Console\IO\InputInterface $input
 * @param JK\Console\IO\OutputInterface $output
 * 
 * @return mixed
*/
abstract public function execute(
InputInterface $input=null, 
OutputInterface $output=null
);


/**
* Roolback command
* @return mixed
*/
abstract public function undo();

}