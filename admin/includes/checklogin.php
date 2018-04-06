<?php
require_once __DIR__ . '/../../includes/common.php';
function ProcessLogin() {
    global $DBO;
    global $log;
    $log->debug('Initializing Session');
    // username and password sent from form
    $myusername = $_POST['myusername'];
    $mypassword = md5($_POST['mypassword']);

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

        return TRUE;
    } else {
        return FALSE;
    }
    return FALSE;
}
?>