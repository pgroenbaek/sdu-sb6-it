
<?php require VIEW_DIR . '/header.php' ?>
    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users" class="selected">User list</a>&nbsp;&nbsp;
      <a href="/?action=logout" class="right">Log out</a>&nbsp;&nbsp;
      <a href="/users?action=adduser" class="right">Add user</a>
    </div>

    <div class="content">
      <h1>User list</h1>
      <table>

        <tr>
          <th>User</th>
          <th>Who am i?</th>
        </tr>

        <?php

        for($i = 0; $i < count($logincredentials); $i++) {

          $isOnline = '[&nbsp;&nbsp;]';
          if($logincredentials[$i][0] == $_SESSION['username']) {
            $isOnline = '[X]';
          }

          echo '<tr>';
          echo '  <th>' . $logincredentials[$i][0] . '</th>';
          echo '  <th>' . $isOnline . '</th>';
          echo '</tr>';
        }

        ?>
      </table>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>