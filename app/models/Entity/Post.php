<?php 
namespace app\models\Entity;

use app\helpers\Text;
use \DateTime;


/**
 * @package app\models\Entity\Post
*/
class Post 
{


/**
* @var int      $id
* @var string   $slug
* @var string   $name
* @var string   $content
* @var int      $created_at  
*/
private $id;
private $slug;
private $name;
private $content;
private $created_at;


/**
 * Storage categories
 * 
 * @var array  $categories
*/
private $categories = [];

     
/**
* Get name
* 
* @return string
*/
public function getName(): ?string
{
   return $this->name;
}


/**
 * Get content format
 * 
 * @return string
*/
public function getFormattedContent(): ?string
{
   return  nl2br(e($this->content));
}


/**
 * Get excerpt
 * 
 * @return string
*/
public function getExcerpt(): ?string 
{
	 if($this->content === null) 
	 {
	 	 return null;
	 }
	 return nl2br(htmlentities(Text::excerpt($this->content, 60)));
}


/**
 * Created at
 * 
 * @return int
*/
public function getCreatedAt(): DateTime
{
   return new DateTime($this->created_at);
}


/**
 * Get slug
 * 
 * @return string
 */
public function getSlug(): ?string
{
	  return $this->slug;
}


/**
 * Get ID
 * 
 * @return int
*/
public function getID(): ?int 
{
    return $this->id;
}


/**
 * Get categories
 * 
 * @return Category[] array
*/
public function getCategories(): array
{
     return $this->categories;
}


/**
 * Add categories
 * 
 * @param Category $category 
 * @return void
*/
public function addCategory(Category $category): void
{
     $this->categories[] = $category;
     $category->setPost($this);
}

}