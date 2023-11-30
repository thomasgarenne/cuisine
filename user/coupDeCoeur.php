<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/menu.php";
require_once __DIR__ . "/../lib/users.php";
require_once __DIR__ . "/../lib/likes.php";
require_once __DIR__ . "/../lib/session.php";

userOnly();

$title = "Mes coups de coeur";
require_once __DIR__ . "/../admin/templates/header.php";

$user = $_SESSION['user'];
$users = showUser($pdo, $user["id"]);

$url = "/coupDeCoeur";
$fav = favories($pdo, $user["id"]);
$nbItems = count($fav);
require_once __DIR__ . "/../lib/pagination.php";
$favories = favoriesPaginated($pdo, $user["id"], $premier, $parPage);
?>

<?php require_once __DIR__ . "/../templates/account_sidebar.php"; ?>
<div class="content">
	<div id="flash-message" class="flash-message"></div>
	<h2>Mes recettes coup de coeur</h2>
	<?php foreach ($favories as $f) { ?>
		<div class="block">
			<h4><?= $f["name"] ?></h4>
			<p><?= $f["description"] ?></p>
			<div>
				<button><a href="/recette.php?id=<?= $f['recetteId'] ?>">Voir</a></button>
				<button id="like" data-recetteid="<?= $f['recetteId'] ?>" data-userid="<?= $users["id"] ?>">Supprimer</button>
			</div>
		</div>
	<?php } ?>
</div>

<?php require_once __DIR__ . "/../templates/pagination.php"; ?>

<script src="/public/js/flash_message.js"></script>
<script src=/public/js/likes/likes.js></script>
<?php
require_once __DIR__ . "/../templates/footer.php";
?>