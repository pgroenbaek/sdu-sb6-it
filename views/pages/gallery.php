
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/" class="selected">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>&nbsp;&nbsp;
      <a href="/upload" class="right">Upload image</a>
    </div>

    <div class="content">
      <h1>Gallery</h1>
      <div class="gallery">

        <?php


          foreach($images as $image) {
            echo '<div class="gallery-item">';
            echo '  <div class="gallery-item-name">';
            echo '    <p><b>' . $image->getName() . '<b></p>';
            echo '  </div>';
            echo '  <div class="gallery-item-postedby">';
            echo '    <p><b>Posted by ' . $image->getUser()->getUsername() . '<b></p>';
            echo '  </div>';
            echo '  <div class="gallery-item-image">';
            echo '    <img alt="' . $image->getName() . '" src="data:image/' . $image->getExtension() . ';base64,' . base64_encode($image->getData()) . '"/>';
            echo '  </div>';
            echo '</div>';
          }

        ?>

      </div>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
