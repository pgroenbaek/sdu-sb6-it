<?php
error_reporting(-1);
ini_set('display_errors', 1);
if (!preg_match('/\\.(html|php)$|^[^.]*$/', $_SERVER['REQUEST_URI'])) {
 return false;
}
$file = ($_SERVER['REQUEST_URI'] == '/') ? '/login.php' : $_SERVER['REQUEST_URI'];
require __DIR__ . $file;
?>
