<?php
function cleanInput($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    return $data;
}