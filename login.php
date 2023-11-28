<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/users.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";

$errors = [];

if (isset($_POST["email"]) && !is_null($_POST["email"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $user = verifyUserLoginPassword($pdo, $email, $password);

    if ($user) {
        session_regenerate_id(true);
        $_SESSION["user"] = $user;

        if ($user["role"] === '["ROLE_ADMIN"]') {
            header("Location: /admin/index.php");
            exit();
        } elseif ($user["role"] === '["ROLE_USER"]') {
            header("Location: /user/informations.php");
            exit();
        }
    } else {
        $errors[] = "Email ou mot de passe incorrect";
    }
}
?>
<section class="container bg">
    <?php foreach ($errors as $error) { ?>
        <div id="flash-message" class="flash-message">
            <p class="alert"><?= $error ?></p>
        </div>
    <?php } ?>

    <form action="" method="post" class="connexion">
        <fieldset>
            <legend>Connectez vous !</legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="example@email.fr" required>

            <label for="password">Votre mot de passe</label>
            <input type="password" name="password" id="password" placeholder="********" required>

            <button type="submit">Se connecter</button>
        </fieldset>
    </form>
</section>

<?php
require_once __DIR__ . "/templates/footer.php";
?>