<?php

class RegexManager
{
    private array $regex;

    public function __construct()
    {

        $this->regex = [
            //REGEX POUR LES INFORMATIONS DE L'UTILISATEUR //
            'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/',
            'username' => '/^[A-Za-z0-9_]{3,30}$/',
            'email' => '/^[A-Za-z0-9._%+-]{3,}@[A-Za-z0-9.-]{3,}\.[A-Za-z]{2,6}$/',
            'birthdate' => '/^(\d{4})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/',
            'phone' => '/(0[1-79])([0-9]{2}){4}$/',

            // REGEX POUR LES INFORMATIONS DE L'ARTICLE //
            'title' => '/^[A-zÄ-ÿ0-9]{1,}[ \-\',A-zÄ-ÿ0-9\?\!\:\/]{1,}$/',
            'content' => '/(<script>|(&lt;script&gt;))/',
            ];
    }

    public function getRegex($key)
    {
        return $this->regex[$key];
    }
}