<?php

parse_ini_file('./my_settings.ini');

// Let index.php handle all requests ending with '.php', '.html' or no extension.
// Everything else is served statically.
if (!preg_match('/\\.(html|php)$|^[^.]*$/', $_SERVER['REQUEST_URI'])) {
  return false;
}

/*$file = ($_SERVER['REQUEST_URI'] == '/') ? '/login.php' : $_SERVER['REQUEST_URI'];
require __DIR__ . $file;*/




/*
 PDO Tutorial: http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers
*/
$dbuser = 'peter';
$dbpass = '12345';
$db = new PDO('mysql:host=localhost;dbname=website_gallery', $dbuser, $dbpass, array(
    PDO::ATTR_PERSISTENT => true
));


// Single entry point
require $_SERVER['DOCUMENT_ROOT'] . '/index.php';

?>
