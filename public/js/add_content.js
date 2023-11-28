const content = document.querySelector("#content");

const informations = document.querySelector("#informations");
const recettes = document.querySelector("#recettes");
const coupDeCoeur = document.querySelector("#coup-de-coeur");

informations.addEventListener("click", () => {
	fetch('/admin/user/informations.php')
		.then(res => res.text())
		.then(data => {
			content.innerHTML = data;
		})
		.catch(e => console.error(e))
});

recettes.addEventListener("click", () => {
	fetch('/admin/user/recettes.php')
	.then(res => res.text())
	.then(data => {
		content.innerHTML = data;
	})
	.catch(e => console.error(e))
})

coupDeCoeur.addEventListener("click", () => {
	fetch('/admin/user/coupDeCoeur.php')
	.then(res => res.text())
	.then(data => {
		content.innerHTML = data;
	})
	.catch(e => console.error(e))
})