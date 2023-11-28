<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/lib/users.php";

$errors = [];
$messages = [];
?>
<section class="container bg">
    <div id="flash-message" class="flash-message"></div>
    <form action="" method="post" class="connexion">
        <fieldset>
            <legend>Enregistrez vous !</legend>

            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username" placeholder="Pseudo" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="example@email.fr" required>

            <label for="password">Votre mot de passe</label>
            <input type="password" name="password" id="pass" placeholder="******" required>
            <div class="password-info">
                <ul>
                    <li id="password-length" class="danger">8 Caractères minimum</li>
                    <li id="password-upper" class="danger">1 Majuscule</li>
                    <li id="password-lower" class="danger">1 Minuscule</li>
                    <li id="password-number" class="danger">1 Chiffre</li>
                    <li id="password-special" class="danger">1 Caractère spécial</li>
                </ul>
            </div>

            <button type="submit" name="saveUser">S'enregistrer</button>
        </fieldset>
    </form>
</section>

<script src="/public/js/flash_message.js"></script>
<script src="/public/js/validationForm.js"></script>

<?php
if (isset($_POST["saveUser"])) {
    if ($_POST['username'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "") {

        $username = htmlentities($_POST["username"]);
        $email =  htmlentities($_POST["email"]);
        $password = htmlentities($_POST["password"]);

        if (addUser($pdo, $username, $email, $password)) {
            $messages[] = 'Utilisateur ajouté';

            header('Location: /login.php');
        } else {
            $errors[] = 'Une erreur est survenue';
        }
    } else {
        $errors[] = 'Formulaire non remplit';
    }
}

require_once __DIR__ . "/admin/templates/flash.php";
require_once __DIR__ . "/templates/footer.php";
?>