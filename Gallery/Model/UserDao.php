<?php

namespace Gallery\Model;

use \PDO;

class UserDao
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function doesUserExist($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bindValue(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $userCount = $stmt->rowCount();
        if($userCount == 0) {
            return false;
        }
        return true;
    }

    public function createUser($username, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO users(username, password) VALUES(?, ?)");
        $stmt->bindValue(1, $username, PDO::PARAM_STR);
        $stmt->bindValue(2, $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateUser(UserVo $user)
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ?, is_online = ? WHERE uid = ?");
        $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(3, $user->getIsOnline(), PDO::PARAM_BOOL);
        $stmt->bindValue(4, $user->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteUser($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE uid = ?");
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getUser($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE uid = ?");
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();

        $user = new UserVo($row['uid'], $row['username'], $row['password'], $row['is_online']);
        return $user;
    }

    public function getUserByName($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindValue(1, $username, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();

        $user = new UserVo($row['uid'], $row['username'], $row['password'], $row['is_online']);
        return $user;
    }

    public function getAllUsers()
    {
        $users = array();
        $stmt = $this->db->query("SELECT * FROM users");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new UserVo($row['uid'], $row['username'], $row['password'], $row['is_online']);
            array_push($users, $user);
        }
        return $users;
    }
}

?>
