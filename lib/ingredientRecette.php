<?php

function addIngredientRecette(PDO $pdo, int $recetteId, int $ingredientId, int $quantity, string $unity): bool
{
	$sql = "INSERT INTO recetteingredient (recetteId, ingredientId, quantite, uniteDeMesure) VALUES (:recetteId, :ingredientId, :quantite, :uniteDeMesure)";

	$query = $pdo->prepare($sql);

	$query->bindValue(':recetteId', $recetteId, PDO::PARAM_INT);
	$query->bindValue(':ingredientId', $ingredientId, PDO::PARAM_INT);
	$query->bindValue(':quantite', $quantity, PDO::PARAM_INT);
	$query->bindValue(':uniteDeMesure', $unity, PDO::PARAM_STR);

	if ($query->execute()) {
		return true;
	} else {
		return false;
	}
}

function addIngredientRecetteAjax(PDO $pdo, int $recetteId, int $ingredientId, int $quantity, string $unity)
{
	$sql = "INSERT INTO recetteingredient (recetteId, ingredientId, quantite, uniteDeMesure) VALUES (:recetteId, :ingredientId, :quantite, :uniteDeMesure)";

	$query = $pdo->prepare($sql);

	$query->bindValue(':recetteId', $recetteId, PDO::PARAM_INT);
	$query->bindValue(':ingredientId', $ingredientId, PDO::PARAM_INT);
	$query->bindValue(':quantite', $quantity, PDO::PARAM_INT);
	$query->bindValue(':uniteDeMesure', $unity, PDO::PARAM_STR);

	if ($query->execute()) {
		$result = array(
			"success" => true,
			"message" => "Ingrédient ajouté avec succés",
			"recetteId" => $recetteId,
			"ingredientId" => $ingredientId,
			"quantity" => $quantity,
			"unity" => $unity,
		);
	} else {
		$result = array(
			"success" => false,
			"message" => "Une erreur est survenue",
		);
	}

	echo json_encode($result);
}

function getIngredientRecetteAjax(PDO $pdo, int $recetteId)
{
	$sql = "SELECT * FROM recetteingredient WHERE recetteId = :recetteId";
	$query = $pdo->prepare($sql);
	$query->bindValue(':recetteId', $recetteId, PDO::PARAM_INT);
	if ($query->execute()) {
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($result);
	} else {
		return json_encode(["error" => "Une erreur est survenue lors de l'exécution de la requête"]);
	}
}


function showIngredientRecette(PDO $pdo, int $id): array
{
	$sql = "SELECT * FROM recetteingredient WHERE recetteId = :id";

	$query = $pdo->prepare($sql);
	$query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();

	return $query->fetchAll();
}

function deleteIngredientRecette(PDO $pdo, int $recetteId, int $ingredientId)
{
	$sql = "DELETE FROM recetteingredient WHERE recetteId = :recetteId AND ingredientId = :ingredientId";

	$query = $pdo->prepare($sql);
	$query->bindValue(':recetteId', $recetteId, PDO::PARAM_INT);
	$query->bindValue(':ingredientId', $ingredientId, PDO::PARAM_INT);

	if ($query->execute()) {
		$result = array(
			"success" => true,
			"message" => "Ingrédient supprimée avec succès"
		);
	} else {
		$result = array(
			"success" => false,
			"message" => "Une erreur est survenue"
		);
	}

	$result_json = json_encode($result);

	echo $result_json;
}
