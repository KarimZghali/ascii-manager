<?php
namespace ASCII\Controller\Admin;

use ASCII\Controller\Controller;
use ASCII\Http\Response;
use ASCII\Model\CharactersModel;
use ASCII\Controller\Auth\LevelController;

class CharacteresController extends Controller
{
	

	
	public function manage() {
		
			//LevelController::verifLevel($_SESSION['token']);
		
			$level = new LevelController();
			
			$delete = (string) filter_input (INPUT_GET, "delete");
			
			$model = new CharactersModel();
			
			
			
			$model->create(
					(string) filter_input(INPUT_POST, "characters_name"),
					(string) filter_input(INPUT_POST, "characters_value")
					);
			
			if($delete != null) {
				$model->delete($delete);
			}
	
		
			
			if (LevelController::verifLevel($_SESSION['token']) == 'superadmin'
			|| LevelController::verifLevel($_SESSION['token']) == 'admin') {
			$model->read();
			}
	
			
			return $this->render(
					//chemin
					"characters/manage",
					["model" => $model]
					);
		}
	

}
	
