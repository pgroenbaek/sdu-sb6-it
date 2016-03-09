<?php

if(!empty($_POST['username']) && !empty($_POST['password'])) {
  for($index = 0; $index < count($logincredentials); $index++) {
    if($logincredentials[$index][0] == $_POST['username'] && $logincredentials[$index][1] == $_POST['password']) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['isLoggedIn'] = true;
      header('Location: /');
      exit;
    }
  }
}

$title = 'Login';

require VIEW_DIR . '/pages/login.php';

?>
