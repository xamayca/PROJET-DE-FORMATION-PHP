<?php

class AlertsManager
{
    private array $errors;
    private array $success;

    public function __construct()
    {
        $this->errors = [
            'username' => [
                'required' => 'Le nom d\'utilisateur est requis.',
                'minlength' => 'Le nom d\'utilisateur doit comporter au moins 8 caractères.',
                'maxlength' => 'Le nom d\'utilisateur doit comporter moins de 30 caractères.',
                'invalid' => 'Le nom d\'utilisateur ne doit contenir que des lettres, des chiffres et des traits de soulignement.',
                'exists' => 'Le nom d\'utilisateur existe déjà.'
            ],
            'email' => [
                'required' => 'L\'adresse e-mail est requise.',
                'minlength' => 'L\'adresse e-mail doit comporter au moins 8 caractères.',
                'maxlength' => 'L\'adresse e-mail doit comporter moins de 50 caractères.',
                'invalid' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
                'exists' => 'L\'adresse e-mail existe déjà.',
            ],
            'password' => [
                'required' => 'Le mot de passe est requis.',
                'minlength' => 'Le mot de passe doit comporter au moins 8 caractères.',
                'invalid' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
            ],
            'password_confirm' => [
                'required' => 'La confirmation du mot de passe est requise.',
                'invalid' => 'Les mots de passe ne correspondent pas.'
            ],
            'birthdate' => [
                'invalid' => 'La date dois être une date valide.',
            ],
            'other' => [
                'global' => 'Une erreur s\'est produite. Veuillez réessayer ultérieurement.',
                'login' => 'E-mail ou mot de passe invalide.'
            ]
        ];

        $this->success = [
            'account' => [
                'registration' => 'Inscription réussie. Vous pouvez maintenant vous connecter.',
                'login' => 'Connexion réussie. Bienvenue !',
                'update' => 'Profil mis à jour avec succès.',
            ],
        ];

    }

    public function getErrorMessages($key, $type)
    {
        return $this->errors[$key][$type];
    }
    public function getSuccessMessages($key, $type)
    {
        return $this->success[$key][$type];
    }

}
