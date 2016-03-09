<?php

if(isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'adduser':
      $title = 'Users - Add new user';
      require VIEW_DIR . '/pages/adduser.php';
      exit;

    default:
      break;
  }
}

$title = 'Users';

require VIEW_DIR . '/pages/userlist.php';


?>
