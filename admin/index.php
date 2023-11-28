<?php
$title = "Administration";
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/templates/nav.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/admin.php";

adminOnly();

//Information utilisateur
$username = $_SESSION['user']['username'];

//Compteur
$nbUsers = countTable($pdo, "users");
$nbRecette = countTable($pdo, "recette");
$nbCommentaire = countTable($pdo, "commentaire");

//Dernier ajout
$lastUsers = lastAdd($pdo, "users", 5);
$lastRecettes = lastAdd($pdo, "recette", 5);
?>
<div class="content">
    <h2>Hello <?= $username ?></h2>

    <div>
        <h3>Compteurs</h3>
        <p>Nombre d'utilisateurs : <?= $nbUsers ?></p>
        <p>Nombre de recette : <?= $nbRecette ?></p>
        <p>Nombre de commentaire : <?= $nbCommentaire ?></p>
    </div>
    <section>
        <div>
            <h3>Derniers Utilisateurs</h3>
            <?php foreach ($lastUsers as $u) { ?>
                <p><?= $u['username'] ?></p>
                <p><?= $u['email'] ?></p>
            <?php } ?>
        </div>
        <div>
            <h3>Dernière Recettes</h3>
            <?php foreach ($lastRecettes as $r) { ?>
                <p><?= $r['name'] ?></p>
                <p><?= $r['description'] ?></p>
            <?php } ?>
        </div>
    </section>
</div>
<?php
require_once __DIR__ . "/templates/footer.php";
?>