<!DOCTYPE html>
<html>
  <head>
    <title>Add user</title>
    <?php require 'header.php' ?>
  </head>
  <body>
    <div class="content">
      <h1>Add user</h1>
      <form method="POST" action="userlist.php">
        <label>Username: <input type="text" name="username"></label><br>
        <label>Password: <input type="password" name="password"></label><br>
        <input type="submit" value="Add">
      </form>
    </div>
  </body>
</html>
