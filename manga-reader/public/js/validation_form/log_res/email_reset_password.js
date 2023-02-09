function emailSendLink() {
    let email = $('#email-reset-password').val();
    let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let flagCheck = true;

    $('.email-block').empty();
    $('#email-reset-password').addClass('default-color-input');

    if (email=== '') {
        flagCheck = false;
        $('#email-reset-password').addClass('danger-customer');
        $('.email-block').addClass('text-danger');
        $('.email-block').append('Please type a email address !');
    } else if (!email.match(mailFormat)) {
        flagCheck = false;
        $('#email-reset-password').addClass('danger-customer');
        $('.email-block').addClass('text-danger');
        $('.email-block').append('You have entered an invalid email address !');
    }

    return flagCheck;
}

function alertError() {
    Swal.fire({
        title: 'Error',
        text: 'Email does not exits !'
    });
}

function alertSuccess() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Please check your email !',
        showConfirmButton: false,
        timer: 1500
    });
}
