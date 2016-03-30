<?php

namespace Gallery\Model;

class ImageVo
{
    private $id;
    private $user;
    private $name;
    private $ext;
    private $data;

    public function __construct($id, UserVo $user, $name, $ext, $data)
    {
        $this->id = $id;
        $this->user = $user;
        $this->name = $name;
        $this->ext = $ext;
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExtension()
    {
        return $this->ext;
    }

    public function getData()
    {
        return $this->data;
    }
}

?>
