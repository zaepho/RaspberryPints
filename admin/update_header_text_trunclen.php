<?php
session_start();
if(!isset( $_SESSION['myusername'] )){
    header("location:index.php");
}
require_once __DIR__.'/../includes/common.php';
require_once __DIR__.'/../includes/config_names.php';
require_once __DIR__.'/../includes/config.php';


// Get values from form 
$header_text_trunclen=$_POST['header_text_trunclen'];




// update data in mysql database
$sql="UPDATE config SET configValue='$header_text_trunclen' WHERE configName ='headerTextTruncLen'";
$result=$DBO->exec($sql);
if ($result===false) {
    // we failed
    echo "Failed to update configValue headerTextTruncLen";
    echo '<pre>';
    print_r($_POST);
    echo "SQL Error:";
    print_r($DBO->errorInfo());
    echo '</pre>';
} else {
    echo "Successful";
    echo "<BR />";
    echo "<script>location.href='personalize.php';</script>";
};

?> 
