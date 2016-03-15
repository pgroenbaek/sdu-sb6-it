
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/" class="selected">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/?action=logout" class="right">Log out</a>&nbsp;&nbsp;
      <a href="/?action=upload" class="right">Upload image</a>
    </div>

    <div class="content">
      <h1>Gallery</h1>
      <div class="gallery">

        <?php


          foreach($images as $image) {
            echo '<div class="gallery-item">';
            echo '  <div class="gallery-item-name">';
            echo '    <p><b>' . $image['imagename'] . '<b></p>';
            echo '  </div>';
            echo '  <div class="gallery-item-postedby">';
            echo '    <p><b>Posted by ' . $image['username'] . '<b></p>';
            echo '  </div>';
            echo '  <div class="gallery-item-image">';
            echo '    <img alt="image" src="./uploads/' . $image['imageid'] . '.' . $image['imageextension'] . '"/>';
            echo '  </div>';
            echo '</div>';
          }

        ?>

      </div>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
