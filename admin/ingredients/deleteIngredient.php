<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredients.php";
require_once __DIR__ . "/../../lib/session.php";

adminOnly();

if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];

	deleteIngredient($pdo, $id);
}
