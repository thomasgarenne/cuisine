// Attendez que le document soit prêt
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez le formulaire
    var form = document.getElementById("saveRecette");

    // Attachez un gestionnaire d'événements au formulaire pour intercepter la soumission
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Empêche la soumission normale du formulaire

        // Créez un objet FormData à partir du formulaire
        var formData = new FormData(form);

		var baseUrl = "ingredientRecette/addIngredientRecette.php"; // URL de base
		var searchParams = new URLSearchParams(formData); // Créez une URLSearchParams à partir de FormData
		var fullUrl = baseUrl + "?" + searchParams.toString();

        // Utilisez la méthode fetch pour envoyer les données au serveur
        fetch(fullUrl)
        .then(response => response.json())
        .then(result => {
			if (result.success === true) {
				console.log(result.message);

                const ingredientListContainer = document.querySelector("#listContainer");
                let ingredientListHTML ="<div>";

                ingredientListHTML += '<input type="hidden" name="id" value="' + result.recetteId + '">';
                ingredientListHTML += '<label for="ingredient">Ingrédient</label>';
                ingredientListHTML += '<input type="text" value="' + result.ingredientId + '">';
                ingredientListHTML += '<label for="quantity">Quantité</label>';
                ingredientListHTML += '<input type="text" value="' + result.quantity + '">';
                ingredientListHTML += '<label for="unity">Unité de mesure</label>';
                ingredientListHTML += '<input type="text" value="' + result.unity + '">';
                ingredientListHTML += '<button class="btns" data-recetteId="' + result.recetteId + '" data-ingredientId="' + result.ingredientId + '">X</button>';
                ingredientListHTML += '</div>'
                ingredientListContainer.insertAdjacentHTML('beforeend', ingredientListHTML);
                
				form.reset();
			} else {
                let qteMsg = document.querySelector("#qteMsg");
                qteMsg.innerHTML = result.message;
				console.log(result.message);
			}
        })
        .catch(error => {
            console.error("Erreur lors de la requête : ", error);
        });
    });
});
