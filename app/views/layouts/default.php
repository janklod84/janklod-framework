<!DOCTYPE html>
<?php HTML::lang() ?>
<head>
<?php 
	HTML::title();
	HTML::refresh(false); 
	Asset::render('css') 
?>
</head>
<body>
   <?php if(Auth::isLogged()): 
   	partial('menu', 'layouts'); ?>
   <?php endif; ?>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::render('js') ?>
</body>
</html>