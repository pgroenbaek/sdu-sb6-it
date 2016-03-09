
<?php require VIEW_DIR . '/header.php' ?>
    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/?action=logout" class="right">Log out</a>
    </div>

    <div class="content">
      <h1>Upload</h1>
      <form enctype="multipart/form-data" method="POST" action="/">
        <!-- input type="hidden" name="MAX_FILE_SIZE" value="30000" /-->
        <input type="file" name="fileupload">
        <br>
        <input type="submit" value="Submit">
      </form>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
