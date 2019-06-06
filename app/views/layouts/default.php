<!DOCTYPE html>
<?php HTML::lang() ?>
<head>
<?php 
   View::getMeta();
	HTML::refresh(false); 
	Asset::render('css') 
?>
</head>
<body>
   <?php 
   if(Auth::isLogged()):  // partial('menu', 'layouts');
   include('partials/menu.php');
   ?>
   <?php endif; ?>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::render('js') ?>
</body>
</html>