<?php include __DIR__ . "/../header.php"; ?>

<h1 class="text-center">Auth</h1>

<?php include __DIR__ . "/../ui/alert-box.php"; ?>

<?php if (!$user) : ?>
<form action="" method="post" class="col-xs-8 col-xs-offset-2">
	<input name="user_mail" placeholder="Mail" class="glyphicon glyphicon-envelop form-control"/>
	<input name="user_pswd" type="password" placeholder="password" class="glyphicon glyphicon-secret form-control"/>
	<input name="token" value="<?= $token ?>"type="hidden"/> 
	<button class="btn btn-info">Login</button>

</form>
<?php endif; ?>


<?php include __DIR__ . "/../footer.php"; ?>