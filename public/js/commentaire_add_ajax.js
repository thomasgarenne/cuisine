const form = document.querySelector('form');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        //Création d'élément DOM
        const com = document.querySelector('.commentaire');
        const ul = document.createElement('ul');
        const a = document.createElement('li');
        const c = document.createElement('li');
        const n = document.createElement('li');
        const d = document.createElement('li');
        
        // On récupère les valeurs du formulaire
        const comment = document.querySelector('#commentaire').value;
        const notes = document.querySelector('#notes').value;
        const userId = document.querySelector('#userId').getAttribute('data-author');
        const recetteId = document.querySelector('#recetteId').getAttribute('data-recette');
        const username = document.querySelector('#username').getAttribute('data-username');
        
        //Base de notre url de notre script php
        const baseUrl = '/admin/commentaires/addCommentaire.php';

        const url = new URL(baseUrl);
    
        //On ajoute les valeurs avec leur clé à l'url
        url.searchParams.append("comment", comment);
        url.searchParams.append("notes", notes);
        url.searchParams.append("userId", userId);
        url.searchParams.append("recetteId", recetteId);
        url.searchParams.append("username", username);

        const urlParams = url.toString();

        fetch(urlParams, {

        })
        .then(res => {
            if (!res.ok) {
                throw new Error("L'ajout a échoué");
            }
            return res.json();
        })
        .then(result => {
            if (result.success === true) {
                showFlashMessage(result.message, 3000);
                console.log(result.message);
                a.textContent = 'Nom : ' + result.u;
                c.textContent = 'Commentaire : ' + result.c;
                n.textContent = 'Notes : ' + result.n;
                d.textContent = 'Date : ' + result.d;

                //Ajout des li à ul
                ul.appendChild(a);
                ul.appendChild(c);
                ul.appendChild(n);
                ul.appendChild(d);

                //Ajout ul à com
                com.prepend(ul);

                //Réinitialise le form
                form.reset();
            } else {

                showFlashMessage(result.message, 3000);
                console.log(result.message);
            }
        })
        .catch(e => console.error(e));
    });
