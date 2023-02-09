$(document).ready(function () {
    $('#btn-update-category').on('click', function () {
        window.location.replace($(this).attr('data-href'));
    })
});
