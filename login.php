<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <?php require 'header.php' ?>
  </head>
  <body>
    <div class="content">
      <h1>Login</h1>
      <form method="POST" action="gallery.php">
        <label><span>Username: </span><input type="text" name="username"></label><br>
        <label><span>Password: </span><input type="password" name="password"></label><br>
        <input type="submit" value="Login">
      </form>
    </div>
  </body>
</html>
