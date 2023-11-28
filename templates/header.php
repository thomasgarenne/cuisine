<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
$mainMenu["signIn.php"] = ["title" => "Sign In", "meta_desc" => "Inscrivez vous sur notre site", "exclude" => true];
$mainMenu["login.php"] = ["title" => "Log In", "meta_desc" => "Connectez vous sur notre site", "exclude" => true];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/public/css/style.css">
    <title><?= $mainMenu[$currentPage]['title']; ?></title>
</head>

<body>

    <nav id="navbar">
        <div class="list-item">
            <a href="/index.php" class="logo">🍚</a>

            <?php
            foreach ($mainMenu as $key => $menu) {
                if (!array_key_exists("exclude", $menu)) {
                    $active = ($key === $currentPage) ? "active" : "";
            ?>
                    <a href=<?= $key ?> class="nav-item <?= $active ?>"><?= $menu["title"]; ?></a>
            <?php }
            } ?>
        </div>

        <?php if (isset($_SESSION["user"])) { ?>
            <div>
                <?php if ($_SESSION["user"]["role"] === '["ROLE_ADMIN"]') { ?>
                    <a href="/admin/index.php" class="nav-item">Administration</a>
                <?php } ?>
                <a href="/user/informations.php" class="nav-item">Account</a>
                <a href="logout.php" class="nav-item">Logout</a>
                <span class="visible">🥩</span>
            </div>
        <?php } else { ?>
            <div>
                <a href="login.php" class="nav-item">Login</a>
                <a href="signIn.php" class="nav-item">Sign In</a>
            </div>
        <?php } ?>
    </nav>