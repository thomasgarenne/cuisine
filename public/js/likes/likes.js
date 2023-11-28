//Récupère le boutton d'ajout
const buttonLike = document.querySelector("#like");
const recetteId = buttonLike.dataset.recetteid;
const userId = buttonLike.dataset.userid;
const block = document.querySelector(".block");

if (userId !== '-1') {
	const url = "/admin/likes/addLikes.php?recetteId=" + recetteId + "&userId=" + userId;
	
	buttonLike.addEventListener("click", () => {
		fetch(url)
		.then(res => res.json())
		.then(result => {
			if (result.success === true) {
				showFlashMessage(result.message, 3000);
				buttonLike.innerHTML = result.likeData + '👍';
				block.remove();
			} else {
				showFlashMessage(result.message, 3000);
			}
		})
		.catch(error => console.error(error))
	})
} else {
	let message = "Vous devez être connecté pour ajouter un like.";

	buttonLike.addEventListener("click", () => {
		showFlashMessage(message, 3000);
	});
}
