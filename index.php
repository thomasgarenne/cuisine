<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/lib/recettes.php";
require_once __DIR__ . "/templates/header.php";
$title = "Recette de cuisine";
require_once __DIR__ . "/templates/baniere.php";

//PAGINATION
$url = "./";
$nbItems = getTotalRecette($pdo);
require_once __DIR__ . "/lib/pagination.php";
$recettes = getRecettes($pdo, $premier, $parPage);
?>

<section class="container">
    <div class="column">
        <?php foreach ($recettes as $r) {
            require __DIR__ . "/templates/recette_part.php";
        } ?>
    </div>
    <?= require_once __DIR__ . "/templates/pagination.php"; ?>
</section>

<?php require_once __DIR__ . "/templates/footer.php"; ?>