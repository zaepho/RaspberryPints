<?php
session_start();
require_once __DIR__.'/includes/common.php';
require_once __DIR__.'/admin/includes/checklogin.php';
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    # Check Login
    if (ProcessLogin()) {
        # Log an Audit
        # Show admin page!
        $_REQUEST['action'] = null;
    } else {
        #Add AUDITING and Fail2Ban/User Lockouts
        $Smarty->assign('LoginError', 'Bad Username or Password');
    }
}
if( !isset( $_SESSION['myusername'])){
    # Do login
    $Smarty->assign('Page', 'login');
    $Smarty->display('frontend/layout.tpl');
    exit;
}

if (!isset($_REQUEST['action'])) {
    # Show default Admin Page
    $Smarty->assign('Page', 'Home');
    $Smarty->display('admin/layout.tpl');
    exit;
}

switch($_REQUEST['action']) {
    case 'personalize':
        include 'admin/personalize.php';
        break;
    default:
        # Show default Admin Page
        $Smarty->assign('Page', 'Home');
        $Smarty->display('admin/layout.tpl');
        break;
}

?>