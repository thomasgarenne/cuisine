<div class="sidebar">
	<div class="avatarContainer">
		<img src="/user/uploads/<?= $_SESSION["user"]["avatar"] ?>" alt="Photo de profil" class="avatar">
	</div>

	<nav class="side">
		<h4><?= ucfirst($_SESSION["user"]['username']); ?></h4>
		<ul>
			<?php if ($_SESSION["user"]["role"] === '["ROLE_ADMIN"]') { ?>
				<li><a class="admin-nav-link" href="/admin/index.php">📁 <span>Administration</span></a></li>
			<?php } ?>
			<li><a href="/user/informations.php" id="informations">💁 <span>Informations</span></a></li>
			<li><a href="/user/recettes.php" id="recettes">🍳 <span>Recettes</span></a></li>
			<li><a href="/user/coupDeCoeur.php" id="coup-de-coeur">💟 <span>Coup de coeur</span></a></li>
			<li><a href="/user/mesCommentaire.php">✍ <span>Mes commentaires</span></a></li>
		</ul>
	</nav>
</div>