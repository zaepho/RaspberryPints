<?php
session_start();
if(!isset( $_SESSION['myusername'] )){
	header("location:index.php");
}
require_once __DIR__.'/../includes/common.php';
require_once __DIR__.'/../includes/config_names.php';

// Get values from form 
$header_text=$_POST['header_text'];

// update data in mysql database
$sql="UPDATE config SET configValue='$header_text' WHERE configName ='headerText'";
$result=$DBO->exec($sql);

// if successfully updated.
if($result){
    echo "Successful";
    echo "<BR>";
    echo "<script>location.href='personalize.php';</script>";
} else {
    echo "ERROR";
}

?>