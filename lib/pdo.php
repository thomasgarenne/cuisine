<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../.env';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');

$dotenv->load();

/*
try {
    $pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('PDO ERREUR : ' . $e->getFile() . ' L ' . $e->getLine() . ' : ' . $e->getMessage());
}
*/

$url = getenv('JAWSDB_URL');

$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'], '/');


try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
