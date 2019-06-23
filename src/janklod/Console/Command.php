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
 * @var InputInterface    $input
 * @var OutputInterface   $output
 * @var string            $signature     [ Signature of command   ]
 * @var string            $description   [ Description of command ]
 * @var array             $arguments     [ arguments ]
*/
protected $input;
protected $output;
protected $signature = '';
protected $description = ['description of command'];
protected $arguments = [];

/**
 * Constructor
 * 
 * @param InputInterface|null  $input 
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
 * Add arguments
 * 
 * @param array $arguments 
 * @return void
*/
public function addArguments($arguments=[])
{
    $this->arguments = $arguments;
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
   if(strpos($this->signature, '{') !== false)
   {
       $this->signature = preg_replace(
        '#{([\w]+)}#', '', $this->signature
       );
    }
    return trim($this->signature);
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
 * Get option
 * 
 * @param  string $name 
 * @return string
*/
public function option($name='')
{
    // 
}


/**
 * Get all arguments
 * 
 * @return array
*/
public function arguments()
{
   return $this->arguments;
}


/**
 * Get argument
 * 
 * @param string $name [ user, create_users_table ..]
 * @return void
*/
public function argument($name="user")
{
    if($this->hasArgument($name))
    {
        return $this->arguments[2];
    }
}


/**
 * Determine if has argument
 * 
 * @param string $name 
 * @return bool
*/
protected function hasArgument($name): bool
{
    return strpos($this->signature, '{'. $name .'}') !== false 
           && isset($this->arguments[2]);
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