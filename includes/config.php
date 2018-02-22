<?php
global $config;
$config['dbhost'] = 'localhost';
$config['dbprefix'] = '';
$config['dbuser'] = '';
$config['dbpass'] = '';


if(file_exists(__DIR__ . '/config_local.php')) {
    require_once(__DIR__ . '/config_local.php');
};
?>