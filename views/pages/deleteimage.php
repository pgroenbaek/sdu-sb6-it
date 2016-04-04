
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>
    </div>

    <div class="content">
      <h1>Delete image: <?php echo htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8'); ?></h1>
      <form method="POST" action="/image/delete">
        <input type="hidden" name="imageId" value=<?php echo '"' . $image->getId() . '"';?>>
        <label>Are you sure you want to delete the user called '<?php echo htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8') ?>'?</label><br>
        <input type="submit" value="Yes, delete!">
      </form>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
