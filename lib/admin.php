<?php

/** COUNT */
function countTable(PDO $pdo, string $table): int
{
    $sql = "SELECT COUNT(*) FROM " . $table;

    $query = $pdo->prepare($sql);
    $query->execute();

    return $query->fetchColumn();
}

/** LAST ADD */
function lastAdd(PDO $pdo, string $table, int $nb): array
{
    $sql = "SELECT * FROM " . $table . ' LIMIT ' . $nb;

    $query = $pdo->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}
