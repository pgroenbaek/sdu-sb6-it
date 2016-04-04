
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>
    </div>

    <div class="content">
      <h1>Edit user: <?php echo htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8'); ?></h1>
      <form method="POST" action="/users/edit">
        <input type="hidden" name="userId" value=<?php echo '"' . $user->getId() . '"';?>>
        <label>Username: <input type="text" name="username" value=<?php echo '"' . htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') . '"'; ?>></label><br>
        <label>Password: <input type="password" name="password"></label><br>
        <input type="submit" value="Submit changes">
      </form>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
