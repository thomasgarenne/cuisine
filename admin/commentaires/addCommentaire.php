<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";
require_once __DIR__ . "/../../lib/validation.php";

if (isset($_POST['commentaire'], $_POST["notes"], $_POST['userId'], $_POST['recetteId'], $_POST['username'])) {
    $errors = [];

    $commentaire = htmlentities($_POST['commentaire']);
    $commentaireValidationResult = validateText('commentaire', $commentaire, 10, 200);
    if ($commentaireValidationResult !== null) {
        $errors[] = $commentaireValidationResult;
    }

    $notes = (int)$_POST['notes'];
    $userId = (int)$_POST['userId'];
    $recetteId = (int)$_POST['recetteId'];
    $username = htmlentities($_POST['username']);

    if (empty($errors)) {
        addCommentaire($pdo, $commentaire, $notes, $userId, $recetteId, $username);
    }
}
