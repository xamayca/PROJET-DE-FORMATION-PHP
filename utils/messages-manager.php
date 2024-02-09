<?php

class MessageManager {
    private array $messages;

    public function __construct() {
        $this->messages = [
            'error' => [
                'invalid_credentials' => 'Identifiant ou mot de passe incorrect.',
                'username_exists' => 'Le nom d\'utilisateur existe déjà.',
                'email_exists' => 'L\'adresse e-mail existe déjà.',
                'password_required' => 'Le mot de passe est requis.',
                'password_confirm_required' => 'La confirmation du mot de passe est requise.',
                'password_confirm_invalid' => 'La confirmation du mot de passe est invalide.',
                'birthdate_required' => 'La date de naissance est requise.',
                'birthdate_invalid' => 'La date de naissance doit être une date valide.',
                'age_invalid' => 'Vous devez avoir plus de 10 ans pour pouvoir vous inscrire.',
                'unexpected_error' => 'Une erreur inattendue s\'est produite. Veuillez réessayer plus tard.',
            ],
            'success' => [
                'logged_in' => 'Connexion réussie. Bienvenue !',
                'logged_out' => 'Déconnexion réussie. À bientôt !',
                'registered' => 'Inscription réussie. Vous pouvez maintenant vous connecter.',
            ],
        ];
    }

    public function getMessage($type, $key): string
    {
        return $this->messages[$type][$key] ?? '';
    }
}
