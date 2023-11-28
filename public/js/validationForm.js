const form = document.querySelector("form");
let inputs = document.querySelectorAll("input");
const password = document.querySelector("#pass");

let isFormValid = true;

form.addEventListener('submit', (e) => {
	if (!isFormValid) {
		showFlashMessage("Formulaire non valide");

		e.preventDefault();
		e.stopPropagation();
	} else {
		showFlashMessage("Message envoyé", 3000);
	}
});

inputs.forEach(input => {
	input.addEventListener('focusout', () => {
		if (!validateField(input)) {
			let message = "Le champ '" + input.name + "' n'est pas valide";
			showFlashMessage(message, 3000);

			isFormValid = false;
		} else {
			isFormValid = true;
		}
	});
});

password.addEventListener('input', () => {
	validePassword(password);
})

//Valide les champs suivant les vérifications
function validateField(input) {
	let fieldName = input.name;

	if (fieldName == 'username') {
		if (!required(input)) {
			return false;
		}

		if (!validateLength(input, 3, 20)) {
			return false;
		}

		return true;
	}

	if (fieldName == 'email') {
		if (!required(input)) {
			return false;
		}
		if (!valideEmail(input)) {
			return false;
		}

		return true;
	}

	if (fieldName == 'message') {
		if (!required(input)) {
			return false;
		}
		if (!validateLength(input, 10, 200)) {
			return false;
		}

		return true;
	}

	if (fieldName == 'password') {
		if (!validePassword(input)) {
			return false;
		}

		return true;
		
	}

}


//Vérifie qu'un champs ne soit pas null ou ''
function required(input) {
	if (input.value !== null && input.value !== "") {
		return true;
	} else {
		return false;
	}
}

//Vérifie le format d'un email
function valideEmail(input) {
	const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
	
	if (regexEmail.test(input.value)) {
		return true;
	} else {
		return false;
	}
}

//Valide la longueur
function validateLength(input, min, max) {
	let size = input.value.length;
	return size >= min && size <= max;
}

//Ajout classe pour password
function addOrRemoveClass(element, isSuccess) {
	if (isSuccess) {
		element.classList.remove("danger");
		element.classList.add("success");
	} else {
		element.classList.remove("success");
		element.classList.add("danger");
	}

	return isSuccess;
}
//Valide password
function validePassword(password) {
	const passwordUpper = document.querySelector("#password-upper");
	const passwordLower = document.querySelector("#password-lower");
	const passwordNumber = document.querySelector("#password-number");
	const passwordSpecial = document.querySelector("#password-special");
	const passwordLength = document.querySelector("#password-length");

	const isUpperValid = addOrRemoveClass(passwordUpper, /[A-Z]+/.test(password.value));
	const isLowerValid = addOrRemoveClass(passwordLower, /[a-z]+/.test(password.value));
	const isNumberValid = addOrRemoveClass(passwordNumber, /[0-9]+/.test(password.value));
	const isSpecialValid = addOrRemoveClass(passwordSpecial, /[&#\-\/*+_|!?]+/.test(password.value));
	const isLengthValid = addOrRemoveClass(passwordLength, password.value.length >= 8 && password.value.length <= 20);

	return isUpperValid && isLowerValid && isNumberValid && isSpecialValid && isLengthValid;
}
