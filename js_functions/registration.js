function validatePassword() {
    const registerButton = document.querySelector('#register-button');
    const username = document.querySelector('#username');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm-password');
    const errorMessage = document.querySelector('#error-message');

    if (username.value && password.value && confirmPassword.value) {
        if (password.value !== confirmPassword.value) {
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Passwords do not match!';
            registerButton.style.display = 'none';
        } else {
            errorMessage.style.display = 'none';
            errorMessage.textContent = '';
            registerButton.style.display = 'block';
        }
    } else {
        registerButton.style.display = 'none';
    }
}

function togglePassword() {
    const togglePasswordButton = document.querySelector('#toggle-password-button');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm-password');
    let buttonText = togglePasswordButton.textContent.trim();

    if (buttonText === 'Show password') {
        password.type = 'text';
        confirmPassword.type = 'text';
        togglePasswordButton.textContent = 'Hide password'; 
    } else if (buttonText === 'Hide password') {
        password.type = 'password';
        confirmPassword.type = 'password';
        togglePasswordButton.textContent = 'Show password';
    }
}





