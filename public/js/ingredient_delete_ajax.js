const buttons = document.querySelectorAll('.btn-delete');

buttons.forEach(b => {
    b.addEventListener('click', () => {
        let id = b.getAttribute('data-id');
        let row = document.querySelector(`#id${id}`);
        
        fetch(`/admin/ingredients/deleteIngredient.php?id=${id}`, {
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
                console.log(result.message);
                row.remove();
            } else {
                console.log(result.message);
            }
        })
        .catch(error => console.error(error));
    });   
});