<?php if ($_SESSION["user"]["role"] == '["ROLE_ADMIN"]') { ?>
	<div class="sidebar">
		<nav class="side">
			<ul>
				<li><a href="/admin/recettes.php">🍳 <span>Recette</span></a></li>
				<li><a href="/admin/categories/categories.php">📁 <span>Catégories</span></a></li>
				<li><a href="/admin/commentaires/commentaires.php">✍ <span>Commentaires</span></a></li>
				<li><a href="/admin/ingredients/ingredients.php">🍙 <span>Ingrédients</span></a></li>
			</ul>
		</nav>
	</div>
<?php } else {
	require_once __DIR__ . "/../../templates/account_sidebar.php";
} ?>