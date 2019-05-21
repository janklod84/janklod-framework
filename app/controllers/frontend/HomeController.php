<?php 
namespace app\controllers\frontend;

use app\models\Manager\UserManager;
use app\models\Entity\User;



class HomeController extends BaseController
{
       
     /**
      * Action index
      * @return void
     */
	   public function index()
	   {

         // $user = new User();
         // $users = $user->findAll(); // OK debug($users);

         /*
         $user->setId(2);
         $userById = $user->findById();
         // debug($userById);
       
         $user->insert([
            'username' => 'Test2',
            'password' => 'Ok2',
            'role' => 1
         ]);
         */
         /*
         $db = \JK\Database\DatabaseManager::instance();
         $query = new \JK\ORM\Query($db);
         $builder = new \JK\ORM\QueryBuilder();
         
         $sql = $builder->select()
                        ->from('users')
                        ->where('id', 3);
                        //->sql();
         $result = $query->execute($sql, $builder->values)->results();
         debug($result);

         $insert = $builder->insert('users', [
                                'username' => 'Henry',  
                                'password' => md5('test'),  
                                'role' => '1'
                           ])->sql();
         
         $query->execute($insert, $builder->values, false);


         $update = $builder->update('users')
                           ->set(['username' => 'HP'])
                           ->where('id', 1)
                           ->sql();
         
         $query->execute($update, $builder->values, false);

         $query->queries();
         */
         
         return $this->render('home/index');
	   }
       
       
     /**
      * Action about
      * @return string
     */
     public function about()
     {
         $this->render('home/about');
     }


	   /**
       * Action contact
       * @return void
     */
	   public function contact()
	   {
	   	   if($this->isPost())
	   	   {
             /*
	   	   	   $posted = $this->request->post();
             $this->user->assign($posted);
             $this->user->saveUser();
             */
	   	   }
	   	   $this->render('home/contact');
	   }
}