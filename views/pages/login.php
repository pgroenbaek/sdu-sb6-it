
<?php require VIEW_DIR . '/header.php' ?>

    <div class="content">
      <h1>Login</h1>
      <form method="POST" action="login">
        <label><span>Username: </span><input type="text" name="username"></label><br>
        <label><span>Password: </span><input type="password" name="password"></label><br>
        <input type="submit" value="Login">
      </form>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
