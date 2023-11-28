<?php
$domain = getenv('DOMAIN');

// Remplacer "domain" par DOMAIN en local et "secure" sur false

session_set_cookie_params([
    "lifetime" => 3600,
    "path" => "/",
    "domain" => $domain,
    "secure" => true,
    "httponly" => true

]);

session_start();

function adminOnly()
{
    if (!isset($_SESSION["user"])) {
        header('Location: ../login.php');
    } elseif ($_SESSION["user"]["role"] !== '["ROLE_ADMIN"]') {
        header('Location: ../index.php');
    }
}

function userOnly()
{
    if (!isset($_SESSION["user"])) {
        header('Location: ../login.php');
    } elseif ($_SESSION["user"]["role"] !== '["ROLE_ADMIN"]' && $_SESSION["user"]["role"] !== '["ROLE_USER"]') {
        header('Location: ../index.php');
    }
}
