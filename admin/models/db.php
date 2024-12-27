<?php
$check_val=strpos($_SERVER['REQUEST_URI'], '/admin/api');

if ($check_val >=0 && $check_val!='')
{
include('../../setting.php');
}else{
	include('setting.php');
}
	class Connection
	{
		function __construct()
		{
			switch($_SERVER['DOCUMENT_ROOT'])
			{
				case '/var/www/html':
				
					$this->host = COFIG_DB_HST;
					$this->user = COFIG_DB_USR;
					$this->passwd = COFIG_DB_PWD;
					$this->database = COFIG_DB_NAME;
					break;
					/*$this->host = "vrinsoft.cyyxbjyvxsjb.ap-south-1.rds.amazonaws.com";
					$this->user = "vrinsoft";
					$this->passwd = "Vrin1234";
					$this->database = "kart";*/
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
	
	function encode($id) {
		$id_str = (string) $id;
		$offset = rand(0, 9);
		$encoded = chr(79 + $offset);
		for ($i = 0, $len = strlen($id_str); $i < $len; ++$i) {
			$encoded .= chr(65 + $id_str[$i] + $offset);
		}
		return $encoded;
	}

	function decode($encoded) {
		$offset = ord($encoded[0]) - 79;
		$encoded = substr($encoded, 1);
		for ($i = 0, $len = strlen($encoded); $i < $len; ++$i) {
			$encoded[$i] = ord($encoded[$i]) - $offset - 65;
		}
		return (int) $encoded;
	}
	
	function encryptIt($string){
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'terra';
		$secret_iv = 'trove';
		
		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);

		return $output;
	}

	function decryptIt($string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'terra';
		$secret_iv = 'trove';

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		
		return $output;

	}
	
	//Create object and call Set PDO function. Developed By PHP Developer(RAHUL).
	$db = new Connection();
	$pdo = $db->set_pdo();

	
?>
