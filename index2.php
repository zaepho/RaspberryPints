<?php
if (!file_exists(__DIR__ . '/includes/dbconfig.php')) {
    header('Location: install/index.php', true, 303);
    die();
}

require_once __DIR__ . '/includes/common.php';
require_once __DIR__ . '/admin/includes/managers/tap_manager.php';
require_once __DIR__ . '/admin/includes/models/tap.php';
// Include and setup Smarty

require_once __DIR__.'/vendor/Smarty/';

$Smarty = new Smarty;
$Smarty->assign($config);
$smarty->template_dir = __DIR__ . 'templates/RPints-Veritcal/';
$Smarty->debugging = true;

// Setup array for all the beers that will be contained in the list
$tapManager = new TapManager();
$beers = $tapManager->getActiveTaps(); 
$Smarty->assign($beers);
$Smarty->assign($tapManager);

# Get SRM to SRMRGB conversion table
$SRM2RGB = array();
foreach ($DBO->query('select * from config', PDO::FETCH_ASSOC) as $setting) {
    $SRM2RGB[$setting['srm']] = $setting['rgb'];
}
$Smarty->assign($SRM2RGB);
$smarty->display('frontend/layout.tpl')
?>