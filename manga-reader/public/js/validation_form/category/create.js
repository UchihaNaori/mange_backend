$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            ajaxSetup();
            $.ajax({
                url: '/category/create',
                type: 'post',
                data: {
                    title: $("input[name ='title']").val(),
                    active: $("input[name='active']:checked").val(),
                    description: $("#description").val()
                },
                success: function (result) {
                   window.location.replace('/category');
                }
            });
        }
    });

    $('#create-category').validate({
        rules: {
            title: {
                required: true
            },
            description: {
                required: true
            },
        },
        messages: {
            title: "Please enter title",
            description: "Please type description",
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
