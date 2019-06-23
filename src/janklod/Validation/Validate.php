<?php 
namespace JK\Validation;



/**
 * Этот класс , просто временная валидация
 * Данный фреймворк не будет поддерживать такое
 * Валидация будет совсем другой с хорошим подходом)
 * 
 * @package JK\Validation\Validate
*/
class Validate
{
	
/**
* @var bool
*/
private $passed = false;


/**
* @var array errors
*/
private $errors = [];


/**
* @var 
*/
private $pdo;



/**
* @var array
*/
private $translation = [];


/**
* Constructor 
*
* @param \PDO $void;
* @return void
*/
public function __construct(\PDO $pdo)
{
	    $this->pdo = $pdo;
}


/**
* Check source and items
* @param string $source 
* @param array $items 
* @return mixed
*/
public function check($source, $items = [])
{
	  foreach($items as $item => $rules)
	  {
	  	  foreach($rules as $rule => $rule_value)
	  	  {
	  	  	    $value = trim($source[$item]);
	  	  	    $item  = e($item);

	  	  	    if($rule === 'required' && empty($value))
	  	  	    {
                  $this->addError("{$item} is required");

	  	  	    }else if(!empty($value)){

                 switch($rule)
                 {
                 	  case 'min':
                         if(strlen($value) < $rule_value)
                         {
                            $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                         }
                 	  break;
                 	  case 'max':
                 	     if(strlen($value) > $rule_value)
                         {
                            $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                         }

                 	  break;
                 	  case 'matches':
                 	     if($value != $source[$rule_value])
                 	     {
                 	     	  $this->addError("{$rule_value} must match {$item}");
                 	     }

                 	  break;
                 	  case 'unique':
                    try
                    {
    						        $sql = sprintf('SELECT * FROM %s WHERE %s = ?', $rule_value, $item);
    						        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute([$value]);
    					          $check = $stmt->fetch();
                        // debug($check, true);
                        if($check)
                        {
                      	    $this->addError("{$item} already exists.");
                        }
                    }catch(\PDOException $e){
                        throw new \Exception($e->getMessage());
                        
                    }
                    break;
                 }
	  	  	    }
	  	  }
	  }


	  if(empty($this->errors))
	  {
	  	   $this->passed = true;
	  }

	  return $this;

}



/**
* Get errors
* @return type
*/
public function errors()
{
	  return $this->errors;
}


/**
* return true or false if no errors
* @return bool
*/
public function passed(): bool
{
	  return $this->passed;
}


/**
* Translate Message
* @param array $translation 
* @return void
*/
public function addTranslation($translation = [])
{
   $this->translation = $translation;
}


/**
* Get translation Message
* @param array $handler
* @return string
*/
public function getTranslate($handler)
{
   return str_replace(
   	    array_keys($this->translation), 
   	    array_values($this->translation), 
   	    $handler
   );
}


/**
* Add error
* @param string $error 
* @return void
*/
public function addError($error)
{
    $this->errors[] = $this->getTranslate($error);
}

}