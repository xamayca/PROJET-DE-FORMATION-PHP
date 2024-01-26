<?php

class ErrorsController
{
    public function error404()
    {
        require_once '../views/pages/errors/404.php';
    }

    public function databaseError()
    {
        require_once '../views/pages/errors/database.php';
    }
};
