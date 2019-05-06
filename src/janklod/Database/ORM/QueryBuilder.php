<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\QueryBuilder 
*/ 
class QueryBuilder 
{
	   
	   /**
	    * @var array $sql
	    * @var array $values
	   */
	   private $sql = [];
	   public  $values = [];


       
       /**
        * Select columns
        * select('column1', 'column2'...)
        * select('column1')
        * select('column1, column2')
        * 
        * @var string ...$columns [array]
        * @return $this
       */
	   public function select(...$columns)
	   {
	   	    $this->remove();
	      	$this->sql['select'] = Builder::select($columns);
	      	return $this;
	   }
 
       
       /**
        * Get table
        * from('name-of-table')
        * 
        * @param string $table 
        * @return $this
        */
	   public function from($table = null)
	   {
	   	   self::hasTable($table);
           $this->sql['from'] = Builder::from($table);
           return $this;
	   }


	   /**
        * Conditions
        * where($column, $value, $operator = '=')
        * 
        * @param string $column
        * @param string $value
        * @param string $operator
        * @return $this
       */
       public function where($column, $value, $operator = '='): self
       {
            $this->sql['where'][] = Builder::where($column, $operator, '?');
            $this->values[] = $value;
            return $this;
       }


       /**
         * Group by query
         * @param string|null $groupBy 
         * @return string
        */
        public function groupBy($groupBy = null)
        {
             $this->sql['group_by'] = Builder::groupBy($groupBy);
             return $this;
        }
      
        /**
         * Having query
         * @param string|null $havingSql 
         * @return string
        */
        public function having($havingSql = null)
        {
             $this->sql['group_by'] = Builder::having($havingSql);
             return $this;
        }

        
        /**
         * Truncate table
         * @param string|null $table 
         * @return string
        */
        public function truncate($table = null)
        {
              $this->remove();
              $this->sql['truncate'] = Builder::truncate($table);
              return $this;
        }



       /**
         * Query Order by
         * orderby('id', 'DESC')
         * 
         * @param $field
         * @param $sort
         * @return $this
       */
       public function orderby(string $field, $sort = 'ASC')
       {
            Builder::orderby($field, $sort);
            return $this;
       }


       /**
        * Limit query
        * limit(1)
        * 
        * @param $number
        * @return $this
       */
       public function limit($number)
       {
            $this->sql['limit'] = sprintf(' LIMIT %s', $number);
            return $this;
       }


       /**
         * Delete query
         * @return $this
       */
       public function delete()
       {
            $this->remove();
            $this->sql['delete'] = 'DELETE ';
            return $this;
       }

       
       /**
        * Update
        * @param string $table 
        * @return $this
       */
       public function update($table)
       {
           // QueryRepository::checkIfHasTable($table);
           $this->remove();
           $this->sql['update'] = sprintf('UPDATE %s ', $table);
           return $this;
       }


       /**
        * Insert query
        * insert('users')
        * @param string $table 
        * @return $this
       */
       public function insert($table = null)
       {
             // QueryRepository::checkIfHasTable($table);
             $this->remove();
             $this->sql['insert'] = sprintf('INSERT INTO %s ', $table);
             return $this;
       }


       /**
        * Set data 
        * [set] => SET id = ?, name = ?
        * 
        * @param array $data
        * @return $this
       */
       public function set($data = [])
       {
               $this->sql['set'] = 'SET ';

               if(!empty($data))
               {
                    foreach($data as $key => $value)
                    {
                          $this->sql['set'] .= sprintf(' %s = ?,', $key);
                          $this->values[] = $value;
                    }
                   
                    $this->sql['set'] = rtrim($this->sql['set'], ',');
                
               }
              
               return $this;
         }


         /**
            * Build query
            * @return string
          public function sql()
          {
              // return QueryRepository::getSql($this->sql);
          }
        */

       
       /**
        * Get Result
        * @return string
       */
       public function sql()
       {
       	  debug($this->sql);
       	  debug($this->values);
         //  echo implode(' ', $this->sql);
       }


       /**
        * Remove data
        * @return void
       */
	   public function remove()
	   {
	   	   $this->sql = [];
	   	   $this->values = [];
	   }


	   /**
         * Check if has table
         * @param string $table 
         * @return string
       */
	   private static function hasTable($table)
	   {
	    	if(is_null($table))
	        {
	            exit('Table name is required!');
	        }
	   }

}