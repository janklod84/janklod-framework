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
* @var string     $comments       [ Comments column ]
* @var bool       $nullable       [ Nullable column ]
* @var string     $collation      [ Interclassement Collation ]
* @var bool       $autoincrement  [ Autoincrement column ]
*/
public $name;
public $type;
public $length;
public $default;
public $comments = [];
public $nullable = false;
public $index = 'primary'; // [PRIMARY, UNIQUE, INDEX, FULLTEXT, SPATIAL]
public $collation = 'utf8_general_ci';
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
  	  $this->ensureProperty($key);
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


/**
 * Add interclassement 
 * If $this->collation('utf8_unicode'),
 * @param string $collation
 * @return self
*/
public function collation($collation): self
{
   $this->collation = $collation;
   return $this;
}


/**
 * Add interclassement 
 * If $this->comments([
 *  blablablablabla....
 *  blablablablabla....
 *  blablablablabla....
 *  blablablablabla....
 * ]),
 * @param string $collation
 * @return self
*/
public function comments($comments=[]): self
{
   /*
   $this->comments = array_merge(
      $this->comments, 
      $comments
   );
   */
   $this->comments = join(', ', $comments);
   return $this;
}



/**
 * Make sure has property inside class Column
 * @param string $key 
 * @return void
*/
private function ensureProperty($key)
{
  if(!property_exists($this, $key))
  {
     exit(
     	sprintf('Sorry, Property <b>%s</b> is not valid column property!', $key)
      );
  }
}

}