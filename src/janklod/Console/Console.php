<?php 
namespace JK\Console;


/**
 * @package JK\Console\Console
*/ 
class Console
{
	  
  /**
   * @var \JK\Console\Command
  */
  private $invoker;


  /**
   * Constructor
   * @param \JK\Console\Command $invoker
   * @return void
  */
  public function __construct($invoker)
  {
  	    $this->invoker = $invoker;
  }

  
  /**
   * add input name
   * @param string $name 
   * @return 
  */
  public function addInput($name='')
  {
         
  }


  /**
   * add text
   * @param string $text 
   * @return 
  */
  public function addText($text='')
  {
         
  }


  /**
   * Execute all commands
   * @return mixed
  */
  public function execute()
  {
  	   // echo __METHOD__;
       
       /*
  	   $msg = "\n";

  	   for($i = 1; $i < 5; $i++)
  	   {
  	   	  $msg .= 'Bonjour Mr ' . $i . "\n";
  	   }
  	   return $msg;
  	   */
       $this->invoker->execute();

  }
}