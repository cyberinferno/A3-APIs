<?php
/*
* Main file which handles all API requests
*/

error_reporting(0);
require('RestServer.php');
spl_autoload_register(); // don't load our classes unless we use them
$mode = 'debug'; // 'debug' or 'production'
$server = new RestServer($mode);
// $server->refreshCache(); // uncomment momentarily to clear the cache if classes change in production mode
$server->addClass('Dummy', '/a3');
$server->addClass('AccMgmnt', '/a3/account');
$server->addClass('CharMgmnt', '/a3/character');
$server->addClass('MercMgmnt', '/a3/mercenary');
$server->addClass('Stats', '/a3/stats');
$server->handle();
?>