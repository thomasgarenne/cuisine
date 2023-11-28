// Fonction pour afficher le message flash avec une durée spécifique
showFlashMessage = (message, duration) => {
	const flashMessage = document.getElementById('flash-message');
    flashMessage.innerText = message;
    flashMessage.style.display = 'block';
    
    // Masquer le message après la durée spécifiée (en millisecondes)
    setTimeout(() => {
		flashMessage.style.display = 'none';
    }, duration);
}