<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\QueryBuilder 
*/ 
class QueryBuilder 
{
	  
	  /**
   	   * @var array $classBuilder
	   * @var array $sql
	   * @var array $values
	   * @var array $output
	  */
  	  private $classBuilder = [];
	  private $sql    = [];
	  public  $values = [];
	  private $output = [];
	  private $condition = false;

      const QTYPES = [
      	'Select', 
      	'Insert', 
      	'Update', 
      	'Delete'
      ];

	  /**
	   * Constructor
	   * @return void
	  */
	  public function __construct()
	  {
          // TO Implements
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
           $this->addBuilderClass('Select');
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
          $this->addBuilderClass('From');
          return $this;
	  }

      
	  /**
	    * Must to add more functionalites for WHERE
	    * Conditions
	    * where('id', 3)
	    * by default $operator is '='
	    * 
	    * @param string $column
	    * @param string $value
	    * @param string $operator
	     * @return $this
       */
	   public function where($column='', $value='', $operator = '='): self
	   {
	   	    $field = sprintf('`%s`', $column);
	        if($alias = $this->sql['table.alias'])
	        {
                 $field = sprintf('`%s`.`%s`', $alias, $column);
	        }
	        $where = sprintf('%s %s %s', $field, $operator, '?');
	        $this->sql['where'][] = $where;
	        $this->values[] = $value;
	        $this->addBuilderClass('Where');
	        return $this;
	   }


       
       /**
        * Limit
        * @param string $limit
        * @return self
       */
	   public function limit($limit='')
	   {
	   	   $this->sql['limit'] = $limit;
	   	   $this->addBuilderClass('Limit');
	   	   return $this;
	   }

       
       
       /**
        * Add alias table
        * @param string $alias 
        * @return self
       */
       public function alias($alias='')
       {
       	    $this->sql['table.alias'] = $alias;
            return $this;
       }

       
       /**
        * Set data
        * @param array $data 
        * @return self
       */
       public function set($data=[])
       {
       	   $this->sql['set'] = array_keys($data);
	   	   $this->values = array_values($data);
	   	   $this->addBuilderClass('Set');
           return $this;
       }

       
       /**
        * Insert data
        * @param string $table 
        * @param array $params 
        * @return self
       */
	   public function insert($table, $params = [])
	   {
	   	    $this->clear();
	   	    $this->sql['table'] = $table;
	   	    $this->sql['insert'] = array_keys($params);
	   	    $this->values = array_values($params);
	   	    $this->addBuilderClass('Insert');
            return $this;
	   }


       /**
        * Update data
        * @param string $table 
        * @param string $alias
        * @return self
       */
	   public function update($table, $alias = '')
	   {
	   	    $this->clear();
	   	    $this->sql['table'] = $table;
	   	    $this->sql['table.alias'] = $alias;
	   	    $this->addBuilderClass('Update');
            return $this;
	   }


      
      /**
       * Query output
       * @return string
      */
	  public function sql()
	  {
   	  	   foreach($this->classBuilder as $builder)
           {
           	    $output = $this->callBuilder($builder);
           	    if($builder === 'Where')
           	    {
           	        $output = sprintf(' WHERE %s', $output);
           	    }
                $this->output[] = $output;
           }
   	  	
          return join(' ', $this->output);
	  }

      
      
      /**
       * Add class name for building parts
       * @param string $name 
       * @return void
      */
      private function addBuilderClass(string $name)
      {
      	   if(!in_array($name, $this->classBuilder))
	       {
	            $this->classBuilder[] = $name;
	       }
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

          if(!class_exists($class))
          {
          	  die(sprintf('Class <strong>%s</strong> does not exist!', $class));
          }

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
	  	  $this->output = [];
	  	  $this->classBuilder = [];
	  }
}