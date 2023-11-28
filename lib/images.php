<?php

function addImage(PDO $pdo, string $filename, string $description, int $recetteId): bool
{
    $sql = "INSERT INTO image (filename, description, recetteId) VALUES (?, ?, ?)";

    $query = $pdo->prepare($sql);

    return $query->execute([$filename, $description, $recetteId]);
}

function deleteImage(PDO $pdo, int $id)
{
    $sql = "DELETE FROM image WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindValue('id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = array(
            "success" => true,
            "message" => "Image supprimée avec succès"
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
