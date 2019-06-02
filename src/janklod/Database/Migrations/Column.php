<?php 
namespace JK\Database\Migrations;


/**
 * Modeling table column
 * @package JK\Database\Migrations\Column 
*/ 
class Column 
{
	 
/**
* @var string     $name           [ Name of column   ]
* @var string     $type           [ Type of column   ]
* @var int        $length         [ Length of column ]
* @var string     $default        [ Default value of column ]
* @var bool       $nullable       [ Nullable column ]
* @var bool       $autoincrement  [ Autoincrement column ]
*/
public $name;
public $type;
public $length;
public $default;
public $nullable = false;
public $autoincrement = false;

/**
* Constructor
* 
* @param array $params 
* @return void
*/
public function __construct($params=[])
{
     $this->setProperties($params);
}

/**
* Set properties
* 
* @param array $params 
* @return void
*/
public function setProperties($params)
{
if(!empty($params))
{
   foreach($params as $key => $value)
   {
	  if(!property_exists($this, $key))
	  {
          exit(
          sprintf('Sorry, Property <b>%s</b> does not exist in Column class!', $key)
          )
	  }
	  $this->{$key} = $value;
   }
}
}


/**
 * Make column nullable
 * If $this->nullable setted true ,
 * that mean column may be nullable
 * @return self
*/
public function nullable(): self
{
	 $this->nullable = true;
	 return $this;
}


}