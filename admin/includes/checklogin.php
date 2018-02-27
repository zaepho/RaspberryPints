<?php
require_once __DIR__ . '/../../includes/common.php';
$log->debug('Initializing Session');
session_start();
$session = session_id();
$time = time();
$time_check = $time-1800; //SET TIME 10 Minute

// username and password sent from form
$myusername = $_POST['myusername'];
$mypassword = md5($_POST['mypassword']);

if ($myusername == null || $myusername == '') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    exit;
}

$query = $DBO->prepare("SELECT * FROM users WHERE username = ? and password = ?");

$execute = $query->execute(array($myusername, $mypassword));
$query->setFetchMode(PDO::FETCH_ASSOC);
$result = $query->fetchAll()[0];

// If result matched $myusername and $mypassword, table row must be 1 row
if($result['username'] == $myusername){
    $log->info('User ' . $myusername . 'Sucessfully Logged in');
    // Register $myusername, $mypassword and redirect to file "admin.php"
    $_SESSION['myusername'] = $myusername;
    # TODO: Why is the user's password in the session??
    $_SESSION['mypassword'] = $mypassword;
    $_SESSION['UserInfo'] = $result;
    //session_register("myusername");
    //session_register("mypassword");

    echo "<script>location.href='../admin.php';</script>";
} else {
    echo '<pre>';
    echo "Login Failed";
    //echo "User: $myusername";
    //echo "Pass: $mypassword";
    //print_r($result);
    echo '</pre>';
    #echo "<script>location.href='../index2.php';</script>";
}
?>