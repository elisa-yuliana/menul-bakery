$(document).ready(function() {
    // Simpan path ke variabel agar kode lebih bersih
    const eyeOpen = "/img/icons/eye.svg";
    const eyeClosed = "/img/icons/eye-slash.svg";

    $('#togglePassword').on('click', function() {
        const passwordField = $('#password');
        const eyeIcon = $('#eyeIcon');
        
        // Cek tipe input saat ini
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            eyeIcon.attr('src', eyeClosed); // Ganti ke ikon mata tertutup
        } else {
            passwordField.attr('type', 'password');
            eyeIcon.attr('src', eyeOpen); // Ganti ke ikon mata terbuka
        }
    });
});