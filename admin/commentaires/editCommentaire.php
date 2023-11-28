<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/commentaires.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../templates/nav.php";

$title = "Modifier commentaire";
require_once __DIR__ . "/../templates/header.php";

userOnly();


if ($_SESSION["user"]["role"] == '["ROLE_ADMIN"]' || $_SESSION["user"]["id"] == $_GET["userId"]) {

    if (isset($_GET['userId'], $_GET['recetteId'])) {
        $userId = (int)$_GET['userId'];
        $recetteId = (int)$_GET['recetteId'];
        $c = getCommentaires($pdo, $userId, $recetteId);
    }
?>
    <div class="content">
        <h2>Modifier un commentaire</h2>
        <div class="flash-message" id="flash-message"></div>

        <form action="" method="post">
            <input type="hidden" name="userId" value="<?= $c['userId'] ?>">
            <input type="hidden" name="recetteId" value="<?= $c['recetteId'] ?>">

            <label for="commentaire">Commentaire</label>
            <input type="text" name="commentaire" value="<?= $c['commentaire'] ?>">

            <label for="notes">Notes</label>
            <input type="number" name="notes" value="<?= $c['notes'] ?>" min="1" max="5">

            <button type="submit" class="btn-edit flash" name="saveCommentaire" data-flash="Commentaire ajouté">Modifier</button>
        </form>
        <a href="<?= PREVIUS ?>"><button>Retour</button></a>
    </div>

    <script src="/public/js/commentaire_edit_ajax.js"></script>
    <script src="/public/js/flash_message.js"></script>

<?php
} else {
    header('Location: /user/mesCommentaire.php');
}
require_once __DIR__ . "/../templates/footer.php"; ?>