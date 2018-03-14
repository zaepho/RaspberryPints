<?php
session_start();
if(!isset( $_SESSION['myusername'] )){
	header("location:index.php");
}

require_once __DIR__.'/../includes/common.php';
require_once __DIR__.'/../includes/config_names.php';

$sql = 'select * from config where showOnPanel = 1';
$result = $DBO->query($sql);
$PanelConfig = $result->FetchAll(PDO::FETCH_ASSOC);

$Smarty->assign('ConfigOnOff', array(
	1=> 'On',
	0=> 'Off')
);

$Smarty->assign('PanelConfig', $PanelConfig);
$Smarty->assign('CurrentLocation', 'Configure_Settings');
$Smarty->display('admin/layout.tpl');
exit;
?>