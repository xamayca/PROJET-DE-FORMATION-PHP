<?php

class PagesController
{
    public function home()
    {
        require_once '../views/pages/home.php';
    }

    public function testPhp()
    {
        require_once '../views/pages/test/php-test.php';
    }

    public function testDatabase()
    {
        require_once '../views/pages/test/database-test.php';
    }
};
