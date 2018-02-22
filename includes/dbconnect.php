<?php

require_once __DIR__.'/config.php';
global $config;
try {
    $dbname = "rpints";
    if ($config['dbprefix'] <> '') {
        $dbname = $config['dbprefix'] . "_rpints";
    };
    $DBO = new PDO( "mysql:" . "host=" . $config['dbhost'] . ";" . "dbname=" . $dbname , $config['dbuser'], $config['dbpass']);
} catch ( Exception $e ) {
    $log->fatal('Failed to connect to SQL Database '. $dbname . ' @ ' . $config['dbhost']);
    #TODO: Present an error page
    exit();
}


?>