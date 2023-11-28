<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredients.php";

if (isset($_GET['name']) && $_GET['name'] !== "") {
	$name = htmlentities($_GET['name']);

	addIngredient($pdo, $name);
}
