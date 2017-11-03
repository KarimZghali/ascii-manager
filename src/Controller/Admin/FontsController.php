<?php
namespace ASCII\Controller\Admin;

use ASCII\Controller\Controller;
use ASCII\Http\Response;
use ASCII\Model\FontsModel;

class FontsController extends Controller
{
	
	public function read() : Response
	{
		$model = new FontsModel();
		$model->read(); // Requete SQL de type SELECT
		// var_dump($model);
		return $this->render("fonts/read",["model" => $model] // donnees de la Requete SQL de type SELECT
		);
		
	}
	
	
	public function create() : Response
	{
		$model = new FontsModel();
		$model->create(
				(string) filter_input(INPUT_POST, "fonts_name"),
				(int) filter_input(INPUT_POST, "fonts_line_height")
				);
		
		return $this->render(
				//chemin
				"fonts/creat",["model" => $model]
				);
	}
	
	public function delete()
	{
		$model = new FontsModel();
		$delete = (string) filter_input (INPUT_GET, "delete");
		if($delete != null) {
			$model->delete($delete);
		}
		
		header('location:http://localhost/ascii/web/admin/fonts?action=read');
		exit;
		
	}
	
}
	
