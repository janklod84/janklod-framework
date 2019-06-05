<?php 
namespace JK\Database\Seed;

use \Q;

/**
 * @package JK\Database\Seed\Seeder 
*/ 
class Seeder 
{

	 public function fake()
	 {
		 // Test something ..
 	   	 for($i=1; $i < 5; $i++)
	     {
	          Q::table('users')->create([
	            'username' => 'John' . $i,
	            'password' => md5('John'. $i),  
	            'role'     => $i 
	          ]);
	     }
	 }
}