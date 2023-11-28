let buttons = document.querySelectorAll('.btn-delete');
let rows = document.querySelectorAll('.tr-delete');

buttons.forEach(b => {
    b.addEventListener('click', () => {
        let id = b.getAttribute('data-id');
        let row = document.querySelector(`#id${id}`);
        
        fetch(`/admin/categories/deleteCategories.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(res => res.json())
        .then(result => {
            if (result.success === true) {
                console.log(result.message);
                row.remove();
            } else {
                console.log(result.message);
            }
        })
        .catch(e => console.error(e))
    });
});