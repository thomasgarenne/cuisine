let btn = document.querySelectorAll('.btn');

btn.forEach(b => {
    b.addEventListener('click', () => {
        let id = b.getAttribute('data-id');
        fetch(`/admin/deleteImage.php?id=${id}`, {
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
