<?php
$title = "Ingrédients";
require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../templates/nav.php";
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredients.php";

adminOnly();

$search = null;

if (isset($_GET["searchIngredients"])) {
	$search = htmlentities($_GET["searchIngredients"]);
}

$ingredients = indexIngredients($pdo, $search);
?>
<div class="content">
	<h2>Liste des ingrédients</h2>

	<a href="/admin/ingredients/addIngredient.php"><button class="btn-add">Ajouter</button></a>

	<form action="" method="get">
		<label for="searchIngredients">Recherchez un ingrédients</label>
		<input type="search" name="searchIngredients" id="searchIngredients" placeholder="Recherchez ...">
	</form>

	<table>
		<thead>
			<th>#</th>
			<th>Nom</th>
			<th>Actions</th>
		</thead>
		<tbody id="tbody">
			<?php foreach ($ingredients as $i) { ?>
				<tr id="id<?= $i['id'] ?>">
					<td><?= $i["id"] ?></td>
					<td class="ingredients"><?= $i["name"] ?></td>
					<td><button class="btn-delete" data-id="<?= $i['id'] ?>">Supprimer</button></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<a href="<?= PREVIUS ?>"><button>Retour</button></a>
</div>

<script src="/public/js/ingredient_add_ajax.js"></script>
<script src="/public/js/ingredient_delete_ajax.js"></script>