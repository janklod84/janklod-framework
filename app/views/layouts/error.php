<!DOCTYPE html>
<html>
<head>
	<?php 
	 HTML::title();
	 Asset::render('css') 
	?>
</head>
<body>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::render('js') ?>
</body>
</html>