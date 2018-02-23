<?php
session_start();
if(!isset( $_SESSION['myusername'] )){
    header("location:index.php");
}
require_once __DIR__.'/../includes/common.php';

$file = 'img/background.jpg';
if (file_exists(__DIR__ . '/../' . $file)) {

} else {
    $log->fatal('Original background image does not exist!');
    echo 'Original background image does not exist!';
    exit;
}

$qry = $DBO->prepare("update config set configValue=? where configName = 'backgroundImgUrl'");
$result = $qry->execute(array($file));
if ($result) {
    echo "<script>location.href='personalize.php';</script>";
} else {
    echo "Sorry, there was a problem setting the background configuration."; 
    exit;
}

?>