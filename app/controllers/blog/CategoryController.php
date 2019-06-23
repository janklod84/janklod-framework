<?php 
namespace app\controllers\blog;


use \Auth;
use \Url;
use app\models\Manager\{
  CategoryManager,
  PostManager 
};


/**
 * @package app\controllers\blog\CategoryController 
*/ 
class CategoryController extends BaseController
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
 * Action show
 * 
 * @param string $slug 
 * @param int $id 
 * @return void
 */
public function show(string $slug=null, int $id=null)
{
   $category = (new CategoryManager())->find($id);
   if($category->getSlug() !== $slug)
   {
      $url = base_url('category', 
      ['slug' => $category->getSlug(), 'id' => $id]
      );  
      response()->setCode(301); // redirect permanently
      redirect($url);
   }

   $title = "Categorie {$category->getName()}";
   [$posts, $pagination] = (new PostManager())->findPaginatedForcategory($category->getID());

   // 
   $link = base_url('category', 
   ['id' => $category->getID(), 
   'slug' => $category->getSlug()
   ]);
   $this->render('blog.categories.show', 
   compact('posts', 'pagination', 'link', 'title')
   );
}




}