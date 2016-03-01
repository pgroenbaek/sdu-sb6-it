<!DOCTYPE html>
<html>
  <head>
    <title>Upload</title>
    <?php require 'header.php' ?>
  </head>
  <body>
    <div class="content">
      <h1>Upload</h1>
      <form method="POST" action="gallery.php">
        <label>Select file: <input type="text" name="username"></label><button type="button">Browse...</button><br>
        <input type="submit" value="Submit">
      </form>
    </div>
  </body>
</html>
