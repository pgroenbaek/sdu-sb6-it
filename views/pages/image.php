
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>&nbsp;&nbsp;
      <a href="/upload" class="right">Upload image</a>
    </div>

    <div class="content">
      <h1>Image: <?php echo htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8'); ?></h1>
      <div id="image">

        <?php

          echo '<div class="gallery-item-big">';
          echo '  <div class="gallery-item-name">';
          echo '    <p><b>' . htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8') . '<b></p>';
          echo '  </div>';
          echo '  <div class="gallery-item-postedby">';
          echo '    <p><b>Posted by: ' . htmlspecialchars($image->getUser()->getUsername(), ENT_QUOTES, 'UTF-8') . '<b></p>';
          echo '  </div>';
          echo '  <div class="gallery-item-postedby">';
          echo '    <p><b>Actions: <a href="/image/delete/' . $image->getId() . '">Delete</a><b></p>';
          echo '  </div>';
          echo '  <div class="gallery-item-image-big">';
          echo '    <img alt="' . htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8') . '" src="data:image/' . htmlspecialchars($image->getExtension(), ENT_QUOTES, 'UTF-8') . ';base64,' . base64_encode($image->getData()) . '"/>';
          echo '  </div>';
          echo '</div>';

        ?>

      </div>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
