<?php

namespace ASCII\Model;
use ASCII\Manager\Manager;
use ASCII;
use PDO;

class SymbolesModel
{
	
	
	public function create(string $symboleName, string $symboleValue)
	{

		if (!$symboleName|| !$symboleValue) {
			
			return;
		}
		try {
			$sth = Manager::getPDO()->prepare("INSERT INTO `symboles`(`symbole_name`, `symbole_value`) VALUES (:symbole_name, :symbole_value)");
			$sth->bindValue(":symbole_name", $symboleName);
			$sth->bindValue(":symbole_value", $symboleValue);
			$sth->execute();
			$this->success = $symboleName. " has been created";
			
		}catch (\Throwable $e) {
			$this->error = $e->getMessage();
		}
	}
	
	
	public function read()
	{
		try {
			$sth = Manager::getPDO()->prepare("SELECT `symbole_name`, `symbole_value` FROM `symboles`");
			$sth-> execute();
			$this->results = $sth->fetchAll(PDO::FETCH_OBJ);
			
			
		} catch (\Throwable $e) {
			
			$this->error =$e->getMessage();
		}
		
	}
	
	
	public function delete($idDelete) {
		try {
			$sth = manager::getPDO()->prepare("DELETE FROM `symboles` WHERE `symbole_value`='$idDelete'");
			$sth -> execute();
		}catch (\Throwable $e) {
			$this->error =$e->getMessage();
		}
	}
	
	
}
