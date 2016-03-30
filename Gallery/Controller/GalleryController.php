<?php

namespace Gallery\Controller;

use Gallery\Model\ImageDao;
use Gallery\Model\UserDao;

class GalleryController
{
    private $imageDao = null;
    private $userDao = null;

    public function __construct(ImageDao $imageDao, UserDao $userDao)
    {
        $this->imageDao = $imageDao;
        $this->userDao = $userDao;
    }

    public function viewUpload()
    {
        $title = 'Upload new image';

        require VIEW_DIR . '/pages/upload.php';
    }

    public function performUpload()
    {
        $title = 'Uploading image...';
        $userId = $_SESSION['userId'];


        if(!empty($_FILES['fileupload'])) {

          $tmpName = $_FILES['fileupload']['tmp_name'];
          $fileName = pathinfo($_FILES['fileupload']['name'], PATHINFO_FILENAME);
          $fileExtension = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);

          $data = file_get_contents($tmpName);

          $user = $this->userDao->getUser($userId);
          $this->imageDao->createImage($user, $fileName, $fileExtension, $data);
        }

        $this->viewGallery();
    }

    public function viewImage()
    {
        $title = '404 File Not Found';

        require VIEW_DIR . '/errors/404.php';
    }

    public function viewGallery()
    {
        $title = 'Gallery';

        $images = $this->imageDao->getAllImages();

        require VIEW_DIR . '/pages/gallery.php';
    }
}

?>
