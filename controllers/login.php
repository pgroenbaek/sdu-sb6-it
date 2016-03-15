<?php

if(!empty($_POST['username']) && !empty($_POST['password'])) {

  try {
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bindValue(1, $_POST['username'], PDO::PARAM_STR);
    $stmt->bindValue(2, $_POST['password'], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
  } catch(PDOException $ex) {
    echo "An error occured!";
    echo $ex->getMessage();
  }

  if($count >= 1) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['isLoggedIn'] = true;
    header('Location: /');
    exit;
  }
}

$title = 'Login';

require VIEW_DIR . '/pages/login.php';

?>
