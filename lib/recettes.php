<?php

/** INDEX */
function getRecettes(PDO $pdo, int $premier = null, int $limit = null): array
{
    $sql = "SELECT * FROM recette ORDER BY createdAt DESC LIMIT :premier, :limit";

    $query = $pdo->prepare($sql);
    $query->bindValue(':premier', $premier, PDO::PARAM_INT);
    $query->bindValue(':limit', $limit, PDO::PARAM_INT);

    $query->execute();

    $recettes = $query->fetchAll();

    return $recettes;
}

//** SHOW */
function getRecette(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare("SELECT * FROM recette WHERE id = :id");
    $query->bindValue('id', $id, PDO::PARAM_INT);
    $query->execute();
    $recette = $query->fetch(PDO::FETCH_ASSOC);

    return $recette;
}

//** RECETTE BY USER */
function recetteByUser(PDO $pdo, int $userId): array
{
    $sql = "SELECT * FROM recette WHERE authorId = :userId";

    $query = $pdo->prepare($sql);
    $query->bindParam('userId', $userId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll();
}

//** CREATE */
function addRecette(
    PDO $pdo,
    string $name,
    string $description,
    string $instructions,
    int $tp,
    int $tc,
    int $categoriesId,
    int $authorId
): bool {

    $created = new DateTime();
    $createdAt = $created->format('Y/m/d');

    $updated = new DateTime();
    $updatedAt = $updated->format('Y/m/d');

    $sql = "INSERT INTO recette (name, description, instructions, timePreparation, timeCook, createdAt, updatedAt, categoriesId, authorId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $query = $pdo->prepare($sql);
    return $query->execute([$name, $description, $instructions, $tp, $tc, $createdAt, $updatedAt, $categoriesId, $authorId]);
}

/** EDIT */
function editRecette(
    PDO $pdo,
    int $id,
    string $name,
    string $description,
    string $instructions,
    int $tp,
    int $tc,
    int $categoriesId,
) {
    $updated = new DateTime();
    $updatedAt = $updated->format('Y/m/d');

    $sql = "UPDATE recette SET name = ?, description = ?, instructions = ?, timePreparation = ?, timeCook = ?, updatedAt = ?, categoriesId = ? WHERE id = ?";

    $query = $pdo->prepare($sql);

    if ($query->execute([$name, $description, $instructions, $tp, $tc, $updatedAt, $categoriesId, $id])) {
        return "La recette a bien été modifier";
    } else {
        return "Une erreur est survenue";
    }
}

/** DELETE */
function deleteRecette(PDO $pdo, int $id): bool
{
    $sql = "DELETE FROM recette WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindValue('id', $id, PDO::PARAM_INT);
    return $query->execute();
}

/** Images */
function getImages(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare("SELECT * FROM image WHERE recetteId = :id");
    $query->bindValue('id', $id, PDO::PARAM_INT);
    //$query->execute();
    //$images = $query->fetchAll();

    //return $images;

    if ($query->execute()) {
        return $query->fetchAll();
    }
}

/** Catégorie */
function getCategories(PDO $pdo, int $categoriesId = null): array|bool
{
    $sql = "SELECT * FROM categories";

    if (!is_null($categoriesId)) {
        $sql .= " WHERE id = :categoriesId";
    }

    $query = $pdo->prepare($sql);

    if (!is_null($categoriesId)) {
        $query->bindValue('categoriesId', $categoriesId, PDO::PARAM_STR);
    }

    $query->execute();

    if (!is_null($categoriesId)) {
        $categories = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        $categories = $query->fetchAll();
    }

    return $categories;
}

/** Auteur */
function getAuthor(PDO $pdo, int $authorId): array|bool
{
    $query = $pdo->prepare("SELECT * FROM users WHERE id = :authorId");
    $query->bindValue('authorId', $authorId, PDO::PARAM_STR);
    $query->execute();
    $categories = $query->fetch(PDO::FETCH_ASSOC);

    return $categories;
}

/** Pagination */
function getTotalRecette(PDO $pdo)
{
    $sql = "SELECT COUNT(*) as total FROM recette";

    $query = $pdo->prepare($sql);
    $query->execute();
    $recettes = $query->fetch(PDO::FETCH_ASSOC);

    return (int) $recettes['total'];
}
