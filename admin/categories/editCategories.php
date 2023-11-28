<?php
$title = "Modifier catégorie";
require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../templates/nav.php";
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/categories.php";
require_once __DIR__ . "/../../lib/validation.php";

$found = true;
$messages = [];
$errors = [];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $cat = indexCategories($pdo, $id);
    $categories = indexCategories($pdo);

    if ($cat == null) {
        $found = false;
    }
}

if (isset($_POST['saveCategories'])) {
    // Validation champ 'name'
    $name = htmlentities($_POST['name']);
    $nameValidationResult = validateText("nom", $name, 3, 30);
    if ($nameValidationResult !== null) {
        $errors[] = $nameValidationResult;
    }

    // Validation champ 'description'
    $description = htmlentities($_POST['description']);
    $descriptionValidationResult = validateText("description", $description, 3, 100);
    if ($descriptionValidationResult !== null) {
        $errors[] = $descriptionValidationResult;
    }

    if (isset($_POST['categories'])) {
        $parentId = (int)$_POST['categories'];
        if ($parentId === 0) {
            $parentId = null;
        }
    }

    if (empty($errors)) {
        editCategories($pdo, $name, $description, $parentId, $id);
        header('Location: categories.php');
    } else {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>
<div class="content">
    <?php require_once __DIR__ . "/../templates/flash.php"; ?>

    <?php if ($found) {
        require_once __DIR__ . "/../templates/categories/categories_part_edit_form.php";
    } else { ?>
        <h2>Catégories introuvable</h2>
    <?php } ?>
    <a href="<?= PREVIUS ?>"><button>Retour</button></a>
</div>
<?php
require_once __DIR__ . "/../templates/footer.php";
?>