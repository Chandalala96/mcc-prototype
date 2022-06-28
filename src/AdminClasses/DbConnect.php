<?php 
namespace MyApp\AdminClasses; 
 
 
 //Connecting to the database using OOP
abstract class DbConnect {
	private $host = "localhost";
	private $user = "root";
	private $pwd = "";
	private $dbName = "mcc_app_revised";

	protected function connect() {
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
		$db = new \PDO($dsn, $this->user, $this->pwd);
		$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		return $db;
	}
}
