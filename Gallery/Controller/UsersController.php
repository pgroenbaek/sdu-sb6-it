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

    public function viewEditUser($userId)
    {
        $title = 'Edit user';

        $user = $this->userDao->getUser($userId);

        require VIEW_DIR . '/pages/edituser.php';
    }

    public function viewDeleteUser($userId)
    {
        $title = 'Delete user';

        $user = $this->userDao->getUser($userId);

        require VIEW_DIR . '/pages/deleteuser.php';
    }

    public function performEditUser()
    {
        $title = 'Editing user...';

        $username = $_POST['username'];
        $password = $_POST['password'];
        $userId = $_POST['userId'];

        if(!empty($userId) && !empty($username))
        {
            $user = $this->userDao->getUser($userId);
            $user->setUsername($username);
            if(!empty($password))
            {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $user->setPassword($password);
            }
            $this->userDao->updateUser($user);
        }

        header('Location: /users');
    }

    public function performAddUser()
    {
        $title = 'Adding user...';

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password))
        {
            $password = password_hash($password, PASSWORD_BCRYPT);

            $this->userDao->createUser($username, $password);
        }

        header('Location: /users');
    }

    public function performDeleteUser()
    {
        $title = 'Deleting user...';

        $userId = $_POST['userId'];

        if(!empty($userId))
        {
            $this->userDao->deleteUser($userId);

            // Return user to login screen if it deletes itself.
            if($userId == $_SESSION['userId']) {
                header('Location: /logout');
                exit;
            }
        }

        header('Location: /users');
    }

    public function viewUsers()
    {
        $title = 'List of users';

        $users = $this->userDao->getAllUsers();

        require VIEW_DIR . '/pages/userlist.php';
    }

}

?>
