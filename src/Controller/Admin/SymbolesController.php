<?php
namespace ASCII\Controller\Admin;

use ASCII\Controller\Controller;
use ASCII\Http\Response;
use ASCII\Model\SymbolesModel;
use ASCII\Controller\Auth\LevelController;


class SymbolesController extends Controller
{
	
	
	
	public function manage() {
		
		$delete = (string) filter_input (INPUT_GET, "delete");
		
		$model = new SymbolesModel();
		
		
		$model->create(
				(string) filter_input(INPUT_POST, "symbole_name"),
				(string) filter_input(INPUT_POST, "symbole_value")
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
				"symboles/manageSymbole",
				["model" => $model]
				);
	}
	
}