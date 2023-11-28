<?php
$title = "Catégories";
require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../templates/nav.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/categories.php";

adminOnly();

$categories = indexCategories($pdo);
?>
<div class="content">
	<?php require_once __DIR__ . "/../templates/categories/categories_part.php"; ?>
</div>
<?php
require_once __DIR__ . "/../templates/footer.php";
?>