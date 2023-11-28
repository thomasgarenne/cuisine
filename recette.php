<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/recettes.php";
require_once __DIR__ . "/lib/commentaires.php";
require_once __DIR__ . "/lib/ingredientRecette.php";
require_once __DIR__ . "/lib/ingredients.php";
require_once __DIR__ . "/lib/likes.php";
require_once __DIR__ . "/lib/menu.php";

$error = false;
$form = false;

// Récupération id recette, info recette, like
if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
    $r = getRecette($pdo, $id);
    $like = countLike($pdo, $id);
} else {
    header("Location: error.php");
    $error = true;
}
//Récupération des catégories, utilisateur, images, ingrédients
if ($r) {
    $categories = getCategories($pdo, $r["categoriesId"]);
    $users = getAuthor($pdo, $r["authorId"]);
    $images = getImages($pdo, $r["id"]);
    $ingredientRecette = showIngredientRecette($pdo, $id);

    $mainMenu["recette.php"] = ["title" => htmlentities($r["name"]), "meta_desc" => htmlentities(substr($r["description"], 0, 200)), "exclude" => true];
} else {
    $error = true;
    $mainMenu["recette.php"] = ["title" => "page introuvable", "meta_desc" => "page introuvable", "exclude" => true];
}

require_once __DIR__ . "/templates/header.php";

//Récupération des commentaires
if ($id) {
    $commentaires = getCommentairesByRecette($pdo, $id);

    // Récupération des notes et du nombre d'avis
    $nbComment = count($commentaires);

    $total = 0;
    foreach ($commentaires as $c => $value) {
        if ($value["notes"]) {
            $total += $value["notes"];
            $average = round($total / $nbComment, 2);
        }
    }
} else {
    $errors[] = "Paramètre de requête incorrect";
}

//Vérification si utilisateur connecté pour laisser un commentaire
$userId = -1;
//session_start();
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $form = true;
} else {
    $form = false;
}
?>

<?php if (!$error) { ?>
    <section class="container">
        <div id="flash-message" class="flash-message"></div>
        <section class="presentationRecette">
            <h2><?= htmlentities($r["name"]) ?></h2>
            <h4>Catégorie : <?= html_entity_decode($categories['nom']) ?></h4>
            <!-- Image -->
            <section class="wrapper">
                <div>
                    <?php foreach ($images as $i) { ?>
                        <img src="/admin/uploads/<?= $i["filename"] ?>" alt="<?= $i["description"] ?>" onerror="loadDefaultImage()" id="image" class="presentation">
                    <?php } ?>
                </div>
                <div class="presentation">

                    <h3>Description</h3>
                    <p><?= html_entity_decode($r["description"]) ?></p>
                    <h3>Instructions</h3>
                    <p><?= html_entity_decode($r['instructions']) ?></p>

                    <h3>Information</h3>
                    <p>Temps de préparation : <?= htmlentities($r['timePreparation']) ?> minutes</p>
                    <p>Temps de cuisson : <?= htmlentities($r['timeCook']) ?> minutes</p>
                    <p>Ajouté le : <?= htmlentities($r['createdAt']) ?> par <?= htmlentities($users["username"]) ?></p>

                    <h3>Liste des ingrédients</h3>
                    <ul>
                        <?php foreach ($ingredientRecette as $i) {
                            $name = showIngredients($pdo, (int)$i["ingredientId"]); ?>
                            <li><?= $name["name"] . " " . $i["quantite"] . " " . $i["uniteDeMesure"] ?></li>
                        <?php } ?>
                    </ul>

                    <!-- Ajout de like -->
                    <button id="like" data-recetteid="<?= $r["id"] ?>" data-userid="<?= $userId ?>"><?= $like['likeCount'] ?> 👍</button>
                </div>
            </section>

            <!-- Espace d'ajout des commentaires -->
            <div class="center">
                <h3>Commentaires</h3>
                <?php if ($commentaires) { ?>
                    <p><?= $average ?> / 5 sur <?= $nbComment ?> avis</p>
                <?php } ?>
                <div class="commentaire">
                    <?php if ($commentaires) { ?>
                        <?php foreach ($commentaires as $c) { ?>
                            <ul class="commentaire-details">
                                <li>Nom : <?= $c['username'] ?> / Notes : <?= $c['notes'] ?></li>
                                <li>Commentaire : <?= $c['commentaire'] ?></li>
                                <li>Date : <?= $c['createdAt'] ?></li>
                            </ul>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- Formulaire d'ajout d'un commentaire -->
        <?php if ($form) { ?>
            <form method="get" name="commentaire">
                <fieldset>
                    <legend>Laissez un commentaire</legend>
                    <label for="notes">Notes</label>
                    <select name="notes" id="notes">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected="selected">5</option>
                    </select>
                    <label for="commentaire">Commentaire</label>
                    <textarea name="commentaire" id="commentaire" cols="30" rows="10" placeholder="Votre commentaire" minlength="10" maxlength="200"></textarea>

                    <input type="hidden" name="userId" id="userId" data-author="<?= $userId ?>">
                    <input type="hidden" name="recetteId" id="recetteId" data-recette="<?= $id ?>">
                    <input type="hidden" name="username" id="username" data-username="<?= $username ?>">

                    <button type="submit" name="saveCommentaire">Ajoutez</button>
                </fieldset>
            </form>
        <?php } ?>
    <?php } else { ?>
        <div class="content">
            <h2>Recette Introuvable</h2>
        </div>
    <?php } ?>

    <a href="<?= PREVIUS ?>"><button>Retour</button></a>
    </section>

    <!-- Script Javascript -->
    <script src="/public/js/commentaire_add_ajax.js"></script>
    <script src="/public/js/flash_message.js"></script>
    <script src="/public/js/likes/likes.js"></script>

    <?php
    require_once __DIR__ . "/templates/footer.php";
    ?>