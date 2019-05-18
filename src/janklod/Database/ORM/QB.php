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



    /**
     * Constructor
     * @return void
    */
    public function __construct($table=null)
    {
         $this->sql['table'] = $table;
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
          $where = sprintf('`%s` %s %s', $column, $operator, '?');
          $this->sql['where'][] = $where;
          $this->values[] = $value;
          if(!in_array('Where', $this->classBuilder))
          {
             $this->classBuilder[] = 'Where';
          }
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
                $where = ($builder === 'Where') ? ' WHERE ' : '';
                $this->output[] = $where . $this->callBuilder($builder);
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