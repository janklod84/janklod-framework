<?php 
$router = null;
$categories = array_map(function($category) {
   $url = base_url('category', 
   ['id' => $category->getID(), 'slug' => $category->getSlug()
   ]); 
   return sprintf('<a href="%s" class="">%s</a>',    
	  	$url,    
	  	$category->getName()
	  );
}, $post->getCategories());

?>
<div class="card mb-3">
<div class="card-body">
	<h5 class="card-title"><?= e($post->getName()); ?></h5>
	<p class="text-muted">
	   <?= $post->getCreatedAt()->format('d F Y'); ?>
       <!-- List of categories associeted to an particulary article  -->
       <?php if(!empty($post->getCategories())): ?>
       	::
       	<?= implode('<br>', $categories); ?>
       <?php endif; ?>
       <!-- End list associeted -->
	</p>
	<p><?= $post->getExcerpt(); ?></p>
	<p>
		<a href="<?= base_url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]);?>" class="btn btn-primary">Подробнее</a>
	</p>
</div>
<div class="clear-fix"></div>