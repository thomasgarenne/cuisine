<?php
$images = getImages($pdo, $r["id"]);
$categories = getCategories($pdo, $r["categoriesId"]);
$users = getAuthor($pdo, $r["authorId"]);
?>

<section class="flex recette">
    <div class="col-bet">
        <h2><?= htmlentities($r['name']) ?></h2>
        <div>
            <p class="hidden">Catégorie : <?= html_entity_decode($categories['nom']) ?></p>
            <p><?= html_entity_decode($r['description']) ?></p>
        </div>
        <img src=" /admin/uploads/<?= htmlentities($images[0]['filename']) ?>" alt="<?= htmlentities($images[0]['description']) ?>" id="images" onerror="loadDefaultImage()">
        <p class="hidden">Crée le <?= htmlentities($r['createdAt']) ?></p>
        <p class="hidden">Auteur : <?= htmlentities($users["username"]) ?></p>
        <a href="recette.php?id=<?= htmlentities($r['id']) ?>"><button>Plus d'info</button></a>
    </div>
</section>

<script>
    function loadDefaultImage(imageId) {
        var image = document.getElementById(imageId);
        if (image) {
            image.src = "assets/images/default-recettes.jpg";
        }
    }
</script>