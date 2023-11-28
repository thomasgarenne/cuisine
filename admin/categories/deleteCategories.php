<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/categories.php";
require_once __DIR__ . "/../../admin/templates/header.php";

if (isset($_GET['id'])) {
    $message = '';
    $id = (int)$_GET['id'];

    try {
        deleteCategories($pdo, $id);
        header("Location: /admin/categories/categories.php");

        $message = "Catégorie supprimé";
    } catch (PDOException $e) {
        // Gérer l'erreur et afficher un message approprié
        if ($e->getCode() == '23000' && $e->errorInfo[1] == 1451) {
            $message = "Erreur : Impossible de supprimer la catégorie car elle est utilisée par des recettes.";
        } else {
            // Autre gestion d'erreur si nécessaire
            $message = "Une erreur s'est produite : " . $e->getMessage();
        }
    }
}
?>

<div class="content">
    <div class="danger"><?= $message ?></div>
    <a href="<?= PREVIUS ?>"><button>Retour</button></a>
</div>