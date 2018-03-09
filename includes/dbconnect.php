<?php
require_once __DIR__.'/dbconfig.php';
global $dbconfig;
try {
    $DBO = new PDO( "mysql:" . "host=" . $dbconfig['dbhost'] . ";" . "dbname=" . $dbconfig['dbname'] , $dbconfig['dbuser'], $dbconfig['dbpass']);
} catch ( Exception $e ) {
    $log->fatal('Failed to connect to SQL Database '. $dbname . ' @ ' . $dbconfig['dbhost']);
    #TODO: Present an error page
    exit();
}
?>