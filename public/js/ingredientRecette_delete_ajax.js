let btns = document.querySelectorAll('.btns');

btns.forEach(b => {
    b.addEventListener('click', (e) => {
        e.preventDefault();
        
        let recetteId = b.getAttribute('data-recetteId');
        let ingredientId = b.getAttribute('data-ingredientId');
        fetch(`/admin/ingredientRecette/deleteIngredientRecette.php?recetteId=${recetteId}&ingredientId=${ingredientId}`, {
            method: 'DELETE'
        })
        .then((response) => response.json())
        .then((data) => {
            if(data.success === true) {
                b.parentElement.remove();
                console.log('success');
            } else {
                console.log('error');
            }
        })
        .catch((error) => console.error(error))
    })
})
