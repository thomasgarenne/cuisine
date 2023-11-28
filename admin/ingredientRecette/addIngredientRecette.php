<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredientRecette.php";
require_once __DIR__ . "/../../lib/validation.php";

adminOnly();

$errors = [];

if (isset($_GET['id'], $_GET['ingredient'], $_GET['qte'], $_GET['u'])) {
	$recetteId = (int)$_GET['id'];
	$ingredientId = (int)$_GET['ingredient'];

	$qte = (int)$_GET['qte'];
	$qteValidationResult = validateQuantity($qte);
	if ($qteValidationResult !== null) {
		$errors[] = $qteValidationResult;
	}

	$unity = (string)htmlentities($_GET['u']);


	if (empty($errors)) {
		addIngredientRecetteAjax($pdo, $recetteId, $ingredientId, $qte, $unity);
	} else {
		$result = [
			'success' => false,
			'message' => 'La quantité ne peux pas être égal à 0',
		];

		echo json_encode($result);
	}
}
