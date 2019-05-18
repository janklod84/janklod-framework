<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\QueryBuilder 
*/ 
class QueryBuilder 
{
	  
	  /**
	   * @var string $table
   	   * @var array $classBuilder
	   * @var array $sql
	   * @var array $values
	   * @var array $output
	  */
	  private $table;
  	  private $classBuilder = [];
	  private $sql    = [];
	  public  $values = [];
	  private $output = [];



	  /**
	   * Constructor
	   * @return void
	  */
	  public function __construct($table=null)
	  {
	  	   $this->table = $table;
	  }
	  

      /**
       * Select 
       * @param type ...$selects 
       * @return self
      */
	  public function select(...$selects)
	  {
	  	   $this->clear();
           $this->sql['select'] = $selects;
           $this->classBuilder[] = 'Select';
           return $this;
	  }

      
      /**
       * From
       * @param string $table 
       * @param string $alias 
       * @return self
      */
	  public function from($table, $alias='')
	  {
          $this->sql['table'] = $table;
          $this->sql['table.alias'] = $alias;
          $this->classBuilder[] = 'From';
          return $this;
	  }

      
	  public function where()
	  {

	  }

      
      /**
       * Query output
       * @return string
      */
	  public function sql()
	  {
          foreach($this->classBuilder as $builder)
          {
               $this->output[] = $this->callBuilder($builder);
          }

          echo implode(' ', $this->output);
          debug($this->sql);
	  }


	  /**
       * Get buider class name
       * @param string $builder
       * @return string
      */
      private function callBuilder($builder)
      {
          $class = sprintf('\\JK\\Database\\ORM\\Builder\\%sBuilder', 
                          $builder
          );
          $classObj = new $class($this->sql);
          return $classObj->build();
      }
      
      /**
       * Remove values
       * @return void
      */
	  private function clear()
	  {
	  	  $this->sql = [];
	  	  $this->values = [];
	  }
}