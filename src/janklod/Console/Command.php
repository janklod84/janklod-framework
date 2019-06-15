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
 * @var InputInterface  $input
 * @var OutputInterface $output
 * @var string $signature         [ Signature of command   ]
 * @var string $description       [ Description of command ]
*/
protected $input;
protected $output;
protected $signature   = 'command:test';
protected $description = ['description of command'];



/**
 * Constructor
 * 
 * @param InputInterface|null $input 
 * @param OutputInterface|null $output 
 * @return void
 */
public function __construct(InputInterface $input = null, OutputInterface $output = null)
{
   $this->input = $input;
   $this->output = $output;

   if(is_callable([$this, 'configure'])) {  $this->configure(); }
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
   $this->description[] = $description;
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
 * @return bool
 */
public function match()
{
   return $this->input->argument(0) === $this->signature;
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
 * @return mixed
*/
abstract public function execute();


/**
* Roolback command
* @return mixed
*/
abstract public function undo();

}