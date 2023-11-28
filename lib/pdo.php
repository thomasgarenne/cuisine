<?php

try {
    $pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('PDO ERREUR : ' . $e->getFile() . ' L ' . $e->getLine() . ' : ' . $e->getMessage());
}
