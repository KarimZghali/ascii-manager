<?php

// Doit toujour commencer par (nom de la classe) :
use ASCII\Http\Response;
use ASCII\Controller\Admin\FontsController;
use ASCII\Controller\Admin\CharacteresController;
use ASCII\Controller\Admin\SymbolesController;
use ASCII\Controller\Admin\CharacteresFontsController;
use ASCII\Manager\Manager;
use ASCII\Controller\Auth\AuthController;
use ASCII\Entity\User;
use ASCII\Entity\UserLevel;

require "./../vendor/autoload.php";


$modelUrl= "/formation-php/web/admin/fonts/[a-zA-Z0-9-_\s]{1,32}";

$modelUrl = str_replace("/", "\/", $modelUrl);



try {

	// Recherche des elements dans l'URL
	$url = (string) filter_input(INPUT_SERVER, "REDIRECT_URL"); // ->  /formation-php/web/admin/fonts
	//var_dump(INPUT_SERVER);

	$action = (string) filter_input (INPUT_GET, "action"); // -> create ou read

	if ( preg_match("/^" . $modelUrl . "$/", $url) ) {
		
		//var_dump("ok");
		
	}

$route = [
	// Key => Value
	
	"/ascii/web/auth" => AuthController::class,
	"/ascii/web/admin/fonts" => FontsController::class, // -> Value : namespace (ASCII\Controller\Admin\FontsController)
	"/ascii/web/admin/characters" => CharacteresController::class,
	"/ascii/web/admin/symboles" => SymbolesController::class,
	
	"/formation-php/web/admin/fonts/[a-zA-Z0-9-_\s]{1,32}" => CharacteresFontsController::class
	
		
		
];


foreach ($route as $routeUrl => $className) {
	
// Si l'URL du navigateur est presente dans le router
	if ($routeUrl === $url) {
	
		// on demande une instance de la classe associ�e
		$controller = new $className;
		
		//var_dump("ClasseName : ".$className.' --- ');
		if (method_exists($controller, $action)) { // $controller -> Objet de la class / action -> create ou read
			$response = $controller->{$action}(); // Appelle la methode create ou read de l'objet 
			
			break;
			
		}
	}
}

if (!isset($response)) {
	$response = new Response;
	$response -> setStatus (404, "Not Found");
	$response ->setBody("Aucune route ne correspond");
}

header($response->getStatus());
foreach ($response->getHeader() as $key => $value) {
	header($key . ": " . $value);
}

echo $response->getBody();

} catch (Throwable $e) {
	header("HTTP/1.1 500 Internal Server Error");
	echo "<h1>Erreur: </h1>". (string) $e;
}

