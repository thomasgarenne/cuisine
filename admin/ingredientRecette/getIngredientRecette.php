<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredientRecette.php";

if (isset($_GET["recetteId"])) {
	$recetteId = (int)htmlentities($_GET["recetteId"]);
	getIngredientRecetteAjax($pdo, $recetteId);
}
