const form = document.querySelector('form');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = new FormData(form);

    // Base de l'URL de votre script PHP
    const baseUrl = "/admin/commentaires/editCommentaireAjax.php";

    try {
        const response = await fetch(baseUrl, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: data
        });

        if (!response.ok) {
            throw new Error("Une erreur est survenue");
        }

        const result = await response.json();

        if (result.success) {
            showFlashMessage(result.message, 3000);
        } else {
            console.log(result.message);
        }
    } catch (error) {
        console.error(error);
    }
});
