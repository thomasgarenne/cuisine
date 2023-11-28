<div>
    <?php foreach ($messages as $m) { ?>
        <div class="alert alert-success" role="alert">
            <?= $m ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $e) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $e ?>
        </div>
    <?php } ?>
</div>


<form action="" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Informations recette</legend>
        <label for="name">Nom de la recette</label>
        <input type="text" name="name" id="name">

        <label for="description">Description de la recette</label>
        <input type="text" name="description" id="description">

        <label for="instructions">Instructions de la recette</label>
        <input type="text" name="instructions" id="instructions">

        <label for="tp">Temps de préparation</label>
        <input type="number" name="tp" id="tp">

        <label for="tc">Temps de cuisson</label>
        <input type="number" name="tc" id="tc" min=1 max=99>

        <label for="categories">Catégories</label>
        <select name="categories" id="categories">
            <?php foreach ($categories as $c) { ?>
                <option value="<?= $c['id'] ?>"> <?= $c['nom'] ?></option>
            <?php } ?>
        </select>
    </fieldset>

    <fieldset>
        <legend>Ajouter des ingrédients à la recette</legend>

        <div id="champsDynamiques">
            <!-- Les champs seront ajoutés ici -->
        </div>

        <button type="button" id="ajouterChamp">Ajouter un ingrédient</button>
    </fieldset>

    <fieldset>
        <legend>Ajouter une image</legend>
        <label for="upload">Images</label>
        <input type="file" name="upload" id="upload">
    </fieldset>

    <button type="submit" name="saveRecettes">Ajouter</button>
</form>

<a href="<?= PREVIUS ?>"><button>Retour</button></a>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const champsDynamiques = document.getElementById("champsDynamiques");
        const ajouterChampBtn = document.getElementById("ajouterChamp");

        let champCount = 0;

        ajouterChampBtn.addEventListener("click", function() {
            champCount++;

            const nouveauChamp = document.createElement("div");
            nouveauChamp.setAttribute("data-id", "id" + champCount);
            nouveauChamp.classList.add("champs");

            nouveauChamp.innerHTML = `
				<select name="ingredients[]" id="ingredient${champCount}">
					<?php foreach ($ingredients as $i) { ?>
						<option value="<?= $i["id"] ?>"><?= $i["name"] ?></option>
					<?php } ?>
				</select>
				<label for="quantity">Quantité</label>
				<input type="number" name="quantity[]" id="quantity${champCount}">
				<label for="unity">Unité de mesure</label>
				<select name="unity[]" id="unity${champCount}">
					<option value="ml">ml</option>
					<option value="cl">cl</option>
					<option value="g">g</option>
					<option value="cuillere_soupe">Cuillères à soupe</option>
					<option value="cuillere_cafe">Cuillères à café</option>
					<option value="qte">qté</option>
				</select>
                <button class="supprimerChamp" data-id="id${champCount}">X</button>
			`;

            champsDynamiques.appendChild(nouveauChamp);

            //Supprimer un ingrédient
            const supprimerChampBtn = document.querySelectorAll(".supprimerChamp");
            const champs = document.querySelectorAll(".champs");
            for (const btn of supprimerChampBtn) {
                for (let i = 0; i < champs.length; i++) {
                    if (btn.dataset.id === champs[i].dataset.id) {
                        btn.addEventListener('click', () => {
                            champs[i].remove();
                        });
                    }
                }
            }
        });



    });
</script>