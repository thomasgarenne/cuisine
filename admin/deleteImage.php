<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/images.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/session.php";

adminOnly();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    deleteImage($pdo, $id);
}
