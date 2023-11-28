const url = "ingredientRecette/getIngredientRecette.php";
	
	fetch(url)
	.then(res => res.json())
	.then(result => console.log(result))
	.catch(error => console.error(error))

