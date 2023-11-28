<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/likes.php";

if (isset($_GET["recetteId"], $_GET["userId"])) {
	$recetteId = (int)$_GET["recetteId"];
	$userId = (int)$_GET["userId"];
	addLike($pdo, $recetteId, $userId);
}
