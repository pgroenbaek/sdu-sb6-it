<?php

parse_ini_file('./my_settings.ini');

// Let index.php handle all requests ending with '.php', '.html' or no extension.
// Everything else is served statically.
if (!preg_match('/\\.(html|php)$|^[^.]*$/', $_SERVER['REQUEST_URI'])) {
  return false;
}


// Single entry point
require $_SERVER['DOCUMENT_ROOT'] . '/index.php';

?>
