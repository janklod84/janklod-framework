<?php 
namespace JK\Database;


use \DB;
use \PDO;
use JK\Http\Url;



/**
 * @package JK\Database\Pagination\PaginatedQuery
**/ 
class PaginatedQuery 
{
	
/**
 * @var string     $query 
 * @var string     $queryCount 
 * @var ?\PDO|null $pdo 
 * @var int        $perPage  
 * @var int        $count  
 * @var array      $items 
*/
private $query;
private $queryCount;
private $pdo;
private $perPage;
private $count;
private $items;



/**
 * Constructor
 * 
 * @param string $query 
 * @param string $queryCount 
 * @param ?\PDO|null $pdo 
 * @param int|int $perPage 
 * @return void
*/
public function __construct(
string $query, 
string $queryCount,      
?\PDO  $pdo = null,  
int $perPage = 12 
)
{
    $this->query = $query;
    $this->queryCount = $queryCount;
    $this->pdo = $pdo;
    $this->perPage = $perPage;
}

/**
 * Get Items
 * 
 * @param string $classMapping
 * @return array
 */
 public function getItems(string $classMapping): array 
 {
     if($this->items === null)
     {
          $currentPage = $this->getCurrentPage();
    
          $pages = $this->getPages();

          if($currentPage > $pages)
          {
             throw new \Exception('This page doest not existe!'); 
          } 
          
          $offset = $this->perPage * ($currentPage - 1);

          $this->items = $this->pdo->query(
            $this->query . " LIMIT {$this->perPage} OFFSET $offset"
          )->fetchAll(PDO::FETCH_CLASS, $classMapping);
     }

     return $this->items;

 }

 /**
  * Pevious Link [ Permet de recuperer le lien de la page precedante ]
  * 
  * @param string $link
  * @return string|null
  */
 public function previousLink(string $link): ?string
 {
    $currentPage = $this->getCurrentPage();
    if($currentPage <= 1) { return null; }
    if($currentPage > 2) { $link .= "?page=". ($currentPage - 1); }
    return sprintf(
    '<a href="%s" class="btn btn-primary">&laquo; Пред. страница</a>', 
    $link
    );
 }

 
 /**
  * Next Link  [ Genere le lien suivant ]
  * 
  * @param string $link 
  * @return string
 */
 public function nextLink($link)
 {
     $currentPage = $this->getCurrentPage();
     $pages = $this->getPages();
     $link .= "?page=" . ($currentPage + 1);
     if($currentPage >= $pages) { return null; }
	 return sprintf(
	  '<a href="%s" class="btn btn-primary ml-auto">След. страница &raquo;</a>', 
	  $link
	 );
 }


 /**
  * Get current Page
  * 
  * @return int
 */
 private function getCurrentPage(): int 
 {
    return Url::getPositiveInt('page', 1);
 }



 /**
  * Get pages [ Permet d'obtenir le nombre de pages ]
  * 
  * @return int
 */
 private function getPages(): int
 {
 	if($this->count === null)
 	{
 	   $this->count = (int) $this->pdo->query($this->queryCount)
 	                                  ->fetch(PDO::FETCH_NUM)[0];
 	}
    return ceil($this->count / $this->perPage); 
 }

}