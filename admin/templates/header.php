<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";

//adminOnly();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title><?= $title ?></title>
</head>

<body>
    <nav id="navbar">
        <div>
            <a href="../index.php" class="logo">🍚</a>
            <a href="../index.php" class="nav-item">Home</a>
            <a href="../about.php" class="nav-item">A propos</a>
            <a href="../contact.php" class="nav-item">Contact</a>
        </div>

        <?php if (isset($_SESSION["user"])) { ?>
            <div>
                <?php if ($_SESSION["user"]["role"] == '["ROLE_ADMIN"]') { ?>
                    <a href="/admin/index.php" class="nav-item">Administration</a>
                <?php } ?>
                <a href="/user/informations.php" class="nav-item">Account</a>
                <a href="../logout.php" class="nav-item">Logout</a>
            </div>
        <?php } ?>
    </nav>