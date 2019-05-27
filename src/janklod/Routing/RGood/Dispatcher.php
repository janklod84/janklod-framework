<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\Dispatcher 
*/ 
class Dispatcher 
{
       

 /**
  * @var mixed $callback
  * @var array $matches
 */
 private $callback;
 private $matches = [];


 /**
  * Constructor
  * @param $callback
  * @param $matches
  * @return void
 */
 public function __construct($callback, $matches=[])
 {
     $this->callback = $callback;
     $this->matches  = $matches;
 }


/**
  * Get callback
  * @return mixed
*/
public function getCallback()
{
   return $this->callback;
}


/**
 * Get Matches data
 * @return array
*/
public function getMatches()
{
   return $this->matches;
}

        
}