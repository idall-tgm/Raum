<?php
// This file generated by Propel 1.7.0 convert-conf target
// from XML runtime conf file /var/www/Raum/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'Raum' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=localhost;dbname=Raum',
        'user' => 'root',
        'password' => 'root',
      ),
    ),
    'default' => 'Raum',
  ),
  'generator_version' => '1.7.0',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap--conf.php');
return $conf;