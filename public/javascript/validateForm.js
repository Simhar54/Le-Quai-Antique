// Fonctions de validation
function validateRequired(input) {
    return input.value.trim() !== '';
}

function validateLength(input, minLength, maxLength) {
    return input.value.length >= minLength && input.value.length <= maxLength;
}

function validateText(input) {
    const regex = /^[a-zA-Z\s]+$/;
    return regex.test(input.value);
}

function validateEmail(input) {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(input.value);
}

function validatePassword(input) {
    return input.value.length >= 8;
}

function validatePasswordConfirmation(input, passwordInput) {
    return input.value === passwordInput.value;
}

function validateNumber(input) {
    return !isNaN(input.value);
}

function validateFields(input, passwordInput) {
    let isValid = false;
    let fieldName = input.name;

    // Validation de l'input Prénom
    if (fieldName === 'firstName') {
        isValid = validateRequired(input) && validateLength(input, 2, 20) && validateText(input);
    }

    // Validation de l'input Nom
    if (fieldName === 'lastName') {
        isValid = validateRequired(input) && validateLength(input, 2, 20) && validateText(input);
    }

    // Validation de l'input Email
    if (fieldName === 'email') {
        isValid = validateRequired(input) && validateEmail(input);
    }


    // Validation imput pas null
    function validatePasswordConfirmation(input, passwordInput) {
        return input && passwordInput && input.value === passwordInput.value;
    }

    // Validation de l'input Mot de passe
    if (fieldName === 'password') {
        isValid = validateRequired(input) && validatePassword(input);
    }

    // Validation de l'input Confirmation de mot de passe
    if (fieldName === 'passwordConfirmation') {
        isValid = validateRequired(input) && validatePasswordConfirmation(input, passwordInput);
    }

    // Validation de l'input Nombre de convives
    if (fieldName === 'guests') {
        isValid = validateRequired(input) && validateNumber(input);
    }

    // Validation de l'input Allergies
    if (fieldName.startsWith('allergies')) {
        isValid = input.value.trim() === '' || validateText(input);
    }

    // Appliquer les styles de validation de Bootstrap
    if (isValid) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    } else {
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }

    return isValid;
}

// Bootstrap validation
(function () {
    'use strict';

    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            let inputs = form.querySelectorAll('input, select, textarea');
            let isFormValid = true;
            const passwordInput = form.querySelector('input[name="password"]');

            inputs.forEach((input) => {
                if (!validateFields(input, passwordInput)) {
                    isFormValid = false;
                }
            });

            if (!isFormValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        }, false);
    });
})();
