<!DOCTYPE html>
<?php HTML::lang() ?>
<head>
<!--  Так не делается но временно вставляю это сюда)-->
<title><?= isset($title) ? $title : 'Блог'; ?></title>
<?php 
    // View::getMeta();
	HTML::refresh(false); 
	Asset::render('css') 
?>
</head>
<body class="d-flex flex-column h-100">
   <?php include('partials/menu.php'); ?>
   <div class="container" style="margin-top:30px;">
      <?= Flash::show('success', 'alert alert-success'); ?>
   	  <?= $content ?>
   </div>
   <?= notify() ?>
   <?php // \app\helpers\TimeDebug::show() ?>
   <?php Asset::render('js') ?>
</body>
</html>
