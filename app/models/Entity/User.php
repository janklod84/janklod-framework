<?php 
namespace app\models\Entity;


/**
 * Class User
 * 
 * @package app\models\Entity\User
*/ 
class User
{
   
   
/**
 * @var int    $id
 * @var string $username
 * @var string $password
*/
private $id;
private $username;
private $password;


/**
 * Set Id
 * 
 * @param int $id 
 * @return void
 */
public function setId(int $id)
{
	$this->id = $id;
}


/**
 * Get ID
 * 
 * @return int 
*/
public function getId(): int 
{
	return $this->id;
}


/**
 * Set username
 * 
 * @param string $username 
 * @return void
 */
public function setUsername(string $username)
{
	$this->username = $username;
}


/**
 * Get username
 * 
 * @return string
*/
public function getUsername(): string 
{
	return $this->username;
}


/**
 * Set password
 * 
 * @param string $password 
 * @return void
 */
public function setPassword(string $password)
{
	$this->password = $password;
}


/**
 * Get password
 * 
 * @return string
*/
public function getPassword(): string 
{
	return $this->password;
}


}