<?php
//CREATE
function addCategories(PDO $pdo, string $name, string $description, int $parentId = null): bool
{
    $sql = "INSERT INTO categories (nom, description, parentId) VALUES (?, ?, ?)";

    $query = $pdo->prepare($sql);

    return $query->execute([$name, $description, $parentId]);
}

//READ
function indexCategories(PDO $pdo, int $id = null): array|bool
{
    $sql = "SELECT * FROM categories";

    if ($id !== null) {
        $sql .= " WHERE id = :id";
    }

    $query = $pdo->prepare($sql);

    if ($id !== null) {
        $query->bindValue('id', $id, PDO::PARAM_INT);
    }

    $query->execute();

    if ($id !== null) {
        return $query->fetch(PDO::FETCH_ASSOC);
    } else {
        return $query->fetchAll();
    }
}

//UPDATE
function editCategories(PDO $pdo, string $name, string $description, int $parentId = null, int $id)
{
    $sql = "UPDATE categories SET nom = :nom, description = :description, parentId = :parentId WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindValue('id', $id);
    $query->bindValue('nom', $name);
    $query->bindValue('description', $description);
    $query->bindValue('parentId', $parentId);

    return $query->execute();
}

//DELETE
function deleteCategories(PDO $pdo, int $id)
{
    $sql = "DELETE FROM categories WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = array(
            "success" => true,
            "message" => "Catégorie supprimée avec succès"
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
