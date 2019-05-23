<?php 
namespace app\models\Users;


use JK\Database\ActiveRecord;


/**
 * @package app\models\Entity\User 
*/ 
class Post extends ActiveRecord
{
	  
	  /**
	   * @var string $table
	  */
      protected $table = 'posts';


	  /**
	   * @var int    $id
	   * @var string $title
	   * @var string $author
	   * @var mixed  $text
	  */
	  private  $id
	  private  $title
	  private  $author
	  private  $text

      
      /**
       * Set id
       * @param int $id 
       * @return void
      */
	  public function setId($id)
	  {
	  	  $this->id = $id;
	  }


	  /**
       * Get id
       * @return int
      */
	  public function getId()
	  {
	  	  return $this->id;
	  }


	  /**
       * Set title
       * @param string $title 
       * @return void
      */
	  public function setTitle($title)
	  {
	  	  $this->title = $title;
	  }


	  /**
       * Get title
       * @return string $title 
      */
	  public function getTitle()
	  {
	  	  return $this->title;
	  }



}