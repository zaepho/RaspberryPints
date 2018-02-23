<?php
session_start();
if(!isset( $_SESSION['myusername'] )){
	header("location:index.php");
}
require_once __DIR__.'/../includes/common.php';
require_once __DIR__.'/../includes/config_names.php';

/*echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;
*/
foreach(array_keys($_POST) as $key){
	// update data in mysql database
	$stmt = $DBO->prepare("UPDATE config SET configValue=:configValue WHERE id=:id");
	$stmt->bindParam(':configValue', $_POST[$key], PDO::PARAM_INT);
	$stmt->bindParam(':id', $key, PDO::PARAM_INT);
	$result = $stmt->execute();
}


echo "<script>location.href='personalize.php';</script>";





?> 
