<?php 
namespace app\controllers\blog;


use \Auth;
use \Url;
use app\models\Manager\PostManager;
use \Query;

/**
 * @package app\controllers\blog\PostController 
*/ 
class PostController extends BaseController
{
     

/**
 * Do all behaviours before actions
 * 
 * @return 
*/
public function before()
{    
     // redirect user if is logged
     if(Auth::isLogged())
     {
          redirect('/admin');
     }
     
} 


/**
* Constructor
* 
* @param \JK\Container\Contracts\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     parent::__construct($app);
}


/**
* Action index
* 
* @return void
*/
public function index()
{
   // $posts = (new PostManager())->findAll(); Testing
   $manager = new PostManager();
   [$posts, $pagination] = $manager->findPaginated();
   $link = '';
   $this->render('blog.posts.index', compact('posts', 'pagination', 'link'));
   // Query::output();
}


/**
 * Action Show
 * 
 * @param string|null $slug 
 * @param int|null $id 
 * @return void
*/
public function show(string $slug=null, int $id = null)
{

  $post = (new PostManager())->find($id);
  (new CategoryManager())->hydratePosts([$post]);

  // a celui de l'URL on fait une redirection
  if($post->getSlug() !== $slug)
  {
    $url = base_url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: '. $url);
    exit;
  }
}

}