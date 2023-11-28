<?php

//require_once __DIR__ . "/../lib/secret.php";
define("DOMAIN", "localhost");
define("DB_SERVER", "localhost");
define("DB_NAME", "cook");
define("DB_USER", "root");
define("DB_PASS", "");
define("ASSETS_IMAGES", "/assets/images/");
define("ASSETS_UPLOADS_RECETTE", "/assets/uploads/recettes/");
define("ADMIN_ITEM_LIMIT", 10);

if (isset($_SERVER['HTTP_REFERER'])) {
	define("PREVIUS", $_SERVER['HTTP_REFERER']);
}
