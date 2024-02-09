<?php

class PagesController
{
    public function home()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/home.php';
        require_once "../views/elements/footer.php";
    }

    public function testPhp()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/test/php-test.php';
        require_once "../views/elements/footer.php";
    }

    public function testDatabase()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/test/database-test.php';
        require_once "../views/elements/footer.php";
    }

    public function registration()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/account/registration.php';
        require_once "../views/elements/footer.php";
    }

    public function login()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/account/login.php';
        require_once "../views/elements/footer.php";
    }

    public function error404()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/errors/404-error.php';
        require_once "../views/elements/footer.php";
    }

    public function databaseError()
    {
        require_once "../views/elements/header.php";
        require_once '../views/pages/errors/DB-error.php';
        require_once "../views/elements/footer.php";
    }
};
