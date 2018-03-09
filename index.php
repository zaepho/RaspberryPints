<?php
if (!file_exists(__DIR__ . '/includes/dbconfig.php')) {
    header('Location: install/index.php', true, 303);
    die();
}

require_once __DIR__ . '/includes/common.php';
require_once __DIR__ . '/admin/includes/managers/tap_manager.php';
require_once __DIR__ . '/admin/includes/models/tap.php';
// Include and setup Smarty
//require_once __DIR__.'/vendor/Smarty/';

$Smarty = new Smarty();
$Smarty->template_dir   = __DIR__ . '/templates/'. $config['skin-FrontEnd'] .'/';
$Smarty->debugging      = TRUE;
# $Smarty->debug_tpl      = __DIR__ . '/templates/debug.tpl';

$Smarty->assign('config', $config);
// Setup array for all the taps that will be contained in the list
$tapManager = new TapManager();
$taps = $tapManager->getActiveTaps();
ksort($taps);

$Smarty->assign('taps', $taps);
$Smarty->assign('tapManager', $tapManager);

# Get SRM to SRMRGB conversion table
$SRM2RGB = array();
foreach ($DBO->query('select * from srmRgb', PDO::FETCH_ASSOC) as $srm) {
    $SRM2RGB[$srm['srm']] = $srm['rgb'];
}
$Smarty->assign('SRM2RGB', $SRM2RGB);
$Smarty->display('frontend/layout.tpl')
?>