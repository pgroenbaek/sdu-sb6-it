<?php

namespace Gallery\Controller;

class ErrorController
{
    public function error404()
    {
        $title = '404 Not Found';

        require VIEW_DIR . '/errors/404.php';
    }
}

?>
