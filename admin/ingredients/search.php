<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/pdo.php";
require_once __DIR__ . "/../../lib/ingredients.php";

$ingredients = indexIngredients($pdo);
?>
<form action="">
	<!-- Champ de recherche -->
	<label for="searchIngredients">Rechercher des ingrédients</label>
	<input type="text" id="searchIngredients" placeholder="Rechercher...">
	<br>

	<!-- Liste déroulante de recherche -->
	<label for="Ingredients">Ingrédients</label>
	<select class="ingredients" name="selectedIngredients[]" multiple>
		<?php foreach ($ingredients as $i) { ?>
			<option value="<?= $i['name'] ?>"><?= $i['name'] ?></option>
		<?php } ?>
	</select>
	<br>
</form>
<!-- Bouton "Ajouter" -->
<button id="ajouter">Ajouter</button>

<!-- Bouton "Retirer" -->
<button id="retirer">Retirer</button>

<!-- Variable visible pour afficher les éléments ajoutés -->
<div id="elementsAjoutes"></div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const select = document.querySelector('.ingredients');
		const searchInput = document.querySelector('#searchIngredients');
		const ajouterButton = document.getElementById('ajouter');
		const retirerButton = document.getElementById('retirer');
		const elementsAjoutes = document.getElementById('elementsAjoutes');
		let selectedOptions = []; // Variable pour stocker les éléments ajoutés

		searchInput.addEventListener('input', function() {
			const searchText = searchInput.value.toLowerCase();
			const options = select.options;

			for (let i = 0; i < options.length; i++) {
				const optionText = options[i].text.toLowerCase();
				options[i].style.display = optionText.includes(searchText) ? 'block' : 'none';
			}
		});

		ajouterButton.addEventListener('click', function() {
			// Parcours des options de la liste de recherche et ajout d'une option sélectionnée à la variable visible.
			for (let i = 0; i < select.options.length; i++) {
				if (select.options[i].selected) {
					const optionValue = select.options[i].value;
					selectedOptions.push(optionValue);

					// Afficher l'élément ajouté dans la variable visible
					elementsAjoutes.innerHTML = "Ingrédients ajoutés : " + selectedOptions.join(', ');
					break; // Ajouter un élément à la fois
				}
			}
		});

		retirerButton.addEventListener('click', function() {
			// Retirer l'élément sélectionné de la variable et de la variable visible
			for (let i = 0; i < select.options.length; i++) {
				if (select.options[i].selected) {
					const optionValue = select.options[i].value;
					const index = selectedOptions.indexOf(optionValue);
					if (index !== -1) {
						selectedOptions.splice(index, 1);
					}

					// Actualiser la variable visible
					elementsAjoutes.innerHTML = "Ingrédients ajoutés : " + selectedOptions.join(', ');
				}
			}
		});
	});
</script>