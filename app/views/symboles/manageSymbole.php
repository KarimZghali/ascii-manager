<?php
use ASCII\Controller\Auth\LevelController;
?>

<?php include __DIR__ . "/../header.php"; ?>




<?php include __DIR__ . "/../ui/alert-box.php"; ?>



</section>

<!-- Formulaire d'ajout : -->

<h1 class="text-center">Ajouter un symbole <small class="glyphicon glyphicon-pencil"></small></h1>

<section class="container-fluid col-xs_10 col-xs-offset-1">

	<form action="" method="post">
	  <div class="form-group">
	    <label for="fonts_name">Nom du symbole</label>
	    <input type="text" class="form-control" id="characters_name" name="symbole_name" aria-describedby="emailHelp" placeholder="Votre symbole">
	  </div>
	  <div class="form-group">
	    <label for="fonts_line_height">Valeur du symbole</label>
	    <input type="text" class="form-control" id="characters_value" name="symbole_value" placeholder="Votre valeur">
	  </div>
	  <?php if(LevelController::verifLevel($_SESSION['token']) == 'superadmin'): ?>
	  <button type="submit" class="btn btn-primary">Submit</button>
	  <?php else :?>
	  <p style="color:red;">Vous n'avez pas les droits pour ajouter des symboles !</p>
	  <?php endif; ?>
	</form>

</section>



<!-- Affichage des données : -->

<h2 class="text-center">Liste des symboles <small class="glyphicon glyphicon-pencil"></small></h2>
<hr/>
<?php include __DIR__ . '/../ui/results.php'; ?>

<section class="container-fluid col-xs_10 col-xs-offset-1">

<?php if ( isset($model->results) ) : ?>
<?php foreach ($model->results  as $value) : ?>


 <div class="list-group">
  	<a href="#" class="list-group-item">
  	<?= $value->symbole_name." : ".$value->symbole_value?>
	</a>
	
	 <?php if(LevelController::verifLevel($_SESSION['token']) == 'superadmin'): ?>
  <a href="http://localhost/ascii/web/admin/symboles?action=manage&delete=<?= $value->symbole_value; ?>">Supprimer<a/>
    <?php else :?>
	 <p style="color:red;">Vous n'avez pas les droits pour supprimer des symboles !</p>
	 <?php endif; ?>
</div> 


<?php endforeach; ?>
<?php endif; ?>





<?php include __DIR__ . "/../footer.php"; ?>