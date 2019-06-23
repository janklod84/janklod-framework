<?php 
use App\Connection;
use App\Table\{
	PostTable,
	CategoryTable
};


$id   = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);

// a celui de l'URL on fait une redirection
if($post->getSlug() !== $slug)
{
	$url = base_url('post', ['slug' => $post->getSlug(), 'id' => $id]);
	http_response_code(301);
	header('Location: '. $url);
}

?>
<h1><?= e($post->getName()); ?></h1>
<p class="text-muted">
	<?= $post->getCreatedAt()->format('d F Y'); ?>
</p>
<?php 
foreach($post->getCategories() as $k => $category): 
   if($k > 0): echo ','; endif; 
   $category_url = base_url('category', 
   ['id' => $category->getID(), 'slug' => $category->getSlug()]
   );
?>
	<a href="<?= $category_url ?>">
		<?= e($category->getName()) ?>
	</a>
<?php endforeach; ?>
<p><?= $post->getFormattedContent(); ?></p>

