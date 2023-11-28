<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";

if (isset($_GET['commentaire'], $_GET["notes"], $_GET['userId'], $_GET['recetteId'])) {
    $commentaire = htmlentities($_GET['commentaire']);
    $notes = (int)$_GET['notes'];
    $userId = (int)$_GET['userId'];
    $recetteId = (int)$_GET['recetteId'];
    editCommentaires($pdo, $commentaire, $notes, $userId, $recetteId);
}
