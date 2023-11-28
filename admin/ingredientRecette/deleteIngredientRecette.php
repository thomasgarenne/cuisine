<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredientRecette.php";

if (isset($_GET['recetteId'], $_GET['ingredientId'])) {
	$recetteId = (int)$_GET['recetteId'];
	$ingredientId = (int)$_GET['ingredientId'];

	deleteIngredientRecette($pdo, $recetteId, $ingredientId);
}
