<?php

function getConfig() {
    global $config;
    global $DBO;
    global $log;

    foreach ($DBO->query('select * from config', PDO::FETCH_ASSOC) as $setting) {
        $config[$setting['configName']] = $setting['configValue'];
    }

    $log->debug('Config Values:');
    foreach (array_keys($config) as $key) {
        $log->debug($key . " => " . $config[$key]);
    }
}
getConfig();
require_once __DIR__.'/config_names.php';
?>