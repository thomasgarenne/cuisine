<?php
$title = "Ajouter catégorie";
require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../templates/nav.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/categories.php";
require_once __DIR__ . "/../../lib/validation.php";

$categories = indexCategories($pdo);

$errors = [];
$messages = [];

if (isset($_POST['saveCategorie'])) {
    // Validation champ 'name'
    $name = htmlentities($_POST['name']);
    $nameValidationResult = validateText("nom", $name, 3, 30);
    if ($nameValidationResult !== null) {
        $errors[] = $nameValidationResult;
    }

    // Validation champ 'description'
    $description = htmlentities($_POST['description']);
    $descriptionValidationResult = validateText("description", $description, 3, 30);
    if ($descriptionValidationResult !== null) {
        $errors[] = $descriptionValidationResult;
    }

    if (isset($_POST['categories'])) {
        $parentId = (int)$_POST['categories'];
    } else {
        $parentId = null;
    }

    if (empty($errors)) {
        addCategories($pdo, $name, $description, $parentId, $id);
        header('Location: categories.php');
    }
}
?>
<div class="content">
    <?php require_once __DIR__ . "/../templates/flash.php"; ?>
    <?php require_once __DIR__ . "/../templates/categories/categories_part_form.php"; ?>
</div>
<script src="/public/js/ajax_new_categories.js"></script>

<?php
require_once __DIR__ . "/../templates/footer.php";
?>