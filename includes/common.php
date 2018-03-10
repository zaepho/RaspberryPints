<?php
$RPintsVersion = '2.0.3dev';
require __DIR__ . '/../vendor/autoload.php';
# require_once __DIR__ . '/../vendor/apache/log4php/src/main/php/Logger.php';

$logConfig = array(
    'threshold' => 'ALL',
    'rootLogger' => array(
        'appenders' => array('file'),
    ),
    'appenders' => array(
        'default' => array(
            'class' => 'LoggerAppenderEcho',
            'layout' => array(
                'class' =>'LoggerLayoutPattern',
                'params' => array(
                    'conversionPattern' => '%date %logger %-5level %msg%n%ex'
                )
            ),
            'params' => array(
                'htmlLineBreaks' => 'true',
            ),
            // 'threshold' => 'error'
        ),
        'file' => array (
            'class' => 'LoggerAppenderDailyFile',
            'layout' => array(
                'class' =>'LoggerLayoutPattern',
                'params' => array(
                    'conversionPattern' => '%date %logger %-5level %msg%n%ex'
                )
            ),
            'params' => array(
                'datePattern' => 'Ymd',
                'file' => __DIR__ . '/../logs/RPints-%s.log',
            ),
        )
    ),

);

# $logConfig = LoggerConfiguratorDefault::getDefaultConfiguration();
# print_r($logConfig);


Logger::configure($logConfig);
$log = Logger::getLogger('RPints');

$log->debug('Logging started');
require_once __DIR__.'/dbconfig.php';
require_once __DIR__.'/dbconnect.php';
require_once __DIR__.'/config.php';


$log->debug("Loaded Commons for RPints " . $RPintsVersion);


?>