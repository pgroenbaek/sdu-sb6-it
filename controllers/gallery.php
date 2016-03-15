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

  $stmt = $db->prepare("SELECT uid FROM users WHERE username=?");
  $stmt->bindValue(1, $_SESSION['username'], PDO::PARAM_STR);
  $stmt->execute();
  $firstRow = $stmt->fetch();
  if($firstRow != null) {
    $userId = $firstRow['uid'];
    $fileName = pathinfo($_FILES['fileupload']['name'], PATHINFO_FILENAME);
    $fileExtension = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);

    $stmt = $db->prepare("INSERT INTO images(uid, name, extension) VALUES(?, ?, ?)");
    $stmt->bindValue(1, $userId, PDO::PARAM_INT);
    $stmt->bindValue(2, $fileName, PDO::PARAM_STR);
    $stmt->bindValue(3, $fileExtension, PDO::PARAM_STR);
    $stmt->execute();
    $insertedId = $db->lastInsertId();

    $success = move_uploaded_file($_FILES['fileupload']['tmp_name'], './uploads/' . $insertedId . '.' . $fileExtension);
  }
}



$images = array();

try {
  $stmt = $db->query("SELECT * FROM images LEFT JOIN users ON images.uid = users.uid");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($images, array(
        'imageid' => $row['iid'],
        'username' => $row['username'],
        'imagename' => $row['name'],
        'imageextension' => $row['extension'],
    ));
  }
} catch(PDOException $ex) {
  echo "An error occured!";
  echo $ex->getMessage();
}




$title = 'Gallery';

require VIEW_DIR . '/pages/gallery.php';


?>
