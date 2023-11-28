let form = document.querySelector('form');
let inputs = document.querySelectorAll('input');

let div = document.createElement("div");
let p = document.createElement("p");

    inputs.forEach(input => {   
        input.addEventListener('focusout', (e) => {
            if (input.type !== 'submit') {
                if (!validateField(input)) {       
                isFormValid = false;
                e.target.classList.remove('success');
                e.target.classList.add('danger');
            
                div.style.display = 'block';
            
                e.target.before(div);
                div.appendChild(p);
                p.innerHTML = "Vous devez remplir le champs : " + input.name;

                e.stopPropagation();
            } else {
                e.target.classList.remove('danger');
                e.target.classList.add('success');
            
                div.style.display = 'none';
            }
            }
        });
    });

    form.addEventListener('submit', (event) => {
        let isFormValid = true;
    
        inputs.forEach(input => {
            if (input.type !== 'submit') {
                if (!validateField(input)) {
                    isFormValid = false;
                    input.classList.add('danger');
                }
            }

        });
        
        if (!isFormValid) {
            alert('Vous n\'avez pas remplit tous les champs du formulaires')
            event.preventDefault();
            event.stopPropagation();
        }
    });

/** Function for validation */
function required(input) {
    return !(input.value == null && input.value == "");
}

function validateLength(input, minLength, maxLength) {
    return !(input.value.length < minLength || input.value.length > maxLength);
}

function validateText(input) {
    return input.value.match('^[A-Za-z]+$');
}

function validateNumber(input) {
    return input.value.match('^[0-9]+$');
}

/** Validate all the validate function */
function validateField(input) {
    let fieldName = input.name;
    if (fieldName == 'name') {
        if (!required(input)) {
            return false;
        }
        if (!validateLength(input, 5, 20)) {
            return false;
        }
        return true;
    }
    if (fieldName == 'description') {
        if (!required(input)) {
            return false;
        }
        if (!validateLength(input, 10, 200)) {
            return false;
        }
        return true;
    }
    if (fieldName == 'instructions') {
        if (!required(input)) {
            return false;
        }
        if (!validateLength(input, 10, 200)) {
            return false;
        }
        return true;
    }
    if (fieldName == 'tp') {
        if (!required(input)) {
            return false;
        }
        if (!validateNumber(input)) {
            return false;
        }
        return true;
    }
    if (fieldName == 'tc') {
        if (!required(input)) {
            return false;
        }
        if (!validateNumber(input)) {
            return false;
        }
        return true;
    }
    if (fieldName == 'upload') {

        return true;
    }
}
