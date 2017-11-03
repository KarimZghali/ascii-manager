<?php

namespace ASCII\Model;
use ASCII\Manager\Manager;
use ASCII;
use PDO;

class CharactersModel
{
	
	
	public function create(string $charactersName, string $charactersValue)
	{

		if (!$charactersName|| !$charactersValue) {
			
			return;
		}
		try {
			$sth = Manager::getPDO()->prepare("INSERT INTO `characters`(`characters_name`, `characters_value`) VALUES (:characters_name, :characters_value)");
			$sth->bindValue(":characters_name", $charactersName);
			$sth->bindValue(":characters_value", $charactersValue);
			$sth->execute();
			$this->success = $charactersName. " has been created";
			
		}catch (\Throwable $e) {
			$this->error = $e->getMessage();
		}
	}
	
	
	public function read()
	{
		try {
			$sth = Manager::getPDO()->prepare("SELECT `characters_name`, `characters_value` FROM `characters`");
			$sth-> execute();
			$this->results = $sth->fetchAll(PDO::FETCH_OBJ);
			
			
		} catch (\Throwable $e) {
			
			$this->error =$e->getMessage();
		}
		
	}
	
	
	public function delete($idDelete) {
		try {
			$sth = manager::getPDO()->prepare("DELETE FROM `characters` WHERE `characters_value`='$idDelete'");
			$sth -> execute();
			$this->success = "Good !";
			
		}catch (\Throwable $e) {
			$this->error =$e->getMessage();
		}
	}
}
