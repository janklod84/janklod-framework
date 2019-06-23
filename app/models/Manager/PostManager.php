<?php 
namespace app\models\Manager;


use app\models\Entity\Post;
use JK\Database\PaginatedQuery;


/**
 * @package app\models\Manager\PostManager 
*/ 
class PostManager  extends BaseManager
{
    
 /**
  * @var string $table
  * @var string $class
 */
 protected $table = 'post';
 protected $class = Post::class;


 /**
  * Find Paginated Query
  * 
  * @return 
 */
 public function findPaginated()
 {
       $query = "SELECT * FROM post ORDER BY created_at DESC";
       $queryCount = 'SELECT COUNT(id) FROM post';
       $pagination = new PaginatedQuery($query, $queryCount, $this->pdo);
       $posts = $pagination->getItems($this->class);
       (new CategoryManager($this->pdo))->hydratePosts($posts);
       return [$posts, $pagination];

 }

 
 /**
  * Find paginated for categorie
  * 
  * @param int $categoryID 
  * @return array
 */
 public function findPaginatedForcategory(int $categoryID)
 {
    $query = "
    SELECT p.* 
    FROM post p 
    JOIN post_category pc ON pc.post_id = p.id
    WHERE pc.category_id = {$categoryID} 
    ORDER BY created_at DESC
    ";

    $queryCount = "
    SELECT COUNT(category_id) 
    FROM post_category 
    WHERE category_id = {$categoryID}
    ";

    $pagination = new PaginatedQuery($query, $queryCount, $this->pdo);

    $posts = $pagination->getItems($this->class);
    (new CategoryManager($this->pdo))->hydratePosts($posts);
    return [$posts, $pagination];

   }

}