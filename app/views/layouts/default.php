<!DOCTYPE html>
<html>
<head>
	<?php 
	HTML::title('Default Template');
	HTML::refresh(false); 
	Asset::render('css') 
	?>
</head>
<body>
   <?php partial('menu', 'layouts'); ?>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::render('js') ?>
</body>
</html>