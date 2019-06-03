<?php 

Q::setup(\DB::instance());
     Q::addTable('users');
     $user = new User($this->app);
     
     /*
     for($i=1; $i < 5; $i++)
     {
          Q::getTable()->create([
            'username' => 'John' . $i,
            'password' => md5('John'. $i),  
            'role'     => $i 
          ]);
     }
     */

     // $user->setId(10);
     // $user->setUsername('NEW Record JK 111!');
     // $user->setPassword(password_hash('DDWE', PASSWORD_BCRYPT));
     
     // $lastId = Q::getTable()->store($user);
     // echo $lastId;