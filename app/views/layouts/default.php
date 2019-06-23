<!DOCTYPE html>
<?php HTML::lang() ?>
<head>
<?php 
    View::getMeta();
	HTML::refresh(false); 
	Asset::render('css') 
?>
</head>
<body class="d-flex flex-column h-100">
   <?php include('partials/menu.php'); ?>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?= \app\helpers\TimeDebug::show() ?>
   <?php Asset::render('js') ?>
</body>
</html>
