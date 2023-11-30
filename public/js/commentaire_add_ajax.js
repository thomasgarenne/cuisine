const form = document.querySelector('form');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        //Création d'élément DOM
        const com = document.querySelector('.commentaire');
        const ul = document.createElement('ul');
        const a = document.createElement('li');
        const c = document.createElement('li');
        const n = document.createElement('li');
        const d = document.createElement('li');

        //URL + DATA
        const data = new FormData(form);
        const baseURL = "/admin/commentaires/addCommentaire.php";

        try {
            const response = await fetch(baseURL, {
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
                console.log(result.success);
                showFlashMessage(result.message, 3000);

                // Ajouter valeur au DOM
                a.textContent = 'Nom : ' + result.u;
                c.textContent = 'Commentaire : ' + result.c;
                n.textContent = 'Notes : ' + result.n;
                d.textContent = 'Date : ' + result.d;

                ul.appendChild(a);
                ul.appendChild(c);
                ul.appendChild(n);
                ul.appendChild(d);
               
                com.prepend(ul);

                form.reset();
            } else {
                console.log(result.message);
            }
        } catch (error) {
            console.error(error);
            showFlashMessage(error, 3000);
        }
    });