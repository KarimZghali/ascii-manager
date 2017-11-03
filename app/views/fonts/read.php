<?php  use ASCII\Controller\Auth\LevelController;

include __DIR__ . '/../header.php'; ?>

<h1 class="text-center">Fonts <small class="glyphicon glyphicon-book"></small></h1>



<?php  include __DIR__ . '/../ui/results.php'; ?>

<section class="container-fluid col-xs_10 col-xs-offset-1">

<?php if ( isset($model->results) ) : ?>
<?php foreach ($model->results  as $value) : ?>
<div class="list-group">
<a class="list-group-item" href="./admin/fonts/<?= $value->font_name ?>?action=manager" >

<?= $value->font_name ?>

</a>
<?php if(LevelController::verifLevel($_SESSION['token'])=='superadmin'): ?>
<a href="http://localhost/ascii/web/admin/fonts?action=delete&delete=<?= $value->font_name; ?>">Supprimer</a>
<?php else :?>
<p style="color:red;">Vous n'avez pas les droits pour supprimer les fonts</p>
<?php endif;?>
</div>

<?php endforeach; ?>
<?php endif; ?>

<a href="./admin/fonts?action=create" class="btn btn-primary col-xs-col-3 col-xs-offset-1">+</a>

</section>
<hr/>





<?php  include __DIR__ . '/../footer.php'; ?>