<?php
error_reporting(0);
include('../setting.php');
require('../PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php');

$dbh = new PDO('mysql:host='.COFIG_DB_HST.';dbname='.COFIG_DB_NAME, COFIG_DB_USR, COFIG_DB_PWD);
$settingData = getSettingData();


function getSettingData()
{
	global $dbh;
	$sth = $dbh->prepare("Select * from tbl_settings where id=1");
	$sth->execute();
	return $sth->fetch(PDO::FETCH_ASSOC);
}


function encode($id) {
  return strtr(base64_encode($id), '__++/=%$^$__+', '|*^%/}{*}}+}]');
}


function decode($encoded) {
 return base64_decode(strtr($encoded, '|*^%/}{*}}+}]', '__++/=%$^$__+'));
}


$depid = decode($_GET['pid']);


function encodeInt($id) {
  $id_str = (string) $id;
  $offset = rand(0, 9);
  $encoded = chr(79 + $offset);
  for ($i = 0, $len = strlen($id_str); $i < $len; ++$i) {
    $encoded .= chr(65 + $id_str[$i] + $offset);
  }
  return $encoded;
}


function decodeInt($encoded) {
  $offset = ord($encoded[0]) - 79;
  $encoded = substr($encoded, 1);
  for ($i = 0, $len = strlen($encoded); $i < $len; ++$i) {
    $encoded[$i] = ord($encoded[$i]) - $offset - 65;
  }
  return (int) $encoded;
}


	///////******* FUNCTION DEFINITION FOR FETCHING MULTIPLE ROWS ******////////

	function fetchRows($qry) // query to be processed
	{
		global $dbh;
		$statement = $dbh->prepare($qry);
		$statement->execute();
		return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	///////********* FUNCTION DEFINITION FOR FETCHING SINGLE ROW *******////////

	function fetchRow($qry) // query to be processed
	{
		global $dbh;
		$statement = $dbh->prepare($qry);
		$statement->execute();
		return $result = $statement->fetch(PDO::FETCH_ASSOC);
	}

	/////******* FUNCTION DEFINITION FOR COUNTING THE NUMBER OF ROWS SELECTED ******////////

	function numRows($qry) // query to be processed
	{
		global $dbh;
		$statement = $dbh->prepare($qry);
		$statement->execute();
		return $result = $statement->rowCount();
	}

	//////******* FUNCTION DEFINITION FOR PROCESSING A QUERY ******////////

	function runQuery($qry) // query to be processed
	{
		global $dbh;
		$statement = $dbh->prepare($qry);
		return $statement->execute();
	}

	//////******* FUNCTION DEFINITION FOR RETRIEVING THE INSERTED ID ******////////

	function getInsertedId($qry) // query to be processed
	{
		global $dbh;
		$statement = $dbh->prepare($qry);
		$statement->execute();
		return $dbh->lastInsertId();
	}
	function sendSMTPMail($to,$subject,$message)
	{
	 $settingData1 = getSettingData();
	 $mail = new PHPMailer(true);
	 $mail->IsSMTP();
	 $mail->SMTPAuth = true;
	 $mail->Port = $settingData1['smtpport'];
	 $mail->Host = $settingData1['smtphost'];
	 $mail->Username = $settingData1['smtpusername'];
	 $mail->Password = $settingData1['smtppassword'];
	 $mail->From = $settingData1['email'];
	 $mail->FromName = $settingData1['websiteName'];
	 $mail->AddAddress($to);
	 $mail->Subject = $subject;
	 $mail->Body = $message;
	 $mail->IsHTML(true);
	 return $sentmail = $mail->Send();
	}
?>
