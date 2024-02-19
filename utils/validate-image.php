<?php

function validateImage($image, $messageManager) {

    // TAILLE MAXIMALE DE L'IMAGE 3 MO //
    $maxFileSize = 3 * 1024 * 1024;

    // ERREUR 4 = AUCUN FICHIER UPLOADE //
    if ($image['error'] != 4) {
        // ERREUR 1 = TAILLE DU FICHIER SUPERIEURE A LA TAILLE MAXIMALE //
        if ($image['error'] != 1 && $image['size'] > 0 && $image['size'] <= $maxFileSize) {
            // SI AUCUNE ERREUR, ON VERIFIE L'EXTENSION ET LE MIME TYPE //
            if ($image['error'] == 0) {

                // TABLEAU DES EXTENSIONS ET DES MIME TYPES CORRESPONDANTS //
                $extensionArray = [
                    'jpg' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                    'webp' => 'image/webp',
                ];

                $imgExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

                // VERIFICATION DE L'EXTENSION ET DU MIME TYPE //
                $fileMimeType = mime_content_type($image['tmp_name']);

                // SI L'EXTENSION N'EST PAS DANS LE TABLEAU OU QUE LE MIME TYPE N'EST PAS DANS LE TABLEAU, ON RETOURNE UNE ERREUR //
                if (!array_key_exists($imgExtension, $extensionArray) || !in_array($fileMimeType, $extensionArray)) {
                    return $messageManager->getMessage('error', 'image_invalid');
                }
            } else {
                return $messageManager->getMessage('error', 'image_invalid');
            }
        } else {
            return $messageManager->getMessage('error', 'image_maxsize');
        }
    } else {
        return $messageManager->getMessage('error', 'image_required');
    }

    return true;
}