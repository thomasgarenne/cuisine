<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/menu.php";
require_once __DIR__ . "/../lib/users.php";
require_once __DIR__ . "/../lib/commentaires.php";
require_once __DIR__ . "/../lib/session.php";

userOnly();

$title = "Mes commentaires";
require_once __DIR__ . "/../admin/templates/header.php";

$user = $_SESSION['user'];
$users = showUser($pdo, $user["id"]);

$myComments = getComByUser($pdo, $user["id"]);
?>

<?php require_once __DIR__ . "/../templates/account_sidebar.php"; ?>

<div class="content">
	<h1>Mes commentaires</h1>
	<div class="block">
		<ul>
			<?php foreach ($myComments as $mc) { ?>
				<li><?= $mc["commentaire"] ?></li>
				<li><?= $mc["notes"] ?> / 5</li>
				<li>
					<div>
						<button class="btn-edit">
							<a href="/admin/commentaires/editCommentaire.php?userId=<?= $mc['userId'] ?>&recetteId=<?= $mc['recetteId'] ?>">Modifier</a>
						</button>
						<button class="btn-delete">
							<a href="/admin/commentaires/deleteCommentaire.php?userId=<?= $mc['userId'] ?>&recetteId=<?= $mc['recetteId'] ?>">Supprimer</a>
						</button>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>