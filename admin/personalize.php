<?php
if(!isset( $_SESSION['myusername'] )){
	header("location:index.php");
}
require_once __DIR__.'/../includes/common.php';
require_once __DIR__.'/../includes/config_names.php';
require_once __DIR__.'/personalize_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	# Check for supported stuff to process
	switch ($_POST['process']) {
		case 'panelconfig':
			updatePanelConfig();
			break;
		case 'updateheader':
			updateHeader();
			break;
		case 'updateimages':
			$Smarty->assign('Files', $_FILES);	
			foreach(array_keys($_FILES) as $image) {
				if ($_FILES[$image]['size'] > 0) {
					#TODO: Error handling 
					updateImage($image);
				}
			}
			break;
	}

	getConfig();
	$Smarty->assign('config', $config);
}


$sql = 'select * from config where showOnPanel = 1';
$result = $DBO->query($sql);
$PanelConfig = $result->FetchAll(PDO::FETCH_ASSOC);

$Smarty->assign('ConfigOnOff', array(
	1=> 'On',
	0=> 'Off')
);

$Smarty->assign('PanelConfig', $PanelConfig);
$Smarty->assign('Page', 'Configure_Settings');
$Smarty->display('admin/layout.tpl');
?>