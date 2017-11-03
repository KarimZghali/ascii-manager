<?php

namespace ASCII\Controller;
use ASCII\Http\Response;

abstract class Controller

{
	
	protected $response;
	
	public function __construct()
	{
		$this->response = new Response;
		session_start();
		
		if (!array_key_exists("token", $_SESSION)) {
			
				$_SESSION["token"] = password_hash(uniqid(), PASSWORD_DEFAULT);
		} else if (array_key_exists("user", $_SESSION) // PROTECTION USURPATEUR
			&& $_SESSION["user"]["ip"] !== filter_input(
					INPUT_SERVER,
					"REMOTE_ADDR" // L'adresse IP du client qui demande la page courante
					)
			&& $_SESSION["user"]["userAgent"] !== filter_input(
					INPUT_SERVER,
					"HTTP_USER_AGENT"
					)) {
			die("Do not try to rob a user session");
		}
	}
	
	// securisation des entrees/sorties
	public function html($value) : string
	{
		
		return filter_var(
				(string) $value,
				FILTER_SANITIZE_FULL_SPECIAL_CHARS,
				FILTER_FLAG_ENCODE_HIGH
				);
	}
	
	protected function getTemplateName(string $template) : string
	{

		return  __DIR__."/../../app/views/". $template . ".php";
	}
	
	protected function render(string $template, array $data): Response
	{
		$template = $this->getTemplateName($template);
		
		if ( is_file($template) ) { // verifie si 'template' est un veritable fichier
			//extrait les cles et valeur et les transforme en variable
			extract($data);
			// Déclarer un tampon :
			ob_start();
			// On peut inclure tranquillement
			include $template;
			$output = ob_get_contents();
			// Desactiver le tempon
			ob_end_clean();
			$this->response->setBody($output);
			return $this->response;
		}
		
		// l'antislash dispense d'un "use" pour "Exception"
		throw new \Exception("Template ".$template." is not a file");
		
	}

	
}
