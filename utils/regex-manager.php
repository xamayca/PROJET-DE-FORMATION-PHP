<?php

class RegexManager
{
    private array $regex;

    public function __construct()
    {
    $currentYear = date('Y');
        $minYear = $currentYear - 120;

        $this->regex = [
            'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/',
            'username' => '/^[A-Za-z0-9_]{3,30}$/',
            'email' => '/^[A-Za-z0-9._%+-]{3,}@[A-Za-z0-9.-]{3,}\.[A-Za-z]{2,6}$/',
            'date' => '/^(' . $minYear . '|' . $currentYear . ')-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/',
            'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/',
        ];
    }

    public function getRegex($key)
    {
        return $this->regex[$key];
    }
}