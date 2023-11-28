<?php
$title = "Nouvelle recette";
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/templates/nav.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/recettes.php";
require_once __DIR__ . "/../lib/ingredients.php";
require_once __DIR__ . "/../lib/ingredientRecette.php";
require_once __DIR__ . "/../lib/images.php";
require_once __DIR__ . "/../lib/tools.php";

userOnly();

$messages = [];
$errors = [];
$regex = '^[A-Z][A-Za-z\é\è\ê\-]+$^';
$recetteId;

//Sauvegarde classe Recette
if (isset($_POST['saveRecettes'])) {
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    }
    if (isset($_POST['instructions'])) {
        $instructions = $_POST['instructions'];
    }
    if (isset($_POST['tp'])) {
        $tp = (int)$_POST['tp'];
    }
    if (isset($_POST['tc'])) {
        $tc = (int)$_POST['tc'];
    }
    if (isset($_POST['categories'])) {
        $categories = (int)$_POST['categories'];
    }

    $authorId = $_SESSION['user']['id'];

    if (addRecette($pdo, $name, $description, $instructions, $tp, $tc, $categories, $authorId)) {
        $messages[] = "La recette a bien été ajouté";
        header('Location: recettes.php');
    }

    $recetteId = $pdo->lastInsertId();
}

//Sauvegarde classe Image
if (isset($_POST['saveRecettes'])) {
    if (isset($_FILES['upload'])) {
        if ($filename = saveFiles('uploads', 'upload')) {
            addImage($pdo, $filename, htmlentities($_POST['description']), $recetteId);
        }
    }
}

//Sauvegarde classe Recette/Ingrédient
if (isset($_POST["saveRecettes"])) {
    // Assurez-vous que les champs "ingredients", "quantity" et "unity" existent dans le tableau POST
    if (isset($_POST["ingredients"]) && isset($_POST["quantity"]) && isset($_POST["unity"])) {
        // Récupérez les tableaux POST correspondants
        $ingredients = $_POST["ingredients"];
        $quantities = $_POST["quantity"];
        $unities = $_POST["unity"];

        if (count($ingredients) === count($quantities) && count($ingredients) === count($unities)) {
            // Parcourez les tableaux et ajoutez chaque ingrédient à la recette
            for ($i = 0; $i < count($ingredients); $i++) {
                $ingredientId = (int)$ingredients[$i];
                $quantity = (int)$quantities[$i];
                $unity = (string)$unities[$i];

                if (addIngredientRecette($pdo,  $recetteId, $ingredientId, $quantity, $unity)) {
                    return true;
                } else {
                    $errors[] = "Échec de l'ajout de l'ingrédient.";
                }
            }
        } else {
            $errors[] = "Les tableaux ne sont pas de la même longueur.";
        }
    } else {
        $errors[] = "Les champs de données d'ingrédients ne sont pas définis dans la requête POST.";
    }
}

//Récupère les catégories
$categories = getCategories($pdo);

//Récupère la liste des ingrédients
$ingredients = indexIngredients($pdo);
?>
<div class="content">
    <h2>Ajouter une nouvelle recette</h2>

    <?php
    include_once __DIR__ . '/../templates/form_recette.php';
    ?>
</div>
<?php
require_once __DIR__ . "/templates/footer.php";
?>