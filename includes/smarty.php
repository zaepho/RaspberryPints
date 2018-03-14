<?php
// Include and setup Smarty
//require_once __DIR__.'/vendor/Smarty/';
global $config;
global $Smarty;
$Smarty = new Smarty();
$Smarty->template_dir   = __DIR__ . '/../templates/'. $config['skin-FrontEnd'] .'/';
$Smarty->compile_dir   = __DIR__ . '/../templates_c/';
$Smarty->debugging      = TRUE;
# $Smarty->debug_tpl      = __DIR__ . '/templates/debug.tpl';

$Smarty->assign('config', $config);
$Smarty->assign('SESSION', $_SESSION);

$Smarty->assign('_REQUEST', $_REQUEST);
?>