<?php

class MessageManager {
    private array $messages;

    public function __construct() {
        $this->messages = [
            'error' => [
                'user_not_found' => 'L\'utilisateur n\'éxiste pas dans la base de données.',
                'invalid_credentials' => 'Identifiant ou mot de passe incorrect.',
                'username_required' => 'Le nom d\'utilisateur est requis.',
                'username_exists' => 'Le nom d\'utilisateur existe déjà.',
                'username_invalid' => 'Le nom d\'utilisateur est invalide.',
                'username_minlength' => 'Le nom d\'utilisateur est trop petit.',
                'username_maxlength' => 'Le nom d\'utilisateur est trop long.',
                'email_required' => 'L\'adresse e-mail est requise.',
                'email_exists' => 'L\'adresse e-mail existe déjà.',
                'email_invalid' => 'L\'adresse e-mail est invalide.',
                'password_required' => 'Le mot de passe est requis.',
                'password_invalid' => 'Le mot de passe est invalide.',
                'password_minlength' => 'Le mot de passe est trop petit.',
                'password_confirm_required' => 'La confirmation du mot de passe est requise.',
                'password_confirm_invalid' => 'La confirmation du mot de passe est invalide.',
                'birthdate_required' => 'La date de naissance est requise.',
                'birthdate_invalid' => 'La date de naissance doit être une date valide.',
                'age_invalid' => 'Vous devez entrer une date de naissance valide.',
                'unexpected_error' => 'Une erreur s\'est produite, veuillez réessayer plus tard.',
                'must_be_logged_in' => 'Vous devez être connecté pour accéder à cette page.',
            ],
            'success' => [
                'logged_in' => 'Connexion réussie, bienvenue {{username}} !',
                'logged_out' => 'Déconnexion réussie, à bientôt !',
                'registered' => 'Inscription réussie, vous pouvez vous connecter.',
            ],
        ];
    }

    // GETTER POUR RECUPERER LES MESSAGES D'ERREURS ET DE SUCCES //
    public function getMessage($type, $key): string
    {
        return $this->messages[$type][$key] ?? '';
    }
}
