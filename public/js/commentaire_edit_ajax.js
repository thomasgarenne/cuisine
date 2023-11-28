const form = document.querySelector('form');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = new FormData(form);

    // Base de l'URL de votre script PHP
    const baseUrl = 'http://localhost:8000/admin/commentaires/editCommentaireAjax.php';

    // Créez une instance d'URL avec l'URL de base
    const url = new URL(baseUrl);

    // Ajoutez les valeurs à l'URL en utilisant append
    data.forEach((value, key) => {
        url.searchParams.append(key, value);
    });

    // Convertissez l'URL en chaîne
    const urlParams = url.toString();
    console.log(urlParams);

    try {
        const response = await fetch(urlParams, {
            method: 'PATCH',
            headers: {
                'Accept': 'application/json',
            }
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
