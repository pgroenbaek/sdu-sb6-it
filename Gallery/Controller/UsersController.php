<?php

namespace Gallery\Controller;

use Gallery\Model\UserDao;

class UsersController
{
    private $userDao = null;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function viewAddUser()
    {
        $title = 'Add new user';

        require VIEW_DIR . '/pages/adduser.php';
    }

    public function performAddUser()
    {
        $title = 'Adding user...';

        // TODO: Check for empty POST variables..
        $username = $_POST['username'];
        $password = $_POST['password'];

        $users = $this->userDao->createUser($username, $password);

        $this->viewUsers();
    }

    public function viewUsers()
    {
        $title = 'List of users';

        $users = $this->userDao->getAllUsers();

        require VIEW_DIR . '/pages/userlist.php';
    }

}

?>
