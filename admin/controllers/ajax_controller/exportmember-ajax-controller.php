<?php
    @session_start();
    include('../../models/db.php');
    include('../../models/common-model.php');
    include('../../includes/thumb_new.php');
    include('../../includes/resize-class.php');
    include('../common-controller.php');
    $database = new Connection();
    include('../../models/ajax-model.php');
    $modelObj = new AjaxModel();
    $controller_class = new CommonController();
    $upload_dir =$_SESSION['SITE_IMG_PATH']."admin_profile/";
    $upload_dirthumb =$_SESSION['SITE_IMG_PATH']."admin_profile/thumb/";

?>

<?php
if(isset($_POST['his_export']) && $_POST['his_export'] != ''){
$qry = $modelObj->fetchRows("SELECT * FROM tbl_users WHERE status!=2");
$fh = fopen('export-user.csv', 'w') or die('Cannot open the file');
$data = "";

$data .= "Name, email \n";
foreach($qry as $row) {

//$addMyJobType=$controller_class->getUserById($row['fk_agent_id']);
//$data .=    $addMyJobType['firstname'].' '.$addMyJobType['lastname'].",".$row['firstname'].' '.$row['lastname'].", ".$row['competitor_no'].",".$row['member_no'].",".$row['car_no'].",".$row['vehicle_class'].",".$row['color'].",".$row['car_no'].",".$row['event_date'].",".$row['licence_no'].",".$row['expiry_date'].",".$row['dorian_no'].",".$row['dorian_hire'].",".$row['car_registration'].",".$row['extras'].",".$row['notes'].",".$row['model_no'].",".$row['production_year'].",".$row['group_name']."\n";
$data .=    $row['name'].",".$row['email']."\n";

}

fwrite( $fh, $data );
fclose($fh);
header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="export-user.csv"');
echo "export-user.csv";
}
?>

<?php
/*if(isset($_POST['his_export_super']) && $_POST['his_export_super'] != ''){
$qry = $modelObj->fetchRows("SELECT * FROM tbl_agent_member WHERE status!=2 AND event_id='".$_POST['eventid']."' AND activity='".$_POST['activity']."'");
$fh = fopen('export-agent-registration.csv', 'w') or die('Cannot open the file');
$data = "";
$data .= "Created_By, Name, Competitor Number, Member Number, Car Number, Vehicle Class, Color, Model No, Production Year, Group Name \n";
foreach($qry as $row) {
$addMyJobType=$controller_class->getUserById($row['fk_agent_id']);
$data .= $addMyJobType['firstname'].' '.$addMyJobType['lastname'].", ".$row['firstname'].' '.$row['lastname'].", ".$row['competitor_no'].", ".$row['member_no'].", ".$row['car_no'].", ".$row['vehicle_class'].", ".$row['color'].", ".$row['model_no'].", ".$row['production_year'].", ".$row['group_name']."\n";
}
fwrite( $fh, $data );
fclose($fh);
header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="export-agent-registration.csv"');
echo "export-agent-registration.csv";
}*/
?>
