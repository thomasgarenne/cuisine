<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";
require_once __DIR__ . "/../../lib/validation.php";

if (isset($_GET['comment'], $_GET["notes"], $_GET['userId'], $_GET['recetteId'], $_GET['username'])) {
    $errors = [];

    $commentaire = htmlentities($_GET['comment']);
    $commentaireValidationResult = validateText('commentaire', $commentaire, 10, 200);
    if ($commentaireValidationResult !== null) {
        $errors[] = $commentaireValidationResult;
    }

    $notes = (int)$_GET['notes'];
    $userId = (int)$_GET['userId'];
    $recetteId = (int)$_GET['recetteId'];
    $username = htmlentities($_GET['username']);

    if (empty($errors)) {
        try {
            addCommentaire($pdo, $commentaire, $notes, $userId, $recetteId, $username);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $errors[] = "Erreur : Vous avez déjà ajouté un commentaire";
            } else {
                $errors[] = "Une erreur s'est produite : " . $e->getMessage();
            }
            $result = [
                'success' => false,
                'message' => $errors,
            ];

            echo json_encode($result);
        }
    } else {
        $result = [
            'success' => false,
            'message' => $errors,
        ];

        echo json_encode($result);
    }
}
