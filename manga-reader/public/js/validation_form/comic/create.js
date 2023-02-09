$(document).ready(function () {

    $('#create-comic').validate({
        rules: {
            name: {
                required: true
            },
            image: {
                required: true
            },
            author: {
                required: true
            }
        },
        messages: {
            name: "Please enter your comic name",
            image: "Please upload your avatar comic",
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
