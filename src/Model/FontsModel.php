<?php
namespace ASCII\Model;
use ASCII\Manager\Manager;
use ASCII;
use PDO;

class FontsModel
{
	public function create(string $fontsName, int $fontsLineHeight)
	{
		if (!$fontsName || !$fontsLineHeight) {
			return;
		}
		try {
			
			$sth = Manager::getPDO()->prepare("INSERT INTO `fonts`(`font_name`, `font_line_height`) VALUES (:fonts_name, :font_line_height)");
			$sth->bindValue(":fonts_name", $fontsName);
			$sth->bindValue(":font_line_height", $fontsLineHeight);
			$sth->execute();
			$this->success = $fontsName . " has been created";
			
		}catch (\Throwable $e) {
			$this->error = $e->getMessage();
		}
	}
	
	
	public function read()
	{
	
		try {
			
			$sth = Manager::getPDO()->prepare("SELECT `font_name` FROM `fonts`");
			$sth-> execute();
			$this->results = $sth->fetchAll(PDO::FETCH_OBJ);

			
		} catch (\Throwable $e) {
			
			$this->error =$e->getMessage();
		}
	}
	
	
	public function delete($idDelete)
	{
		try {
			
			$sth = manager::getPDO()->prepare("DELETE FROM `fonts` WHERE `font_name`='$idDelete'");
			$sth -> execute();
			$this->success = "Good !";
			
			
		} catch (\Throwable $e) {
			
			$this->error =$e->getMessage();
		}
	}

}
