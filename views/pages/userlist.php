
<?php require VIEW_DIR . '/header.php' ?>
    <div class="menu">
      <a href="/">Gallery</a>&nbsp;&nbsp;
      <a href="/users" class="selected">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>&nbsp;&nbsp;
      <a href="/users/add" class="right">Add user</a>
    </div>

    <div class="content">
      <h1>User list</h1>
      <table>

        <tr>
          <th>Id</th>
          <th>Username</th>
          <th>Online?</th>
          <th>Actions</th>
        </tr>

        <?php

        foreach($users as $user) {
          echo '<tr>';
          echo '  <td>' . $user->getId() . '</td>';
          echo '  <td>' . htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') . '</td>';
          if($user->getIsOnline()) {
            echo '  <td>[X]</td>';
          }
          else {
            echo '  <td>[&nbsp;&nbsp;]</td>';
          }
          echo '  <td><a href="/users/edit/' . $user->getId() . '">Edit</a> <a href="/users/delete/' . $user->getId() . '">Delete</a></td>';
          echo '</tr>';
        }

        ?>
      </table>
    </div>

<?php require VIEW_DIR . '/footer.php' ?>
