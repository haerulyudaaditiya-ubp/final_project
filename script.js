// JavaScript untuk toggle form login dan register
document.addEventListener('DOMContentLoaded', function () {
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');
    const loginForm = document.querySelector('.form-box.login');
    const registerForm = document.querySelector('.form-box.register');

    // Saat link register diklik, sembunyikan form login dan tampilkan form register
    registerLink.addEventListener('click', function (e) {
        e.preventDefault();
        loginForm.classList.add('d-none'); // Sembunyikan form login
        registerForm.classList.remove('d-none'); // Tampilkan form register
    });

    // Saat link login diklik, sembunyikan form register dan tampilkan form login
    loginLink.addEventListener('click', function (e) {
        e.preventDefault();
        registerForm.classList.add('d-none'); // Sembunyikan form register
        loginForm.classList.remove('d-none'); // Tampilkan form login
    });
});
