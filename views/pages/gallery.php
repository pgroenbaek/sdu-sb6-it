
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

        if($handle = opendir('./public/uploads/')) {

          while(false !== ($entry = readdir($handle))) {
            if($entry != '.' && $entry != '..') {
              echo '<div class="gallery-item">';
              echo '  <div class="gallery-item-name">';
              echo '    <p><b>' . $entry . '<b></p>';
              echo '  </div>';
              echo '  <div class="gallery-item-image">';
              echo '    <img alt="image" src="./public/uploads/' . $entry . '"/>';
              echo '  </div>';
              echo '</div>';
            }
          }

        }


        ?>

      </div>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
