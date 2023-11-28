const buttons = document.querySelectorAll('.btn-delete');

buttons.forEach(b => {
    b.addEventListener('click', () => {
        let userId = b.getAttribute('data-userid');
        console.log(userId);
        let recetteId = b.getAttribute('data-recetteid');
        let row = document.querySelector(`#id${userId}`);
        
        fetch(`/admin/commentaires/deleteCommentaire.php?userId=${userId}&recetteId=${recetteId}`, {
            method: 'DELETE'
        })
        .then(res => {
            if(!res.ok) {
                throw new Error('La suppresion a échoué');
            }
            return res.json();
        })
        .then(result => {
            if (result.success === true) {
                showFlashMessage(result.message, 3000);
                row.remove();
            } else {
                console.log(result.message);
            }
        })
        .catch(error => console.error(error));
    });   
});