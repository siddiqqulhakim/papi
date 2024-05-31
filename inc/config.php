<?php
//-- 
define('_ISONLINE', false);
//-- assets folder
define('_ASSET', 'assets/');
//-- database configuration
$dbhost = '194.163.42.176';
$dbuser = 'u1738039_papi';
$dbpass = 'H*0azqD0!5T^';
$dbname = 'u1738039_papi';
//-- database connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
}