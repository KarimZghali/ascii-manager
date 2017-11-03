<?php
namespace ASCII\Controller\Auth;

class LevelController
{
	
	public function verifLevel($token) {

		
		if ($token === $_SESSION['token'] && $_SESSION["user"]) {
			
			
			if ($_SESSION["user"]["level"] == 'superadmin') {
				return 'superadmin';
			
			}
			
			else if ($_SESSION["user"]["level"] == 'admin') {
				return 'admin';
			
			}
			
			else {
				// return 'noAdmin';
				
				LevelController::goDestroy();
				
			}
			
		} else {
			LevelController::goDestroy();
		}
		
	}	
	
	public function goDestroy() {
		session_destroy();
		header('Location:http://localhost/ascii/web/auth?action=auth');
		exit();
	}
	

	
}