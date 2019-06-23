<h1><?= e($title) ?></h1>
<div class="row">
<?php foreach($posts as $post): ?>
  <div class="col-md-3">
    <?php require(__DIR__.'/../partials/card.php'); ?>
  </div>
 </div>
<?php endforeach; ?>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-between my-4">
	<?= $pagination->previousLink($link); ?>
	<?= $pagination->nextLink($link); ?>
</div>