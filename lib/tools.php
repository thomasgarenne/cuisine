<?php

function slugify($text)
{
    // Vérification si $text est une chaîne de caractères
    if (!is_string($text)) {
        return '';
    }

    // Strip html tags
    $text = strip_tags($text);

    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, '-');

    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // Lowercase
    $text = strtolower($text);

    // Check if it is empty
    if (empty($text)) {
        return 'n-a';
    }

    // Return result
    return $text;
}

function saveFiles($uploadDirectory, $inputName)
{
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if ($_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        echo "Une erreur s'est produit lors du téléchargement de l'image.";
        //return false;
    }

    $allowedTypes = ['image/jpeg', 'image.png', 'image.gif'];
    if (!in_array($_FILES[$inputName]['type'], $allowedTypes)) {
        echo "Seules les images au format JPEG, PNG ou GIF sont autorisées.";
        //return false;
    }

    $extension = pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $extension;

    $destination = $uploadDirectory . '/' . $newFileName;

    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $destination)) {
        echo "L'image a été téléchargée avec succés.";
        //return true;
    } else {
        echo "Une erreur s'est produite lors du déplacement de l'image.";
        //return false;
    }

    return $newFileName;
}
