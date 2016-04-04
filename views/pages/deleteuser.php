
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>
    </div>

    <div class="content">
      <h1>Delete user: <?php echo htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8'); ?></h1>
      <form method="POST" action="/users/delete">
        <input type="hidden" name="userId" value=<?php echo '"' . $user->getId() . '"';?>>
        <label>Are you sure you want to delete the user called '<?php echo htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8'); ?>'?</label><br>
        <input type="submit" value="Yes, delete!">
      </form>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
