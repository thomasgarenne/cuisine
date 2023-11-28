<?php
$title = "Modifier recette";
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/templates/nav.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/recettes.php";
require_once __DIR__ . "/../lib/ingredientRecette.php";
require_once __DIR__ . "/../lib/ingredients.php";
require_once __DIR__ . "/../lib/images.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/validation.php";

userOnly();

if ($_SESSION["user"]["role"] == '["ROLE_ADMIN"]' || $_SESSION["user"]["id"] == $_GET["authorId"]) {

    $found = true;
    $messages = [];
    $errors = [];

    //Récupère Id de la recette ainsi que sa catégories et ses images
    if (isset($_GET["id"])) {
        $id = (int)$_GET["id"];
        $r = getRecette($pdo, $id);
        $cId = $r["categoriesId"];

        $categories = getCategories($pdo);
        $images = getImages($pdo, $id);

        //Récupère les ingrédients de la recette pour les modifier
        $listIngredientAjax = getIngredientRecetteAjax($pdo, $id);
        $listIngredients = json_decode($listIngredientAjax);
    } else {
        $found = false;
    }


    //Récupère la liste des ingrédients pour les ajouter
    $ingredients = indexIngredients($pdo);

    //Sauvegarde Recette
    if (isset($_POST['saveRecettes'])) {
        $name = htmlentities($_POST['name']);
        $nameValidationResult = validateText('nom', $name, 3, 30);
        if ($nameValidationResult !== null) {
            $errors[] = $nameValidationResult;
        }

        $description = htmlentities($_POST['description']);
        $descriptionoValidationResult = validateText('description', $description, 5, 200);
        if ($descriptionoValidationResult !== null) {
            $errors[] = $descriptionoValidationResult;
        }
        $instructions = htmlentities($_POST['instructions']);
        $instructionValidationResult = validateText('instructions', $instructions, 5, 300);
        if ($instructionValidationResult !== null) {
            $errors[] = $instructionValidationResult;
        }
        $tp = (int)$_POST['tp'];
        $tpValidationResult = validateQuantity($tp);
        if ($tpValidationResult !== null) {
            $errors[] = $tpValidationResult;
        }

        $tc = (int)$_POST['tc'];
        $tcValidationResult = validateQuantity($tc);
        if ($tcValidationResult !== null) {
            $errors[] = $tcValidationResult;
        }

        $categoriesId = (int)$_POST['categories'];

        if (empty($errors)) {
            editRecette($pdo, $r['id'], $name, $description, $instructions, $tp, $tc, $categoriesId);
            header('Location: /admin/editRecette.php?id=' . $id);
        } else {
            $errors;
        }
    }

    // Sauvegarde Image
    if (isset($_POST['saveImage'])) {
        if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
            if ($filename = saveFiles('uploads', 'upload')) {
                addImage($pdo, $filename, 'image', $r['id']);
                header('Location:' . 'editRecette.php?id=' . $id);
            } else {
                $errors[] = "Une erreur s'est produite lors de l'enregistrement de l'image.";
            }
        } else {
            $errors[] = "Veuillez sélectionner une image valide avant de valider.";
        }
    }


    $unity = ["ml", "cl", "L", "g", "cuillère à soupe", "cuillère à café", "unité"];
?>
    <div class="content">
        <?php if ($found === false) { ?>
            <h2>Aucune recette trouvée.</h2>
        <?php } else { ?>
            <h2>Modifier la recette : </h2>
            <?php require_once __DIR__ . "/../admin/templates/flash.php"; ?>

            <!-- Formulaire de modification des informations -->
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>
                        <h3>Modifier les informations de la recette</h3>
                    </legend>

                    <label for="name">Nom de la recette</label>
                    <input type="text" name="name" id="name" value="<?= $r["name"] ?>">

                    <label for="description">Description de la recette</label>
                    <input type="text" name="description" id="description" value="<?= $r["description"] ?>">

                    <label for="instructions">Instructions de la recette</label>
                    <input type="text" name="instructions" id="instructions" value="<?= $r["instructions"] ?>">

                    <label for="tp">Temps de préparation</label>
                    <input type="number" name="tp" id="tp" value="<?= $r["timePreparation"] ?>">

                    <label for="tc">Temps de cuisson</label>
                    <input type="number" name="tc" id="tc" value="<?= $r["timeCook"] ?>">

                    <label for="categories">Catégories</label>
                    <select name="categories" id="categories">
                        <?php foreach ($categories as $c) { ?>
                            <option value="<?= $c['id'] ?>" <?php if ($c['id'] === $cId) {
                                                                echo "selected";
                                                            }; ?>> <?= $c['nom'] ?></option>
                        <?php } ?>
                    </select>

                    <button type="submit" class="btn-edit" name="saveRecettes">Modifier</button>
                </fieldset>
            </form>

            <!-- Affichage des ingrédients de la recette pour suppression -->
            <form action="">
                <fieldset>
                    <legend>
                        <h3>Supprimer un ingrédient de la recette</h3>
                    </legend>
                    <div id="listContainer">
                        <?php foreach ($listIngredients as $ing) {
                            $ingredient = showIngredients($pdo, $ing->ingredientId);
                        ?>
                            <div>
                                <input type="hidden" name="id" value="<?= $id ?>">

                                <label for="ingredient">Ingrédient</label>
                                <input type="text" value="<?= $ingredient["name"] ?>" disabled>

                                <label for="quantity">Quantité</label>
                                <input type="text" value="<?= $ing->quantite ?>" disabled>

                                <label for="unity">Unité de mesure</label>
                                <input type="text" value="<?= $ing->uniteDeMesure ?>" disabled>

                                <button class="btns" data-recetteId="<?= $ing->recetteId ?>" data-ingredientId="<?= $ing->ingredientId ?>">X</button>
                            </div>
                        <?php } ?>
                    </div>
                </fieldset>
            </form>

            <!--Formulaire pour ajouter des ingrédients à la recette -->
            <form action="" id="saveRecette">
                <fieldset>
                    <legend>
                        <h3>Ingrédients à valider</h3>
                    </legend>

                    <input type="hidden" name="id" value="<?= $id ?>">

                    <label for="ingredient">Ingrédient</label>
                    <select name="ingredient" id="ingredient">
                        <?php foreach ($ingredients as $i) { ?>
                            <option value="<?= $i["id"] ?>"><?= $i["name"] ?></option>
                        <?php } ?>
                    </select>

                    <label for="qte">Quantité</label>
                    <span id="qteMsg"></span>
                    <input type="number" name="qte" placeholder="10" required>

                    <label for="u">Unité de mesure</label>
                    <select name="u">
                        <?php foreach ($unity as $u) { ?>
                            <option value="<?= $u ?>"><?= $u ?></option>
                        <?php } ?>
                    </select>

                    <button type="submit" class="btn-add">Ajouter</button>

                </fieldset>
            </form>

            <!-- Formulaire d'ajout des images -->
            <form method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>
                        <h3>Ajouter une image</h3>
                    </legend>
                    <label for="upload">Images</label>
                    <input type="file" name="upload" id="upload" required>
                    <button type="submit" class="btn-add" name="saveImage">Ajouter</button>
                </fieldset>
            </form>

            <!-- Suppression des images -->
            <div class="col-bet">
                <?php foreach ($images as $i) { ?>
                    <div>
                        <img src="/admin/uploads/<?= $i['filename'] ?>" alt="">
                        <button class="btn btn-delete" data-id='<?= $i['id'] ?>'>Supprimer</button>
                    </div>
                <?php } ?>
            </div>

            <a href="<?= PREVIUS ?>"><button>Retour</button></a>
            <!-- Script Javascript -->
            <script src="/public/js/ajax.js"></script>
            <script src="/public/js/ingredientRecette_delete_ajax.js"></script>
            <script src="/public/js/ingredientRecette_add_ajax.js"></script>
        <?php } ?>
    </div>


    <script src="/public/js/ingredientAPI.js"></script>
<?php
} else {
    header('Location: /user/recettes.php');
}
require_once __DIR__ . "/templates/footer.php";
?>