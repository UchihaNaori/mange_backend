$(function () {
    bsCustomFileInput.init();
    $('.select2').select2()

//Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $('#exampleInputFile').change(function () {
        let fileName = $('input[type=file]').val().split('\\').pop();
        if (fileName.length < 11) {
            $('#chapter').val(fileName.substr(0, fileName.length - 4));
        } else {
            let keySplit = 'Chapter ';
            if (fileName.indexOf('Chapter ') === -1) keySplit = 'chapter ';
            let arrText = fileName.split(keySplit);
            if (arrText.length >= 2) {
                let charSplit = '_';
                if (arrText[1].indexOf(charSplit) === -1) {
                    charSplit = '-';
                }
                let arr = arrText[1].split(charSplit);
                if (arr.length >= 2) {
                    $('#chapter').val(arr[0].trim());
                    let title = arr[1].trim();
                    if(title.indexOf('.zip') !== -1) {
                        title = title.substr(0, title.length - 4);
                    }
                    $('#title').val(title)
                } else {
                    let chapter = arrText[1].trim();
                    chapter = chapter.substr(0, chapter.length - 4);
                    $('#chapter').val(chapter);
                    $('#title').val('');
                }
            }
        }
    });
});

$(document).ready(function () {

    $('#create-chapter').validate({
        rules: {
            comic: {
                required: true,
                isNull : false
            },
            name: {
                required: true
            },
            zip: {
                required: true
            }
        },
        messages: {
            name: "Please enter your comic name",
            comic:{
                required: "Please choose a comic",
                isNull: "Please choose a comic"
            },
            zip: "Please upload your chapter"
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

