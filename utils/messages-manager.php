<?php

class MessageManager {
    private array $messages;

    public function __construct() {
        $this->messages = [

            'error' => [
                // ERREURS POUR LES UTILISATEURS [CRUD] //
                'user_not_found' => 'L\'utilisateur n\'éxiste pas dans la base de données.',
                'invalid_credentials' => 'Identifiant ou mot de passe incorrect.',
                'username_required' => 'Le nom d\'utilisateur est requis.',
                'username_exists' => 'Le nom d\'utilisateur existe déjà.',
                'username_invalid' => 'Le nom d\'utilisateur est invalide.',
                'username_minlength' => 'Le nom d\'utilisateur est trop petit.',
                'username_maxlength' => 'Le nom d\'utilisateur est trop long.',
                'tribe_maxlength' => 'La tribu est trop longue.',
                'email_required' => 'L\'adresse e-mail est requise.',
                'email_exists' => 'L\'adresse e-mail existe déjà.',
                'email_invalid' => 'L\'adresse e-mail est invalide.',
                'phone_invalid' => 'Le numéro de téléphone est invalide.',
                'password_required' => 'Le mot de passe est requis.',
                'password_invalid' => 'Le mot de passe est invalide.',
                'password_minlength' => 'Le mot de passe est trop petit.',
                'password_confirm_required' => 'La confirmation du mot de passe est requise.',
                'password_confirm_invalid' => 'La confirmation du mot de passe est invalide.',
                'new_password_required' => 'Le nouveau mot de passe est requis.',
                'new_password_invalid' => 'Le nouveau mot de passe est invalide.',
                'new_password_minlength' => 'Le nouveau mot de passe est trop petit.',
                'birthdate_required' => 'La date de naissance est requise.',
                'birthdate_invalid' => 'La date de naissance doit être une date valide.',
                'description_maxlength' => 'La description est trop longue.',
                'signature_maxlength' => 'La signature est trop longue.',
                'age_invalid' => 'Vous devez entrer une date de naissance valide.',
                'must_be_logged_in' => 'Vous devez être connecté pour accéder à cette page.',

                // ERREURS POUR LES ARTICLES [CRUD] //
                'title_required' => 'Le titre de l\'article est requis.',
                'title_minlength' => 'Le titre de l\'article est trop petit.',
                'title_maxlength' => 'Le titre de l\'article est trop long.',
                'title_invalid' => 'Le titre de l\'article est invalide.',
                'content_required' => 'Le contenu de l\'article est requis.',
                'content_minlength' => 'Le contenu de l\'article est trop petit.',
                'content_maxlength' => 'Le contenu de l\'article est trop long.',
                'content_invalid' => 'Le contenu de l\'article est invalide.',
                'categories_required' => 'La catégorie de l\'article est requise.',
                'categories_invalid' => 'La catégorie de l\'article est invalide.',
                'cover_invalid' => 'L\'image de couverture de l\'article est invalide.',
                'cover_required' => 'L\'image de couverture de l\'article est requise.',
                'cover_maxsize' => 'L\'image de couverture de l\'article ne doit pas dépasser 3 Mo.',
                'cover_move_error' => 'Une erreur s\'est produite lors du téléchargement de l\'image de couverture de l\'article.',

                // ERREURS POUR LES IMAGES //
                'image_not_uploaded' => 'L\'image n\'a pas été téléchargée.',
                'image_invalid' => 'Le fichier n\'est pas une image valide.',
                'image_maxsize' => 'L\'image ne doit pas dépasser 3 Mo.',
                'image_required' => 'L\'image est requise.',
                'image_move_error' => 'Une erreur s\'est produite lors du téléchargement de l\'image.',

                // AUTRES ERREURS //
                'unexpected_error' => 'Une erreur s\'est produite, veuillez réessayer plus tard.',
                ],

            'success' => [
                // SUCCÈS POUR LES UTILISATEURS [CRUD] //
                'logged_in' => 'Connexion réussie, bienvenue {{username}} !',
                'logged_out' => 'Déconnexion réussie, à bientôt !',
                'registered' => 'Inscription réussie, vous pouvez vous connecter.',
                'email_updated' => 'L\'adresse e-mail a été mise à jour avec succès.',
                'tribe_updated' => 'La tribu a été mise à jour avec succès.',
                'username_updated' => 'Le nom d\'utilisateur a été mis à jour avec succès.',
                'phone_updated' => 'Le numéro de téléphone a été mis à jour avec succès.',
                'signature_updated' => 'La signature a été mise à jour avec succès.',
                'description_updated' => 'La description a été mise à jour avec succès.',
                'password_updated' => 'Le mot de passe a été mis à jour avec succès.',
                'avatar_updated' => 'L\'avatar a été mis à jour avec succès.',
                'account_deleted' => 'Votre compte a été supprimé avec succès.',
            ],
        ];
    }

    // GETTER POUR RECUPERER LES MESSAGES D'ERREURS ET DE SUCCES //
    public function getMessage($type, $key): string
    {
        return $this->messages[$type][$key] ?? '';
    }
}
