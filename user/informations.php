<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/users.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/validation.php";
require_once __DIR__ . "/../lib/session.php";

userOnly();

$title = "Compte";
require_once __DIR__ . "/../admin/templates/header.php";

$user = $_SESSION['user'];
$users = showUser($pdo, $user["id"]);

$errors = [];
$messages = [];

if (isset($_POST["saveUsername"])) {

	$username = htmlentities($_POST['username']);

	$usernameValidationResult = validateText("nom d'utilisateur", $username, 3, 20);
	if ($usernameValidationResult !== null) {
		$errors[] = $usernameValidationResult;
	}

	if (empty($errors)) {
		addUsername($pdo, $username, $user['id']);
		$users = showUser($pdo, $user["id"]);
		$_SESSION["user"] = $users;
		//header('Location: /user/Informations.php');
	}
}

if (isset($_POST["saveAvatar"])) {
	if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
		$avatar = saveFiles('uploads', 'avatar');
	} else {
		$errors[] = "Veuillez sélectionner une image valide avant de valider.";
	}

	if (empty($errors)) {
		addAvatar($pdo, $avatar, $user['id']);
		$users = showUser($pdo, $user["id"]);
		$_SESSION["user"] = $users;
		//header('Location: /user/Informations.php');
	}
}
?>
<?php require_once __DIR__ . "/../templates/account_sidebar.php"; ?>

<div class="content">
	<?php require_once __DIR__ . "/../admin/templates/flash.php" ?>

	<h2>Bienvenue <?= ucfirst($user['username']); ?></h2>

	<form action="" method="post">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?= $user['username'] ?>">

		<button type="submit" name="saveUsername">Enregistrer</button>
	</form>

	<form action="" method="post" enctype="multipart/form-data">
		<label for="avatar">Avatar</label>
		<input type="file" name="avatar" id="avatar">

		<button type="submit" name="saveAvatar">Enregistrer</button>
	</form>
</div>

<?php require_once __DIR__ . "/../templates/footer.php" ?>