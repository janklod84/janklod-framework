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
   	      $this->{$key} = $value;
       }
   }
}


/**
 * Make column nullable
 * 
 * @return self
*/
public function nullable()
{
	 $this->nullable = true;
	 return $this;
}


}