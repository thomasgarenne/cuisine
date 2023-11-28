<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/users.php";
require_once __DIR__ . "/templates/header.php";

$errors = [];

if (isset($_POST["email"]) && !is_null($_POST["email"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user = verifyUserLoginPassword($pdo, $email, $password);

    if ($user) {
        session_regenerate_id(true);
        $_SESSION["user"] = $user;
        if ($user["role"] === '["ROLE_ADMIN"]') {
            header("Location: http://localhost:8000/admin/index.php");
            exit();
        } elseif ($user["role"] === '["ROLE_USER"]') {
            header("Location: http://localhost:8000/index.php");
            exit();
        }
    } else {
        $errors[] = "Email ou mot de passe incorrect";
    }
}
?>

<?php foreach ($errors as $error) { ?>
    <div>
        <p class="alert"><?= $error ?></p>
    </div>
<?php } ?>

<h1>Connectez vous</h1>

<form action="" method="post">
    <label for="email">Votre E-mail</label>
    <input type="email" name="email" id="email">

    <label for="password">Votre mot de passe</label>
    <input type="password" name="password" id="password">

    <button type="submit">Se connecter</button>
</form>

<?php
require_once __DIR__ . "/templates/footer.php";
?>