<?php 
namespace app\models\Entity;


/**
 * Class Category
 * 
 * @package app\models\Entity\Category
*/ 
class Category
{
   
/**
* @var int      $id          [ Identification of categorie ]
* @var string   $slug        [ Slug of categorie ]
* @var string   $name        [ Name of categorie ]
* @var int      $post_id     [ Id of article associeted to a categorie ]
*/
private $id;
private $slug;
private $name;
private $post_id;

/**
 * Stockera un post en particulier
 * 
 * @var Post $post
*/
private $post;


/**
 * Get ID
 * 
 * @return null|int
*/
public function getID(): ?int 
{
    return $this->id;
}
     
/**
* Get name
* 
* @return null|string
*/
public function getName(): ?string
{
   return $this->name;
}


/**
 * Get slug
 * 
 * @return null|string
 */
public function getSlug(): ?string
{
	return $this->slug;
}


/**
 * Get Post ID
 * 
 * @return null|int
*/
public function getPostID(): ?int
{
   return $this->post_id;
}

/**
 * Set post
 * 
 * @param Post $post 
 * @return void
*/
public function setPost(Post $post)
{
    $this->post = $post;
}

}