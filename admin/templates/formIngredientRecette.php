<section>
	<form action="" method="post" id="ingredientList">
		<fieldset>
			<legend>Ajouter des ingrédients à la recette</legend>

			<input type="hidden" name="recetteId" value="<?= $pdo->lastInsertId(); ?>">

			<div id="champsDynamiques">
				<!-- Les champs seront ajoutés ici -->
			</div>

			<button type="button" id="ajouterChamp">Ajouter un ingrédient</button>
		</fieldset>

		<input type="submit" value="ajouter recette" name="saveRecettes" />
	</form>
</section>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const champsDynamiques = document.getElementById("champsDynamiques");
		const ajouterChampBtn = document.getElementById("ajouterChamp");

		let champCount = 0;

		ajouterChampBtn.addEventListener("click", function() {
			champCount++;

			const nouveauChamp = document.createElement("div");
			nouveauChamp.innerHTML = `
				<select name="ingredients" id="ingredient${champCount}">
					<?php foreach ($ingredients as $i) { ?>
						<option value="<?= $i["id"] ?>"><?= $i["name"] ?></option>
					<?php } ?>
				</select>
				<label for="quantity">Quantité</label>
				<input type="number" name="quantity" id="quantity${champCount}">
				<label for="unity">Unité de mesure</label>
				<select name="unity" id="unity${champCount}">
					<option value="ml">ml</option>
					<option value="cl">cl</option>
					<option value="g">g</option>
					<option value="cuillere_soupe">Cuillères à soupe</option>
					<option value="cuillere_cafe">Cuillères à café</option>
					<option value="qte">qté</option>
				</select>
			`;

			champsDynamiques.appendChild(nouveauChamp);
		});

	});
</script>