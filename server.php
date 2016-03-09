<?php
// Let index.php handle all requests ending with '.php', '.html' or no extension.
// Everything else is served statically.
if (!preg_match('/\\.(html|php)$|^[^.]*$/', $_SERVER['REQUEST_URI'])) {
  return false;
}

/*$file = ($_SERVER['REQUEST_URI'] == '/') ? '/login.php' : $_SERVER['REQUEST_URI'];
require __DIR__ . $file;*/


// Single entry point
require $_SERVER['DOCUMENT_ROOT'] . '/public/index.php';

?>
