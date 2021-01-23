!function (t, e, n) {

    n(".custom-file input").change(function (t) {
        n(this).next(".custom-file-label").html(t.target.files[0].name)
    })
}(window, document, jQuery);

var API_ENDPOINT = window.location.origin+'/api'
var RootPath = window.location.origin;

$.delete = function(url, data, callback, type){

    if ( $.isFunction(data) ){
        type = type || callback,
            callback = data,
            data = {}
    }

    return $.ajax({
        url: url,
        type: 'DELETE',
        success: callback,
        data: data,
        contentType: type
    });
}



function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

$(document).ajaxStart(function () {
    $('.card-body').addClass('is-loading is-loading-primary');
});

$(document).ajaxStop(function () {
    $('.card-body').removeClass('is-loading is-loading-primary');
});


$("#login").validate({
    validClass: "success",
    highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    submitHandler: function (form) {
        $('.container').addClass('is-loading is-loading-primary');
        form.submit();
    }
});


$("#register").validate({
    validClass: "success",
    highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    submitHandler: function (form) {
        $('.container').addClass('is-loading is-loading-primary');
        form.submit();
    }
});

var api = function (method, url, data, callback) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: API_ENDPOINT+url,
        method: method,
        data: data,
        global: false,
        success: function (response) {
            $('.card-body').removeClass('is-loading is-loading-primary');
            var buttons = $('.is-loading');
            $.each(buttons,function (){
                $(this).removeClass('is-loading disabled');
            })
            callback(response);
            var content = {};
            if (response.status && response.title && response.message) {
                content.title = response.title;
                content.message = response.message;
                content.icon = 'fa fa-bell';
                $.notify(content, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    time: 1000,
                    delay: 2000,
                });
            }
        },
        error: function (response) {
            $('.card-body').removeClass('is-loading is-loading-primary');
            var buttons = $('.is-loading');
            $.each(buttons,function (){
                $(this).removeClass('is-loading disabled');
            })
            if (response.status === 422) {

                $.each(response.responseJSON.errors, function (key, value) {
                    var input = 'input[name=' + key + ']';
                    $(input).parent().find('span').remove();
                    $(input).parent().append('<label class="error" role="alert">' + value + '</label>');
                    $(input).parent().parent().addClass('has-error');
                });
                $.each(response.responseJSON.errors, function (key, value) {
                    var input = 'select[name=' + key + ']';
                    $(input).parent().append('<label class="error" role="alert">' + value + '</label>');
                    $(input).parent().parent().addClass('has-error');
                });
                $('html, body').animate({scrollTop: $(".form-group.has-error:first :input").offset().top - 100}, 500);
                return false;
            }
            response = response.responseJSON;
            var content = {};
            content.title = response.title;
            content.message = response.message;
            content.icon = 'fa fa-bell';

            $.notify(content, {
                type: 'danger',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 1000,
                delay: 3000,
            });
        }
    });
};

var ContactsIndex = function () {
    var contacts_table;
    var init = function () {

        contacts_table = $('#contacts_table').DataTable({

            "serverSide": true,
            "ajax": API_ENDPOINT+'/contacts',
            rowId: "id",
            "lengthMenu": [ 10, 25, 50, 100, 500, 999,'All'],

            columns: [
                {data: null ,render:function (data) {
                        return '<div class="item-list">' +
                            '<span class="rating rating-sm mr-3">' +
                            '<input type="checkbox" id="star'+data.id+'" value="1" '+(data.is_favorite === 1  ? 'checked' : '')+'>' +
                            '<label for="star'+data.id+'">\n' +
                            '<span class="fa fa-star"></span>' +
                            '</label>' +
                            '</span>'+
                            '<div class="avatar">' +
                            '\<img src="'+data.photo+'" alt="avatar" class="lazyload avatar-img rounded-circle">\n' +
                            '</div>' +
                            '<div class="info-user ml-3">' +
                            '<div class="username">'+data.name+'</div>' +
                            '<div class="status">'+data.job+'</div>' +
                            '</div>' +
                            '</div>';
                    }},
                {data: 'email',render:function (data) {
                        return '<a href="mailto:'+data+'">'+data+'</a>';
                    }},
                {data: 'mobile_number',orderable: false},
                {data: 'location'},

                {
                    data: null, orderable: false, className: 'text-center', render: function (data) {
                        var edit_url = '' + RootPath + /contacts/ + data.id + '/edit';
                        var show_url = '' + RootPath + '/contacts/' + data.id + '';
                        return '<div class="form-button-action">' +
                            '<button type="button" class="btn btn-link  btn-info btn-group-lg" data-toggle="tooltip" data-original-title="Edit" onclick="window.location.href= \'' + edit_url + '\'  ">\n' +
                            '<i class="fa fa-user-edit"></i>\n' +
                            '</button>' +
                            '<button type="button" class="btn btn-link  btn-secondary btn-group-lg" data-toggle="tooltip" data-original-title="Show" onclick="window.location.href= \'' + show_url + '\'  ">\n' +
                            '<i class="fa fa-user"></i>\n' +
                            '</button>' +
                            '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger delete_client"  data-original-title="Remove">\n' +
                            '<i class="fa fa-trash"></i>\n' +
                            '</button>' +
                            '</div>';
                    }
                }

            ],


            "fnDrawCallback": function () {
                $('button').tooltip();
                ll = new LazyLoad({
                    callback_error: function(element) {
                        element.src = "https://images.assetsdelivery.com/compings_v2/thesomeday123/thesomeday1231709/thesomeday123170900021.jpg";
                    },
                    threshold: 0

                });
            }
        });
    }

    return {
        init : init
    }
};


