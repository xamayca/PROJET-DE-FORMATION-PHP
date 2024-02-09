<?php
require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';

class LogoutController
{
    public function logout()
    {
        // NETTOIE TOUTES LES DONNÉES DE LA SESSION //
        $_SESSION = [];

        // DETRUIT LA SESSION //
        session_destroy();

        // REDEMARRE LA SESSION POUR STOCKER LE MESSAGE DE SUCCÈS //
        session_start();

        // INITIALISE LE MESSAGE DE SUCCÈS //
        $messageManager = new MessageManager();
        $_SESSION['success'] = $messageManager->getMessage('success', 'logged_out');

        // REDIRECTION VERS LA PAGE D'ACCUEIL //
        header('Location: /');
        exit;
    }
}