<?php
namespace Gallery\Model;

use \PDO;

class ImageDao
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createImage(UserVo $user, $imagename, $extension, $imagedata)
    {
        $stmt = $this->db->prepare("INSERT INTO images(uid, name, ext, data) VALUES(?, ?, ?, ?)");
        $stmt->bindValue(1, $user->getId(), PDO::PARAM_INT);
        $stmt->bindValue(2, $imagename, PDO::PARAM_STR);
        $stmt->bindValue(3, $extension, PDO::PARAM_STR);
        $stmt->bindValue(4, $imagedata, PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function createVulnerableImage(UserVo $user, $imagename, $extension, $imagedata)
    {
        $stmt = $this->db->prepare("INSERT INTO images(uid, name, ext, data) VALUES(" . $user . ", " . $imagename . ", " . $extension . ", " . $imagedata . ")");
        $stmt->execute();
    }

    public function getAllImages()
    {
        $images = array();
        $stmt = $this->db->query("SELECT * FROM images LEFT JOIN users ON images.uid = users.uid");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $user = new UserVo($row['uid'], $row['username'], $row['password'], $row['is_online']);
            $image = new ImageVo($row['iid'], $user, $row['name'], $row['ext'], $row['data']);
            array_push($images, $image);
        }
        return $images;
    }

    public function getImagesByPage($pageNum)
    {
        $limit = 6;

        $images = array();
        $stmt = $this->db->prepare("SELECT * FROM images LEFT JOIN users ON images.uid = users.uid LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $pageNum * $limit - $limit, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $user = new UserVo($row['uid'], $row['username'], $row['password'], $row['is_online']);
            $image = new ImageVo($row['iid'], $user, $row['name'], $row['ext'], $row['data']);
            array_push($images, $image);
        }
        return $images;
    }

    public function getPages()
    {
        $limit = 6;
        $pages = array();
        $stmt = $this->db->prepare("SELECT * FROM images");
        $stmt->execute();

        $pageNum = 1;
        while($pageNum < ($stmt->rowCount()/$limit) + 1)
        {
            array_push($pages, $pageNum);
            $pageNum++;
        }
        return $pages;
    }

    public function getImage($imageId)
    {
        $stmt = $this->db->prepare("SELECT * FROM images LEFT JOIN users ON images.uid = users.uid WHERE images.iid = ?");
        $stmt->bindValue(1, $imageId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $user = new UserVo($row['uid'], $row['username'], $row['password'], $row['is_online']);
        $image = new ImageVo($row['iid'], $user, $row['name'], $row['ext'], $row['data']);
        return $image;
    }

    public function deleteImage($imageId)
    {
        $stmt = $this->db->prepare("DELETE FROM images WHERE iid = ?");
        $stmt->bindValue(1, $imageId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
