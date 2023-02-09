$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            ajaxSetup();
            $.ajax({
                url: '/login',
                type: 'post',
                data: {
                    email: $("input[name ='email']").val(),
                    password: $("input[name='password']").val()
                },
                success: function (result) {
                    if (result['message']) {
                        window.location.replace('/comic');
                    } else {
                        loginError();
                        $("input[name='password']").val('');
                    }
                }
            });
        }
    });

    $('#quickForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
            terms: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
            },
            password: "Please provide a password",
            terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
