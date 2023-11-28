const form = document.querySelector("form");

form.addEventListener('submit', (e) => {
	e.preventDefault();
	
	const name = document.querySelector('input[name = "name"]').value;
	const ingredients = document.querySelector('.ingredients');

	const url = "/admin/ingredients/addIngredientAjax.php?name=" + name;

	fetch(url)
	.then(res => {
		if (res.ok) {
			return res.json();
		} else {
			throw new Error('Réponse non valide du serveur');
		}
	})
	.then(result => {
		if (result.success === true) {
			const newIngredient = document.createElement('p');
        	newIngredient.textContent = "L'ingrédient : " + result.name + " a été ajouté avec succés";
        	ingredients.appendChild(newIngredient);	
		} else {
			console.log(result.message)
		}
	})
	.catch(error => console.error(error))
	
});
