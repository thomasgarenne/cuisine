<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";

if (isset($_POST['commentaire'], $_POST["notes"], $_POST['userId'], $_POST['recetteId'])) {
    $commentaire = htmlentities($_POST['commentaire']);
    $notes = (int)$_POST['notes'];
    $userId = (int)$_POST['userId'];
    $recetteId = (int)$_POST['recetteId'];
    editCommentaires($pdo, $commentaire, $notes, $userId, $recetteId);
}
