$(document).ready(function () {

    $('#create-comic').validate({
        rules: {
            name: {
                required: true
            },
            'category[]': {
                required: true,
            },
            author: {
                required
            }
        },
        messages: {
            name: "Please enter your comic name",
            'category[]': "Please choose your comic categories",
            author: "Please type name of the comic's author"
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
