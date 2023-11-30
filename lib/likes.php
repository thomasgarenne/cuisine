<?php

/** COUNT LIKE */
function countLike(PDO $pdo, int $recetteId)
{
	$sql = "SELECT COUNT(*) AS likeCount FROM likes WHERE recetteId= :recetteId";

	$query = $pdo->prepare($sql);
	$query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);
	$query->execute();
	return $query->fetch();
}

/** ADD/REMOVE LIKE */
function addLike(PDO $pdo, int $recetteId, int $userId)
{
	// Vérifier si l'utilisateur a déjà aimé la recette
	$sqlExist = $pdo->prepare("SELECT EXISTS (SELECT userId FROM likes WHERE userId = :userId AND recetteId = :recetteId)");
	$sqlExist->bindParam(':userId', $userId, PDO::PARAM_INT);
	$sqlExist->bindParam(':recetteId', $recetteId, PDO::PARAM_INT); // Assurez-vous de définir $recetteId
	$sqlExist->execute();
	$userExist = $sqlExist->fetchColumn();

	if ($userExist) {
		// L'utilisateur a déjà aimé la recette, nous pouvons supprimer le like
		$sql = "DELETE FROM likes WHERE recetteId = :recetteId AND userId = :userId";
	} else {
		// L'utilisateur n'a pas encore aimé la recette, nous pouvons ajouter le like
		$sql = "INSERT INTO likes (recetteId, userId) VALUES (:recetteId, :userId)";
	}

	// Préparation de la requête et exécution
	$query = $pdo->prepare($sql);
	$query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);
	$query->bindParam(':userId', $userId, PDO::PARAM_INT);

	if ($query->execute()) {
		$sqlCount = "SELECT COUNT(*) AS likeCount FROM likes WHERE recetteId= :recetteId";

		$queryCount = $pdo->prepare($sqlCount);
		$queryCount->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);
		$queryCount->execute();
		$likeData = $queryCount->fetch();

		$result = array(
			"success" => true,
			"message" => "Like ajouté/supprimé",
			"likeData" => $likeData['likeCount']
		);
	} else {
		$result = array(
			"success" => false,
			"message" => "Une erreur est survenue",
		);
	}

	echo json_encode($result);
}

/** SHOW LIKE */
function favories(PDO $pdo, int $userId): array
{
	$sql = "SELECT * FROM likes INNER JOIN recette ON likes.recetteId = recette.id WHERE userId = :userId";

	$query = $pdo->prepare($sql);
	$query->bindParam(':userId', $userId, PDO::PARAM_INT);
	$query->execute();

	return $query->fetchAll();
}

function favoriesPaginated(PDO $pdo, int $userId, $start, $limit): array
{
	$sql = "SELECT * FROM likes INNER JOIN recette ON likes.recetteId = recette.id WHERE userId = :userId LIMIT :start, :limit";

	$query = $pdo->prepare($sql);
	$query->bindParam(':userId', $userId, PDO::PARAM_INT);
	$query->bindParam(':start', $start, PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, PDO::PARAM_INT);
	$query->execute();

	return $query->fetchAll();
}
