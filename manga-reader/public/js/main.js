/*!
 * Bootstrap 4 multi dropdown navbar ( https://bootstrapthemes.co/demo/resource/bootstrap-4-multi-dropdown-navbar/ )
 * Copyright 2017.
 * Licensed under the GPL license
*/

const METHOD_POST = "POST";
const METHOD_GET = "GET";
const METHOD_DELETE = "DELETE";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function callAjaxFormData(url, method = METHOD_GET, data = null) {
    return $.ajax({
        data: data,
        method: method,
        url: url,
        contentType: false,
        processData: false
    })
}

function callAjax(url, method = METHOD_GET, data = null) {
    return $.ajax({
        data: data,
        method: method,
        url: url
    })
}

// Live search
$('#text-search').on('keyup',function (){
    var url = $(this).data('href');
    callAjax(url,METHOD_GET)
})

// Show errors
function showErrorMessage(errors) {
    $('.error-message').find('ul').html('');
    $('.error-message').removeClass('d-none');
    $.each(errors, function (key, value) {
        $('.error-message').find('div').append('<p>' + value + '</p>');
    })
}

// Show image
$('#inputFileImage').change(function() {
    let reader = new FileReader();
    reader.onload = (e) => {
        $('#preview-image-before-upload').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
});

// Check all
$('.checkall').click(function() {
    // Add this command for new browser
    if ($(this).prop('checked')) {
        $(this).attr('checked', 'checked');
    } else {
        $(this).removeAttr('checked');
    }

    $('input:checkbox[class="checkboxes"]').not(this).prop('checked', this.checked);

    if ($(this).attr('checked') === 'checked') {
        // Add new
        $('.checkboxes').each(function() {
            $(this).parent().addClass('checked');
            $(this).attr('checked', 'checked');
        });

        var showFlg = false;
        $('.checkboxes').each(function() {
            if ($(this).attr('checked') === 'checked') {
                showFlg = true;
            }
        });

        if (showFlg === true) {
            $('.delete-selected').show();
        } else {
            $('.delete-selected').hide();
        }
    } else {
        $('.checkboxes').each(function() {
            $(this).parent().removeClass('checked');
            $(this).removeAttr('checked');
        });
        $('.delete-selected').hide();
    }
});

$('.checkboxes').click(function() {
    // Add this command for new browser
    if ($(this).prop('checked')) {
        $(this).attr('checked', 'checked');
    } else {
        $(this).removeAttr('checked');
    }

    var showFlg = false;
    $('.checkboxes').each(function() {
        if ($(this).attr('checked') === 'checked') {
            showFlg = true;
        }
    });
    if (showFlg === true) {
        $('.delete-selected').show();
    } else {
        $('.delete-selected').hide();
    }
});

// Change order
$('.change-order').on('change', function (){
    var modelName = $(this).attr('data-model');
    var id = $(this).attr('data-id');
    var orderVal = $(this).val();
    if (isNaN(orderVal) || (!Number(orderVal) && orderVal!= "") || Number(orderVal) < 0 || Number(orderVal) > 127) {
        $(this).val(0);
    }
    $('.update-selected').show();
})

$(document).on('click', '.update-selected', function() {
    var listItems = [];
    var url = $(this).data("href");
    $('.change-order').each(function() {
        var obj = new Object();
        obj.id = $(this).attr('data-id');
        obj.order = $(this).val();
        listItems.push(obj);
    });

    batchChangePos(listItems, url);
});

function batchChangePos(listItems, url)
{
    $('.update-selected').hide();
    let data = {listItems: listItems};
    callAjax(url, METHOD_POST, data)
        .then(function (status = 200){
            location.reload();
        })
        .catch(function (errors){
            showErrorMessage(errors?.responseJSON?.errors);
        })
}

// Before delete
$(document).on('click', '.delete-all', function (){
    beforeDelete();
})

function beforeDelete(){
    var lsId = '';
    $('.checkboxes').each(function (){
        if($(this).is(':checked')){
            lsId += $(this).val() + ",";
        }
    });
    lsId = lsId.substring(0, lsId.length -1);
    if(lsId.length>0) {
        deleteAll(lsId);
    }
}
// Delete one
$(document).on('click', '.delete', function (){
    let url = $(this).data("href");
    callAjax(url, METHOD_DELETE)
        .then(function (status = 200){
            location.reload();
        })
        .catch(function (errors){
            showErrorMessage(errors?.responseJSON?.errors);
        })
});

// Delete all
function deleteAll(lsId){
    let data = {lsIds: lsId};
    callAjax(deleteAllUrl, METHOD_POST, data)
        .then(function (status = 200){
            location.reload();
        })
        .catch(function (errors){
            showErrorMessage(errors?.responseJSON?.errors);
        })
}

// Change status
$(function() {
    $('.toggle-class').change(function () {
        var id = $(this).data('id');
        let data = {id};
        let url = $(this).data("href");
        callAjax(url, METHOD_POST, data)
    });
});

$(document).ready(function(){
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e){
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        if (!$(this).next().hasClass('show')){
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parent("li").toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e){
            $('.dropdown-menu .show').removeClass("show");
        });

        if (!$parent.parent().hasClass('navbar-nav')){
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        }
        return false;
    });
});

// Select 2
// $(document).ready(function() {
//     $('.js-example-basic-multiple').select2();
// });

// Count down
if($(".mercado-countdown").length > 0){
    $(".mercado-countdown").each( function(index, el){
        var expire = $(this).data('expire');
        $(this).countdown(expire, function(event) {
            $(this).html( event.strftime('%D Days %H:%M:%S'));
        });
    });
}

// Todays Date
// $(function() {
//     var interval = setInterval(function() {
//         var momentNow = moment();
//         $('#today-date').html(momentNow.format('DD') + ' ' + ''
//             + momentNow.format('- dddd').substring(0, 12));
//     }, 100);
// });


// $(function() {
//     var interval = setInterval(function() {
//         var momentNow = moment();
//         $('#todays-date').html(momentNow.format('DD MMMM YYYY'));
//     }, 100);
// });

// Loading
$(function() {
    $("#loading-wrapper").fadeOut(3000);
});



// Textarea characters left
$(function() {
    $('#characterLeft').text('140 characters left');
    $('#message').keydown(function () {
        var max = 140;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('You have reached the limit');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');
        }
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');
        }
    });
});

// Bootstrap JS ***********

// Tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(function () {
    $('[data-toggle="popover"]').popover()
})

// Maintenance mode
$('.maintenance').on('click', function (){
    if(document.getElementById('maintenance').checked) {
        let url = urlOn;
        callAjax(url);
    } else {
        let url = urlOff;
        callAjax(url);
    }
})

