<!DOCTYPE html>
<html>
<head>
	<title>Default Template</title>
	<?php Asset::render('css') ?>
</head>
<body>
   <?php include 'partials/menu.php'; ?>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::render('js') ?>
</body>
</html>