<?php
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";

$title = "Contact";

require_once __DIR__ . "/templates/baniere.php";
?>
<section class="container">
	<div id="flash-message" class="flash-message"></div>

	<form action="contact-validation.php" method="POST" id="contact" class="connexion">
		<fieldset>
			<legend>Formulaire de contact</legend>

			<label for="email">Email</label>
			<input type="email" name="email" placeholder="example@mail.fr" required>

			<label for="message">Votre message</label>
			<input type="text" name="message" id="message" placeholder="Ecrivez votre message ici" required minlength="10" maxlength="200"></input>

			<button type="submit">Envoyer</button>
		</fieldset>
	</form>
</section>

<script src="/public/js/flash_message.js"></script>
<script src="/public/js/validationForm.js"></script>


<?php
require_once __DIR__ . "/templates/footer.php";
?>