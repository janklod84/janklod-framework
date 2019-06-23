<h1>Блог</h1>
<div class="row">
<?php 
if(!empty($posts)): 
foreach($posts as $post): 
?>
  <div class="col-md-3">
  	<!-- У меня партиал функция еще не реализована, поэтому так времено пишу -->
    <?php require(__DIR__.'/../partials/card.php'); ?>
  </div>
</div>
<?php endforeach; endif; ?>
</div>

<!-- Show pagination -->
<div class="d-flex justify-content-between my-4">
	<?= $pagination->previousLink($link); ?>
	<?= $pagination->nextLink($link); ?>
</div>