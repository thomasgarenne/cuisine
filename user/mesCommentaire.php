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

$nbItem = countCommentaireByUser($pdo, $user["id"]);
echo $nbItem;

//Définir la base de l'url pour la pagination
$url = "./mesCommentaire.php";

require_once __DIR__ . "/../lib/pagination.php";

//$myComments = getComByUser($pdo, $user["id"]);
$myComments = getComByUserPage($pdo, $user["id"], $premier, $parPage);
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
						<a href="/admin/commentaires/editCommentaire.php?userId=<?= $mc['userId'] ?>&recetteId=<?= $mc['recetteId'] ?>">
							<button class="btn-edit">Modifier</button>
						</a>
						<a href="/admin/commentaires/deleteCommentaire.php?userId=<?= $mc['userId'] ?>&recetteId=<?= $mc['recetteId'] ?>">
							<button class="btn-delete">Supprimer</button>
						</a>

					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
	<?= require_once __DIR__ . "/../templates/pagination.php" ?>
</div>