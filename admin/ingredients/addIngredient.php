<?php
$title = "Ajouter ingrédient";
require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../templates/nav.php";
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredients.php";

adminOnly();

$ingredients = indexIngredients($pdo);
?>
<div class="content">
	<form action="" method="post" name="ingredient">
		<label for="ingredients">Ingrédients</label>
		<input type="text" name="name" id="name">

		<input type="submit" value="Ajouter">
	</form>

	<div class="ingredients"></div>

	<a href="<?= PREVIUS ?>"><button>Retour</button></a>
</div>
<script src="/public/js/ingredient_add_ajax.js"></script>