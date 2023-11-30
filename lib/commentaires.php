<?php

/** CREATE */
function addCommentaire(PDO $pdo, string $commentaire, int $notes, int $userId, int $recetteId, string $username)
{
    $sql = "SELECT * FROM commentaire WHERE userId = :userId AND recetteId = :recetteId";
    $query = $pdo->prepare($sql);
    $query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        $datetime = new DateTime();
        $createdAt = $datetime->format('Y-m-d h:i:s');

        $sql = "INSERT INTO commentaire (commentaire, notes, createdAt, userId, recetteId) VALUES (:commentaire, :notes, :createdAt, :userId, :recetteId)";

        $query = $pdo->prepare($sql);

        $query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $query->bindParam(':notes', $notes, PDO::PARAM_INT);
        $query->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);

        if ($query->execute()) {
            $result = [
                "success" => true,
                "message" => "Commentaire ajouté avec succès",
                "c" => $commentaire,
                "n" => $notes,
                "u" => $username,
                "d" => $createdAt
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Erreur lors de l'ajout en BDD"
            ];
        }

        echo json_encode($result);
    } else {
        $result = [
            "success" => false,
            "message" => "Vous avez déjà laissé un commentaire pour cette recette"
        ];

        echo json_encode($result);
    }
}

/** READ */
function getCommentaires(PDO $pdo, int $userId = null, int $recetteId = null): array
{
    $sql = "SELECT commentaire.*, Users.username FROM commentaire INNER JOIN Users ON Commentaire.userId = Users.id ORDER BY createdAt DESC";

    if (!is_null($userId) && !is_null($recetteId)) {
        $sql = "SELECT * FROM commentaire WHERE userId = :userId AND recetteId = :recetteId";
    }

    $query = $pdo->prepare($sql);

    if (!is_null($userId) && !is_null($recetteId)) {
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);
    }

    $query->execute();

    if (!is_null($userId) && !is_null($recetteId)) {
        $commentaire = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        $commentaire = $query->fetchAll();
    }

    return $commentaire;
}

/** READ */
function getCommentairesByRecette(PDO $pdo, $recetteId): array
{

    $sql = "SELECT commentaire.*, Users.username FROM commentaire INNER JOIN Users ON Commentaire.userId = Users.id WHERE recetteId = :recetteId ORDER BY createdAt DESC LIMIT 5";

    $query = $pdo->prepare($sql);

    $query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);

    $query->execute();

    $commentaire = $query->fetchAll(PDO::FETCH_ASSOC);

    return $commentaire;
}

/** GET COM BY USER */
function getComByUser(PDO $pdo, int $userId): array
{
    $sql = "SELECT * FROM commentaire WHERE userId = :userId";

    $query = $pdo->prepare($sql);
    $query->bindParam("userId", $userId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll();
}

function getComByUserPage(PDO $pdo, int $userId, int $start, int $limit): array
{
    $sql = "SELECT * FROM commentaire WHERE userId = :userId ORDER BY createdAt ASC LIMIT :start, :limit";

    $query = $pdo->prepare($sql);
    $query->bindParam(":userId", $userId, PDO::PARAM_INT);
    $query->bindParam(":start", $start, PDO::PARAM_INT);
    $query->bindParam(":limit", $limit, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll();
}

/** Pagination */
function countCommentaireByUser(PDO $pdo, int $userId)
{
    $sql = "SELECT COUNT(*) as total FROM commentaire WHERE userId = :userId";

    $query = $pdo->prepare($sql);
    $query->bindParam(":userId", $userId, PDO::PARAM_INT);
    $query->execute();
    $recettes = $query->fetch(PDO::FETCH_ASSOC);

    return (int) $recettes['total'];
}

/** UPDATE */
function editCommentaires(PDO $pdo, string $commentaire, int $notes, int $userId, int $recetteId)
{
    $sql = "UPDATE commentaire SET commentaire = :commentaire, notes = :notes WHERE userId = :userId AND recetteId = :recetteId";

    $query = $pdo->prepare($sql);
    $query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $query->bindParam(':notes', $notes, PDO::PARAM_INT);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->bindParam(':recetteId', $recetteId, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = array(
            "success" => true,
            "message" => "Commentaire modifié",
            "commentaire" => $commentaire,
            "notes" => $notes,
        );
    } else {
        $result = array(
            "success" => false,
            "message" => "Une erreur est survenue",
        );
    }

    echo json_encode($result);
}

/** DELETE */
function deleteCommentaire(PDO $pdo, int $userId, int $recetteId)
{
    $sql = "DELETE FROM commentaire WHERE userId = :userId AND recetteId = :recetteId";
    $query = $pdo->prepare($sql);
    $query->bindValue(':userId', $userId, PDO::PARAM_INT);
    $query->bindValue(':recetteId', $recetteId, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = array(
            "success" => true,
            "message" => "Le commentaire a bien été supprimé"
        );
    } else {
        $result = array(
            "success" => false,
            "message" => "Une erreur est survenue"
        );
    }

    echo json_encode($result);
}
