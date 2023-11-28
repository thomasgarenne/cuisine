const form = document.querySelector('form');
const inputs = document.querySelectorAll('input');
let errorMessages = {
    username: [],
    email: [],
    password: [],
};

form.addEventListener('submit', (e) => {
    inputs.forEach(input => {
        if (input.name !== "saveUser") {
            if (!validateField(input)) {
                e.preventDefault();
                
                input.classList.remove('success');
                input.classList.add('danger');

                const errorMessageElement = document.querySelector('#' + input.name + '-error');
                errorMessageElement.innerHTML = errorMessages[input.name].join('<br>');
          
            } else {
                input.classList.remove('danger');
                input.classList.add('success');
            }
        }
    });
});

function required(input) {
    if (input.value.trim() === '') {
        return false;
    } else {
        return true;
    }
}

const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

function isValidEmail(input) {
    return input.value.match(emailRegex);
}

function validateLength(input, minLength, maxLength) {
    if (input.value.length < minLength || input.value.length > maxLength) {
        return false;
    } else {
        return true;
    }
}

function validateField(input) {
    if (input.name === "username") {
        if (!required(input)) {
            if (input.value.trim() === '') {
                errorMessages[input.name].push('Le champ : ' + input.name + ' est requis');
                return false;
            }
            if (!validateLength(input, 5, 20)) {
                errorMessages[input.name].push('Le nombre de caractères doit être compris entre 5 et 20');
                return false;
            }
            // Réinitialiser le tableau des messages d'erreur pour ce champ
            errorMessages[input.name] = [];
            return true;
        }
    }
    if (input.name === "email") {
        if(!required(input)) {
            errorMessages[input.name].push('Le champ : ' + input.name + ' est requis');
            return false;
        }
        if(!isValidEmail(input)) {
            errorMessages[input.name].push('L\' ' + input.name + ' n\'est pas valide');
            return false;
        }
        // Réinitialiser le tableau des messages d'erreur pour ce champ
        errorMessages[input.name] = [];
        return true;
    }
    if (input.name === "password") {
        if(!required(input)) {
            errorMessages[input.name].push('Le champ : ' + input.name + ' est requis');
            return false;
        }
        // Réinitialiser le tableau des messages d'erreur pour ce champ
        errorMessages[input.name] = [];
        return true;
    } 

    return true;
}
