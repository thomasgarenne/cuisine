<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";
require_once __DIR__ . "/../../lib/session.php";

userOnly();


if ($_SESSION["user"]["role"] == '["ROLE_ADMIN"]' || $_SESSION["user"]["id"] == $_GET["userId"]) {

    if (isset($_GET['userId'], $_GET['recetteId'])) {
        $userId = (int)$_GET['userId'];
        $recetteId = (int)$_GET['recetteId'];

        deleteCommentaire($pdo, $userId, $recetteId);

        if ($_SESSION["user"]["role"] !== '["ROLE_ADMIN"]') {
            header("Location: /user/mesCommentaire.php");
        } else {
            header("Location: /admin/commentaires/commentaires.php");
        }
    }
} else {
    header('Location: /user/mesCommentaire.php');
}
