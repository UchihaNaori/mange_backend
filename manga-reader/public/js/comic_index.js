$(document).ready(function () {
    $('#btn-update-comic').on('click', function () {
        window.location.replace($(this).attr('data-href'));
    });

    $('.add-new-chapter').on('click', function () {
        window.location.replace($(this).attr('data-href'));
    });

    $('.list-chapter').on('click', function () {
        window.location.replace($(this).attr('data-href'));
    })

});
