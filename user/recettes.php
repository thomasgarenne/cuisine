<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/menu.php";
require_once __DIR__ . "/../lib/users.php";
require_once __DIR__ . "/../lib/recettes.php";
require_once __DIR__ . "/../lib/session.php";

userOnly();

$title = "Mes recettes";
require_once __DIR__ . "/../admin/templates/header.php";

$user = $_SESSION['user'];
$users = showUser($pdo, $user["id"]);

$recetteByUser = recetteByUser($pdo, $user["id"]);
?>

<?php require_once __DIR__ . "/../templates/account_sidebar.php"; ?>

<div class="content">
	<h2>Mes recettes</h2>
	<a href="/admin/newRecette.php"><button class="btn-add">Ajouter</button></a>
	<ul>
		<?php foreach ($recetteByUser as $recette) { ?>
			<div class="block">
				<li><?= $recette["name"] ?></li>
				<li><?= $recette["description"] ?></li>
				<div class="flex">
					<li><a href="../recette.php?id=<?= htmlentities($recette['id']) ?>"><button>Voir</button></a></li>
					<li><a href="../admin/editRecette.php?id=<?= htmlentities($recette['id']) ?>&authorId=<?= htmlentities($recette['authorId']) ?>"><button>Modifier</button></a></li>
				</div>
			</div>
		<?php } ?>
	</ul>
</div>

<?php
require_once __DIR__ . "/../templates/footer.php";
?>