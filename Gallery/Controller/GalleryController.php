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

        header('Location: /');
    }

    public function viewImage($imageId)
    {
        $title = 'Image';

        $image = $this->imageDao->getImage($imageId);

        require VIEW_DIR . '/pages/image.php';
    }

    public function viewDeleteImage($imageId)
    {
        $title = 'Delete image';

        $image = $this->imageDao->getImage($imageId);

        require VIEW_DIR . '/pages/deleteimage.php';
    }

    public function performDeleteImage()
    {
        $title = 'Deleting image...';

        $imageId = $_POST['imageId'];

        if(!empty($imageId))
        {
            $this->imageDao->deleteImage($imageId);
        }

        header('Location: /');
    }

    public function viewGallery()
    {
        $title = 'Gallery';

        if(empty($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = $_GET['page'];
        }

        $images = $this->imageDao->getImagesByPage($page);
        $pages = $this->imageDao->getPages();

        require VIEW_DIR . '/pages/gallery.php';
    }

    public function retrieveGalleryPage()
    {
        if(!empty($_POST['page']))
        {
            $page = $_POST['page'];
        }
        else {
            $page = 1;
        }

        $images = $this->imageDao->getImagesByPage($page);
        $pages = $this->imageDao->getPages();

        require VIEW_DIR . '/ajax/gallerypage.php';
    }
}

?>
