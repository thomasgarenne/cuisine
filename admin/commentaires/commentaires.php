<?php
$title = "Commentaires";
require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../templates/nav.php";
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";

adminOnly();

$commentaires = getCommentaires($pdo);
?>
<div class="content">
	<?php require_once __DIR__ . "/index.php"; ?>
</div>

<?php require_once __DIR__ . "/../templates/footer.php"; ?>