
<?php

use ASCII\Controller\Auth\LevelController;
include __DIR__ . "/../header.php"; ?>



<h1 class="text-center"> Ajouter un character <small class="glyphicon glyphicon-pencil"></small></h1>




<?php include __DIR__ . "/../ui/alert-box.php"; ?>



<!-- Formulaire d'ajout : -->


<section class="container-fluid col-xs_10 col-xs-offset-1">

	<form action="" method="post">
	  <div class="form-group">
	    <label for="fonts_name">Nom du character</label>
	    <input type="text" class="form-control" id="characters_name" name="characters_name" aria-describedby="emailHelp" placeholder="A majuscule">
	  </div>
	  <div class="form-group">
	    <label for="fonts_line_height">Valeur du character</label>
	    <input type="text" class="form-control" id="characters_value" name="characters_value" placeholder="A">
	  </div>
	  <?php if ( LevelController::verifLevel($_SESSION['token']) == 'superadmin'): ?>
	  <button type="submit" class="btn btn-primary">Submit</button>
	  <?php else: ?>
	 <p style="color: red;">Votre level est insufisant pour ajouter des donnees !</p>
	  <?php endif;?>
	</form>

</section>


<div style="height:50px"></div>

<!-- Affichage des donnees : -->

<h2 class="text-center">Liste des characters <small class="glyphicon glyphicon-pencil"></small></h2>

<?php include __DIR__ . '/../ui/results.php'; ?>

<section class="container-fluid col-xs_10 col-xs-offset-1">



<?php if ( isset($model->results) ) : ?>
<?php foreach ($model->results  as $value) : ?>


 <div class="list-group">
  	<a href="#" class="list-group-item">
	<!-- this -> controller -->
  	<?= $this->html($value->characters_name) ." : ".$value->characters_value?>
	</a>
	<?php if ( LevelController::verifLevel($_SESSION['token']) == 'superadmin'): ?>
  <a href="http://localhost/formation-php/web/admin/characters?action=manage&delete=<?= $value->characters_value; ?>">Supprimer<a/>
	<?php else: ?>
	<p style="color: red;">Votre level est insufisant pour supprimer des donnees !</p>
	  <?php endif;?>
	  
</div> 


<?php endforeach; ?>
<?php endif; ?>



</section>


<?php include __DIR__ . "/../footer.php"; ?>