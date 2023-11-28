<?php
function indexIngredients(PDO $pdo, string $search = null): array
{
	$sql = "SELECT * FROM ingredient";

	if ($search !== null && $search !== "") {
		$sql .= " WHERE name LIKE '$search%'";
	}

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetchAll();
}
function showIngredients(PDO $pdo, int $id = null): array
{
	$sql = "SELECT * FROM ingredient WHERE id = :id";

	$query = $pdo->prepare($sql);
	$query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();

	return $query->fetch(PDO::FETCH_ASSOC);
}


function addIngredient(PDO $pdo, string $name)
{
	$sql = "INSERT INTO ingredient (name) VALUES (:name)";

	$query = $pdo->prepare($sql);
	$query->bindParam(':name', $name, PDO::PARAM_STR);

	if ($query->execute()) {
		$result = array(
			"success" => true,
			"message" => "ok",
			"id" => $pdo->lastInsertId(),
			"name" => $name
		);
	} else {
		$result = array(
			"success" => false,
			"message" => "Une erreur s'est produite"
		);
	}

	echo json_encode($result);
}

/** DELETE */
function deleteIngredient(PDO $pdo, int $id)
{
	$sql = "DELETE FROM ingredient WHERE id = :id";
	$query = $pdo->prepare($sql);
	$query->bindValue('id', $id, PDO::PARAM_INT);

	if ($query->execute()) {
		$result = array(
			"success" => true,
			"message" => "L'ingredient a bien été supprimé"
		);
	} else {
		$result = array(
			"success" => false,
			"message" => "Une erreur est survenue"
		);
	}

	echo json_encode($result);
}
