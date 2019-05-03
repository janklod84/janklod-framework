<!DOCTYPE html>
<html>
<head>
	<title>Default Template</title>
	<?php Asset::renderCss() ?>
</head>
<body>
   <?php include 'partials/menu.php'; ?>
   <div class="container" style="margin-top:30px;">
   	  <?= $content ?>
   </div>
   <?php Asset::renderJs() ?>
</body>
</html>