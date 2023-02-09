function resetPasswordCheck() {
    let email = $('#email-reset').val();
    let password = $('#password-reset').val();
    let confirmPassword = $('#password-confirm-reset').val();
    let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let flagCheck = true;

    $('.password-block').empty();
    $('#password-reset').addClass('default-color-input');

    $('.confirm-password-block').empty();
    $('#password-confirm-reset').addClass('default-color-input');

    $('.email-block').empty();
    $('#email-reset').addClass('default-color-input');

    if (email === '') {
        flagCheck = false;
        $('#email-reset').addClass('danger-customer');
        $('.email-block').addClass('text-danger');
        $('.email-block').append('Please type a email address !');
    } else if (!email.match(mailFormat)) {
        flagCheck = false;
        $('#email-reset').addClass('danger-customer');
        $('.email-block').addClass('text-danger');
        $('.email-block').append('You have entered an invalid email address !');
    }

    if (password === '') {
        flagCheck = false;
        $('#password-reset').addClass('danger-customer');
        $('.password-block').addClass('text-danger');
        $('.password-block').append('Please type password !');
    } else if (password.length < 6) {
        flagCheck = false;
        $('#password-reset').css('border-color', 'd44843');
        $('.password-block').addClass('text-danger');
        $('.password-block').append('Password must be at least 6 characters !');
    }

    if (confirmPassword === '') {
        flagCheck = false;
        $('#password-confirm-reset').addClass('danger-customer');
        $('.confirm-password-block').addClass('text-danger');
        $('.confirm-password-block').append('Please type confirm password !');
    } else if (confirmPassword != password) {
        flagCheck = false;
        $('#password-confirm-reset').addClass('danger-customer');
        $('.confirm-password-block').addClass('text-danger');
        $('.confirm-password-block').append('Confirm password not match !');
        $('#password-confirm').val('');
    }

    return flagCheck;
}

function alertError(errorMes) {
    Swal.fire({
        title: 'Error',
        text: errorMes
    });
}

