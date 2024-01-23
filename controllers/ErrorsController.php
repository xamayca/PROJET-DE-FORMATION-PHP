<?php

class ErrorsController
{
    public function error404()
    {
        http_response_code(404);
        require_once '../views/pages/errors/404.php';
    }
};
