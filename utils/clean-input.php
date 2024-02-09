<?php

/** NETTOIE LA CHAÎNE DE DONNÉES EN SUPPRIMANT LES ESPACES VIDES ET LES BALISES HTML. */
function cleanInput($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    return $data;
}