<?php use ASCII\Controller\Auth\LevelController;

include __DIR__ . "/../header.php"; ?>



<h1 class="text-center">Fonts <small class="glyphicon glyphicon-pencil"></small></h1>
<hr/>

<?php include __DIR__ . "/../ui/alert-box.php"; ?>

<section class="container-fluid col-xs_10 col-xs-offset-1">

	<form action="" method="post">
	  <div class="form-group">
	    <label for="fonts_name">Nom</label>
	    <input type="text" class="form-control" id="fonts_name" name="fonts_name" aria-describedby="emailHelp" placeholder="Lettre majuscule A">
	  </div>
	  <div class="form-group">
	    <label for="fonts_line_height">Hauteur</label>
	    <input type="number" class="form-control" id="fonts_line_height" name="fonts_line_height" placeholder="30px">
	  </div>
	  <?php if(LevelController::verifLevel($_SESSION['token']) == 'superadmin'):?>
	  <button type="submit" class="btn btn-primary">Submit</button>
	  <?php else:?>
	  <p style="color:red;">Vous n'avez pas les droits pour ajouter de fonts</p>
	  <?php endif;?>
	</form>
	
	<div style="margin-top:20px;">
	<a href="http://localhost/ascii/web/admin/fonts?action=read">Retour a la liste de fonts</a>
	</div>

</section>


<?php include __DIR__ . "/../footer.php"; ?>