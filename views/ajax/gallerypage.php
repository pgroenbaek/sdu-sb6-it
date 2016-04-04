
<?php

  if(!empty($pages))
  {
    echo '<div class="page-thingy">';
    echo '  Pages:&nbsp;&nbsp;';
    foreach($pages as $pagesItem) {
      if($pagesItem == $page)
      {
        echo '  <a onclick="showPage(' . $pagesItem . ')" href="javascript:void(0);" class="selected">' . $pagesItem . '</a>&nbsp;&nbsp;';
      }
      else
      {
        echo '  <a onclick="showPage(' . $pagesItem . ')" href="javascript:void(0);">' . $pagesItem . '</a>&nbsp;&nbsp;';
      }
    }
    echo '</div>';
    echo '<br/>';
    echo '<br/>';
  }

  foreach($images as $image) {
    echo '<a href="/image/' . $image->getId() . '">';
    echo '  <div class="gallery-item">';
    echo '    <div class="gallery-item-name">';
    echo '      <p><b>' . htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8') . '</b></p>';
    echo '    </div>';
    echo '    <div class="gallery-item-postedby">';
    echo '      <p><b>Posted by: ' . htmlspecialchars($image->getUser()->getUsername(), ENT_QUOTES, 'UTF-8') . '</b></p>';
    echo '    </div>';
    echo '    <div class="gallery-item-image">';
    echo '      <img alt="' . htmlspecialchars($image->getName(), ENT_QUOTES, 'UTF-8') . '" src="data:image/' . htmlspecialchars($image->getExtension(), ENT_QUOTES, 'UTF-8') . ';base64,' . base64_encode($image->getData()) . '"/>';
    echo '    </div>';
    echo '  </div>';
    echo '</a>';
  }

?>
