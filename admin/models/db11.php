<?php

include('../../../setting.php');

	class Connection
	{
		function __construct()
		{
			switch($_SERVER['DOCUMENT_ROOT'])
			{
				case '/home/mobileappws/public_html':
					$this->host = COFIG_DB_HST;
					$this->user = COFIG_DB_USR;
					$this->passwd = COFIG_DB_PWD;
					$this->database = COFIG_DB_NAME;
					break;
				default	:
					$this->host = COFIG_DB_HST;
					$this->user = COFIG_DB_USR;
					$this->passwd = COFIG_DB_PWD;
					$this->database = COFIG_DB_NAME;
					break;
			}
			error_reporting(0);						
		}
		//PDO setup function. Developed By PHP Developer(RAHUL).
		function set_pdo(){
			$this->pdo = new PDO(
				'mysql:host='.$this->host.';dbname='.$this->database,
				$this->user,
				$this->passwd
			);
			return $this->pdo;
		}
	}
	function clear_input($data){
		return str_replace("<script","&lt;script",trim($data));
	}
	//Create object and call Set PDO function. Developed By PHP Developer(RAHUL).
	$db = new Connection();
	$pdo = $db->set_pdo();
	
?>