<?php 
namespace app\controllers\blog;


use \Auth;
use \Url;
use app\models\Manager\{
  PostManager,
  CategoryManager
};
use \Query;

/**
 * @package app\controllers\blog\PostController 
*/ 
class PostController extends BaseController
{
     

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
   $manager = new PostManager();
   [$posts, $pagination] = $manager->findPaginated();
   $link = base_url();
   $this->render('blog.posts.index', compact('posts', 'pagination', 'link'));
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
  if($post->getSlug() !== $slug)
  {
    $url = base_url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: '. $url);
  }
  $this->render('blog.posts.show', compact('post'));
}

}