$(document).ready(function() {
    const eyeOpen = "/img/icons/eye.svg";
    const eyeClosed = "/img/icons/eye-slash.svg";

    // Fungsi reusable untuk toggle password
    function setupToggle(buttonId, inputId, iconId) {
        $(`#${buttonId}`).on('click', function() {
            const field = $(`#${inputId}`);
            const icon = $(`#${iconId}`);
            
            if (field.attr('type') === 'password') {
                field.attr('type', 'text');
                icon.attr('src', eyeClosed);
            } else {
                field.attr('type', 'password');
                icon.attr('src', eyeOpen);
            }
        });
    }

    // Terapkan ke kedua kolom
    setupToggle('togglePassword', 'password', 'eyeIcon');
    setupToggle('togglePasswordConfirmation', 'password_confirmation', 'eyeIconConfirmation');
});