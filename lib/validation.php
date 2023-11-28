<?php

function validateText($field, $value, $minLength, $maxLength)
{
	if (empty($value)) {
		return 'Le champ ' . $field . ' est vide.';
	}

	if (strlen($value) < $minLength || strlen($value) > $maxLength) {
		return 'Le champ ' . $field . ' doit avoir une longueur entre ' . $minLength . ' et ' . $maxLength . ' caractères.';
	}

	if (!preg_match('/[a-zA-Zàâäéèêëîïôöùûüç0-9\s.,!?()-]+/', $value)) {
		return 'Le champ ' . $field . ' ne doit contenir que des lettres et des espaces.';
	}

	return null;
}


function validateQuantity($qte)
{
	if (filter_var($qte, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1))) === false) {
		return "La quantité doit être un nombre entier positif.";
	}

	return null;
}
