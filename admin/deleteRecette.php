<?php
require_once __DIR__ . '/../lib/config.php';
require_once __DIR__ . '/../lib/pdo.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../lib/recettes.php';

adminOnly();

$errors = [];
$messages = [];
$recette = false;

if (isset($_GET["id"])) {
    $recette =  getRecette($pdo, (int)$_GET["id"]);
}
if ($recette) {
    if (deleteRecette($pdo, (int)$_GET["id"])) {
        $messages[] = "La recette a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'article n'existe pas";
}
?>

<div>
    <?php foreach ($messages as $m) { ?>
        <div class="alert alert-success" role="alert">
            <?= $m ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $e) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $e ?>
        </div>
    <?php } ?>
</div>

<?php
require_once __DIR__ . '/templates/footer.php';
?>