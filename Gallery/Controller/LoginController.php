<?php

namespace Gallery\Controller;

use Gallery\Model\UserDao;

class LoginController
{
    private $userDao = null;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function showLogin()
    {
        $title = 'Login';

        require VIEW_DIR . '/pages/login.php';
    }

    public function performLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)) {
            if($this->userDao->performLogin($username, $password)) {
                $user = $this->userDao->getUserByName($username);
                $user->setIsOnline(true);
                $this->userDao->updateUser($user);

                $_SESSION['userId'] = $user->getId();
                $_SESSION['isLoggedIn'] = true;
                header('Location: /');
                exit;
            }
        }
    }

    public function performLogout()
    {
        $title = 'Logging out...';

        $user = $this->userDao->getUser($_SESSION['userId']);
        $user->setIsOnline(false);
        $this->userDao->updateUser($user);

        unset($_SESSION['userId']);
        unset($_SESSION['isLoggedIn']);
        header('Location: /');
    }

}

?>
