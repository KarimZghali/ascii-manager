<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ASCII</title>
	<base href="http://localhost/ascii/web/"/>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css"/>
</head>

<body>

 <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ASCII by M2I</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
      
            <ul class="nav navbar-nav navbar-right">
              <li><a href="./admin/fonts?action=read">Fonts<span class="sr-only">(current)</span></a></li>
              <li><a href="./admin/characters?action=manage&token=<?= $_SESSION["token"] ?>">Characters</a></li>
              <li><a href="./admin/symboles?action=manage&token=<?= $_SESSION["token"] ?>">Symbols</a></li>
              
         	  <?php if(isset($_SESSION["user"]["level"]))://isset($user) && $user): ?>
         	   <li><a href="./auth?action=destroy&token=<?= $_SESSION["token"]//$token ?>" class="glyphicon glyphicon-remove-circle btn btn-danger"></a></li>
         	  <?php else: ?>
         	  <li><a href="./auth?action=auth"  class="glyphicon glyphicon-user btn btn-success""></a></li>
         	  <?php endif; ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>



	<main>