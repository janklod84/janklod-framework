<?php 

# Notion de Iteration sur les objets
$notes = new Collection([
  ['name' => 'Jean', 'note' => 20, 'nickname' => 'test1'],
  ['name' => 'Marc', 'note' => 13, 'nickname' => 'test2'],
  ['name' => 'Emilie', 'note' => 15, 'nickname' => 'test3'],
]);

debug($notes->get('0')->get('name'));
debug($notes->get('0.name'));
debug($notes->get('2.note'));


/*
# Recuperation de lists en fonction de la cle et value
debug($notes->lists('name', 'note'));


# Extraire des valeurs ou la cle est note
debug($notes->extract('note'));


# Get value with join(), join value with glue
debug($notes->extract('note')->join(', '));


# Get note maximale max()
debug($notes->extract('note')->max());

# Obtenir le maximum parmis les cles note
debug($notes->max('note'));

*/

/*
$collection = new \JK\Collections\Collection([
  ['name' => 'Jean', 'note' => 20, 'nickname' => 'test1'],
  ['name' => 'Marc', 'note' => 13, 'nickname' => 'test2'],
  ['name' => 'Emilie', 'note' => 15, 'nickname' => 'test3'],
]);

debug($collection->get('0.name'));
debug($collection->get('1.nickname'));
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>POO Array</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
</head>
<body>

   <div class="container" style="margin-top: 20px;">
   	   <h1>Collection POO :</h1>
 	   <form action="" method="POST">
 	   	  <div class="form-group">
 	   	  	<label for="">Nom</label>
 	   	    <input type="text" name="name" value="<?= $post->get('name'); ?>" class="form-control">
 	      </div>
 	      <button type="submit" class="btn btn-primary">Soumettre</button>
 	   </form>
   </div>

<script src="/assets/js/jquery.min.js"></script>
</body>
</html>