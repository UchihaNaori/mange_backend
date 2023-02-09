$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            let formData = new FormData();
            formData.append('name', $('#name').val());
            formData.append('phone', $('#phone').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('image', $('#exampleInputFile')[0].files[0])
            ajaxSetup();
            $.ajax({
                url: '/register',
                type: 'post',
                // data: {
                //     name: $('#name').val(),
                //     phone: $('#phone').val(),
                //     email: $('#email').val(),
                //     password: $('#password').val(),
                //     image: $('input[name=avatar]').val()
                // },
                data: formData,
                contentType : false,
                processData : false,
                success: function (result) {
                    if (result == 'Error') {
                        registerError();
                    }
                }
            })
        }
    });

    $('#quickForm').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6
            },
            confirmPassword: {
                required: true,
                minlength: 6,
                equalTo: '[name=password]'
            },
            phone : {
                required: true,
                minlength: 9,
                maxlength: 12,
            },
            terms: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please type your name"
            },
            email: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            confirmPassword: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Confirm password not match"
            },
            phone: {
                required: "Please type your phone",
                minlength: "Please enter more than 9 characters",
                maxLength: "Please enter a valid phone number",
            },
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
