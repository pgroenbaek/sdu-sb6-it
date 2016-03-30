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
}

?>
