
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>
    </div>

    <div class="content">
      <h1>Add user</h1>
      <form method="POST" action="/users">
        <label>Username: <input type="text" name="username"></label><br>
        <label>Password: <input type="text" name="password"></label><br>
        <input type="submit" value="Add">
      </form>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
