<?php
require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';

class LogoutController
{
    // LOGIQUE POUR SE DÉCONNECTER DE L'APPLICATION //
    public function logout()
    {
        // ON INSTANCIE LES CLASSES MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();

        // NETTOIE TOUTES LES DONNÉES DE LA SESSION //
        $_SESSION = [];

        // DETRUIT LA SESSION //
        session_destroy();

        // REDEMARRE LA SESSION POUR STOCKER LE MESSAGE DE SUCCÈS //
        session_start();

        // MESSAGE DE SUCCÈS SI L'UTILISATEUR EST DÉCONNECTÉ //
        $_SESSION['success'] = $messageManager->getMessage('success', 'logged_out');

        // REDIRECTION VERS LA PAGE D'ACCUEIL //
        header('Location: /');
        // FIN DE L'EXECUTION DU SCRIPT //
        exit;
    }
}