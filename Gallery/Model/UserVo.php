<?php

namespace Gallery\Model;

class UserVo
{
    private $id;
    private $username;
    private $password;
    private $isOnline;

    public function __construct($id, $username, $password, $isOnline)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->isOnline = $isOnline;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        if($this->username == null) {
            return '[deleted]';
        }
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIsOnline()
    {
        return $this->isOnline;
    }

    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}

?>
