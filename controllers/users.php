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


if(!empty($_POST['username']) && !empty($_POST['password'])) {
  try {
    $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bindValue(1, $_POST['username'], PDO::PARAM_STR);
    $stmt->execute();
    $userCount = $stmt->rowCount();

    if($userCount == 0) {
      $stmt = $db->prepare("INSERT INTO users(username, password) VALUES(?, ?)");
      $stmt->bindValue(1, $_POST['username'], PDO::PARAM_STR);
      $stmt->bindValue(2, $_POST['password'], PDO::PARAM_STR);
    }
    else {
      echo 'A user with that name already exists';
    }
    $stmt->execute();
  } catch(PDOException $ex) {
    echo "An error occured!";
    echo $ex->getMessage();
  }
}



$users = array();

try {
  $stmt = $db->query("SELECT * FROM users");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($users, $row['username']);
  }
} catch(PDOException $ex) {
  echo "An error occured!";
  echo $ex->getMessage();
}

$title = 'Users';

require VIEW_DIR . '/pages/userlist.php';


?>
