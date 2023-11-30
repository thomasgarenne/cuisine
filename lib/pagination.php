<?php

if (isset($_GET["page"]) && !empty($_GET["page"])) {
	$currentPage = (int)htmlspecialchars($_GET["page"]);
} else {
	$currentPage = 1;
}

$parPage = 1;
$pages = ceil($nbItems / $parPage);
$premier = ($currentPage * $parPage) - $parPage;
