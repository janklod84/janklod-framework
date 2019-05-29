<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
	<?php Asset::render('css') ?>
</head>
<body>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::render('js') ?>
</body>
</html>