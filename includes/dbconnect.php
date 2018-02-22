<?php

require_once __DIR__.'/dbconfig.php';
global $dbconfig;
try {
    $dbname = "raspberrypints";
    if ($dbconfig['dbprefix'] <> '') {
        $dbname = $dbconfig['dbprefix'] . "_" . $dbname;
    };
    $DBO = new PDO( "mysql:" . "host=" . $dbconfig['dbhost'] . ";" . "dbname=" . $dbname , $dbconfig['dbuser'], $dbconfig['dbpass']);
} catch ( Exception $e ) {
    $log->fatal('Failed to connect to SQL Database '. $dbname . ' @ ' . $dbconfig['dbhost']);
    #TODO: Present an error page
    exit();
}


?>