<?php
require_once __DIR__ . "/lib/menu.php";
require_once __DIR__ . "/templates/header.php";

$title = "A propos";

require_once __DIR__ . "/templates/baniere.php";
?>
<section class="container">
	<div class="center">
		<div class="presentation">
			<p>Ce site à été développer pour venir compléter une compétence de mon dossier professionel (réaliser une interface de gestion de contenu).</p></br>
			<p>Je n'avais pas l'intention de le publier, mais de fil en aiguille c'est devenu un projet intéressant pour développer mes connaissances en PHP.</p></br>
			<p>Le fait d'aimer cuisiner à surement participer à cela aussi !!</p></br>
		</div>
		<div class="presentation">
			<span>Liste des compétences :</span>
			<ul class="flex">
				<li>HTML</li>
				<li>CSS</li>
				<li>JS</li>
				<li>PHP</li>
				<li>SQL</li>
			</ul>
		</div>
	</div>
</section>
<?php
require_once __DIR__ . "/templates/footer.php";
?>