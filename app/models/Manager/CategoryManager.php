<?php 
namespace app\models\Manager;


use app\models\Entity\Category;
use \PDO;


/**
 * @package app\models\Manager\CategoryManager
*/ 
class CategoryManager extends BaseManager
{
    
/**
 * @var string $table
 * @var string $class
*/
protected $table = 'category';
protected $class = Category::class;


/**
 * Hydrate posts
 * 
 * @param app\models\Post[] $posts 
 * @return void
*/
public function hydratePosts(array $posts): void
{
    $postsByID = [];
    foreach($posts as $post)
    {
       $postsByID[$post->getID()] = $post;
    }

    $sql = 'SELECT c.*, pc.post_id 
            FROM post_category AS pc 
            JOIN category c ON c.id = pc.category_id 
            WHERE pc.post_id IN (%s)';
    $sql = sprintf($sql, implode(',', array_keys($postsByID)));
    $categories = $this->pdo->query($sql)
                            ->fetchAll(PDO::FETCH_CLASS, $this->class);

    foreach($categories as $category)
    {
       $postsByID[$category->getPostID()]->addCategory($category);
    }
}

}