<?php

if(isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'upload':
      $title = 'Gallery - Upload image';
      require VIEW_DIR . '/pages/upload.php';
      exit;

    case 'logout':
      unset($_SESSION['username']);
      unset($_SESSION['isLoggedIn']);
      header('Location: /');
      exit;

    default:
      break;
  }
}

// Check for file upload.
if(!empty($_FILES['fileupload'])) {
  $success = move_uploaded_file($_FILES['fileupload']['tmp_name'], './public/uploads/' . basename($_FILES['fileupload']['name']));
}

$title = 'Gallery';

require VIEW_DIR . '/pages/gallery.php';


?>
