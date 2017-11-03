<?php

namespace ASCII\Controller\Auth;
use ASCII\Controller\Controller;
use ASCII\Entity\user;
use ASCII\Manager\Manager;

use ASCII\Controller\Auth\LevelController;

class AuthController extends Controller
{
	
	public function auth()
	{
		
	
		
		// var_dump($_SESSION); // Contient un Token + tableau user avec IP, time, configuration client...
		
		try {
			$model = new \stdClass(); //Objet anonyme (stdClass est une classe vide générique)
			
			// SI DEJA CONNECTE
			if (array_key_exists("user", $_SESSION)) { // Verifie si la clé "user" du tableau $_SESSION existe
				throw new \Exception ("Vous etes deja connecte");
			}
			
			// SI L EMAIL ET/OU LE MOT DE PASSE N EST PAS RENSEIGNE
			//SI LE TOKEN N EST PAS ENVOYE OU S'IL NE CORRESPOND PAS A CELUI DE LA SESSION
			if (!($mail = filter_input(INPUT_POST, "user_mail")) 
			||  !($pswd = filter_input(INPUT_POST, "user_pswd")) 
			||  !($token = filter_input(INPUT_POST, "token"))    
			||   $token !== $_SESSION["token"] ) {				
				
				throw new  \RuntimeException;
			// SI L'ADRESSE EMAIL N'EXISTE PAS DANS LA BDD	
			} else if (!($user = Manager::getDoctrine()
										->getRepository(User::class)
										->findOneBy(["userMail" => $mail]))) {
			
				throw new \OutOfBoundsException;
				
			} 
			//SI LE PSWD NE CORRESPOND PAS CREATION D'UNE SESSION
			if (!password_verify($pswd, $user->getUserPswd())) {
						
				throw new \OutOfBoundsException;
						
					}
						$_SESSION["user"] = [
								"userAgent" => filter_input(INPUT_SERVER, "HTTP_USER_AGENT"),
								"ip" => filter_input(INPUT_SERVER, "REMOTE_ADDR"),
								"time" => time(),
								"id" => $user->getUserId(),
								"level" => $user->getUserLevel()->getUserLevelName(),
						];
						
						$model->success = "You are logged";
		
		}catch (\OutOfBoundsException $e) {
			// mail n'existe pas dans la BDD
			$error = "Mauvaises donnees";
		}catch (\RuntimeException $e) {
			// si les champs ne sont pas remplient et/ou que !=Token
			$error = "Veuillez entrer vos identifiants pour vous connecter !";
		} catch (\Throwable $e) {
			$error = $e->getMessage();
		} finally {
			//var_dump($this);
			$model->error = isset($error) ? $error : null;
			return $this->render("auth/auth", [
					"token" => $_SESSION["token"],
					"user"=> array_key_exists("user", $_SESSION)
					? $_SESSION["user"]["level"]
					: null,
					"model" =>$model
				]
			);
		}
		
	}
	
	public function destroy ()
	{
		// var_dump($_SESSION);
		try {
			$model = new \stdClass();
			if(!array_key_exists("user", $_SESSION)) {
				
				throw new \Exception("Vous devez etre connecte pour acceder a cette page");
				
			}
			
			// Tentative de fishing ! Pas de token, pas d'acces !
			if ($_SESSION["token"] !== filter_input(INPUT_GET, "token")) {
				throw new \Exception("You should not try");
			}
			
			session_destroy();
			$_SESSION = [];
			$model -> success = "Your are log out";
			
		} catch (\Throwable $e) {
			$model -> error = $e->getMessage();
		} finally {
			return $this->render("auth/destroy", [
					"token" => $_SESSION["token"],
					"model"=>$model,
					"user"=> array_key_exists("user", $_SESSION)
							? $_SESSION["user"]["level"]
							: null,
					"token" => array_key_exists("user", $_SESSION)
							? $_SESSION["token"]
							: null
				]
			);
		}
		
	}
	
}