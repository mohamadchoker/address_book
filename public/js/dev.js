
var API_ENDPOINT = window.location.origin+'/api';
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
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.alert-success').fadeTo(2000, 1000).slideUp(1000, function () {
    $(".alert-success").slideUp(1000);
});


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


    $.ajax({
        url: url,
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

        $('.btn-filter').on('click', function () {
            $('.filter').toggle();
        })

        $('.company').select2({
            placeholder: "Select a company",
            allowClear: true,
            theme: "bootstrap",
        });
        $('.job').select2({
            placeholder: "Select a job",
            allowClear: true,
            theme: "bootstrap",
        });
        $('.group').select2({
            placeholder: "Select a group",
            allowClear: true,
            theme: "bootstrap",
        });
        $('.tags').select2({
            placeholder: "Select tags",
            allowClear: true,
            theme: "bootstrap",
        });
        $('.location').select2({
            placeholder: "Select a location",
            allowClear: true,
            theme: "bootstrap",
        });

        $('.country').select2({
            placeholder: "Select a country",
            allowClear: true,
            theme: "bootstrap",
        });
        $('.favorite').select2({
            placeholder: "Favortie",
            allowClear: true,
            theme: "bootstrap",
        });

        $(".filter_value").each(function () {
            $(this).val('').trigger('change');
        });

        $('.clear').on('click', function () {
            $(".filter_value").each(function () {
                $(this).val('').trigger('change');
            });
        });

        contacts_table = $('#contacts_table').DataTable({

            "serverSide": true,
            "ajax": API_ENDPOINT+'/contacts',
            rowId: "id",
            "lengthMenu": [ 10, 25, 50, 100, 500, 999],
            language: {
                searchPlaceholder: "Search records"
            },
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
                            '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger delete_contact"  data-original-title="Remove">\n' +
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
                $('.delete_contact').on('click', function () {
                    var $this = this;
                    var data = contacts_table.row($this.closest('tr')).data();


                    Swal.fire({
                        title: 'Are you sure you want to delete:',
                        text: data.name,
                        icon: 'warning',
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        showLoaderOnConfirm: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true,
                        showCancelButton: true,
                        preConfirm: function (){
                            var id = contacts_table.row($this.closest('tr')).id();
                            return $.delete('' + API_ENDPOINT + '/contacts/' + id + '',function (){

                            }).done(function (res){
                                var ajax_url = RootPath + '/api/contacts';
                                contacts_table.ajax.url(ajax_url).load();
                                if(res.status){
                                    Swal.fire({
                                        icon: 'success',
                                        text: res.message,
                                        timer: 2000,
                                        confirmButtonText: 'Ok',
                                        timerProgressBar: true,
                                    }).then(function (){
                                        swal.close();
                                    })

                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        text: res.message,
                                        confirmButtonText: 'ok'
                                    })
                                }
                            }).fail(function(res) {
                                Swal.fire({
                                    icon: 'error',
                                    text: res.messsge,
                                    confirmButtonText: 'Ok'
                                })
                            })

                        },

                    })
                });
                $('.fa-star').on('click',function (){
                    var $this = this;
                    var id = contacts_table.row($this.closest('tr')).id();
                    var checked = ($('#star'+id+'').is(':checked')) ? 0 : 1;
                    api('post',API_ENDPOINT+'/contacts/'+id+'/action-favorite',{favorite:checked},function (){

                    })
                })
            }
        });
    }

    $('.filter_submit').on('click', function () {
        ajax_url = API_ENDPOINT+'/contacts?'
        $(".filter_value").each(function () {
            var id = $(this).attr('id');
            var _this = $(this);
            var value;
            if(id == 'tags'){
                value = $('#'+id+'').val()
            }else{
                value = $("#" + id + " option:selected").val();
            }
            if (typeof value === 'undefined' || value === '') {
                value = _this.val();
            }
            if (value !== '' && value !== null && value.length !== 0) {
                ajax_url = ajax_url + id + "=" + value + "&";
            }
        });
        contacts_table.ajax.url(ajax_url).load();
    });


    return {
        init : init
    }
};

var ContactCreate  = function (type) {
    var init = function (){
        $body = $('body');
        $group = $('.group');
        $('#birth_date').datetimepicker({
            format: 'MM/DD/YYYY',
            icons:
                {
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                }
        });

        $group.select2({
            placeholder: "Select a group",
            allowClear: true,
            theme: "bootstrap",
        });
        if(type == 'create'){
            $group.val('').trigger('change');
        }


        $('.tags').select2({
            placeholder: "Select tags",
            theme: "bootstrap",
        });

        $('.add-phone').on('click',function (){
            new phoneNumber();
        })

        $body.on('click','.remove-phone',function (){
            removePhone($(this));
        })

        $('.add-address').on('click',function (){
            new address();
        })

        $body.on('click','.remove-address',function (){
            removeAddress($(this));
        })

        var phoneNumber = function (){
            var data = [{}];
            $('#tmpl-phone').tmpl(data).appendTo('#phones')
            var phones_length = $('.phone').length;
            if(phones_length > 1){
                $('.remove-phone').removeClass('d-none')
            }
        }

        var removePhone = function (phone){
            phone.closest('.phone').remove();
            var phones_length = $('.phone').length;
            if(phones_length === 1){
                $('.remove-phone').each(function (){
                    $(this).addClass('d-none')
                })
            }
        }

        var address = function (){
            var data = [{}];
            $('#tmpl-address').tmpl(data).appendTo('#addresses')

            var addresses_length = $('.address').length;
            if(addresses_length > 1){
                $('.remove-address').removeClass('d-none')
            }
        }

        var removeAddress = function (address){
            address.closest('.address').remove();
            var addresses_length = $('.address').length;
            if(addresses_length === 1){
                $('.remove-address').each(function (){
                    $(this).addClass('d-none')
                })
            }
        }

        var buildContactData = function (){
            var phones = [];
            var addresses = [];

            $('.phone').each(function (){
                var _this = $(this);
                var phone = {};
                phone['number'] = _this.find('input[name="number"]').val() || null;
                phone['type'] = _this.find('select').find(':selected').val();
                phones.push(phone);
            })

            $('.address').each(function (){
                var _this = $(this);
                var address = {};
                address['title'] = _this.find('input[name="title"]').val() || null;
                address['line1'] = _this.find('input[name="line1"]').val() || null;
                address['line2'] = _this.find('input[name="line2"]').val() || null;
                address['state'] = _this.find('input[name="state"]').val() || null;
                address['city'] = _this.find('input[name="city"]').val() || null;
                address['street'] = _this.find('input[name="street"]').val() || null;
                address['zip'] = _this.find('input[name="street"]').val() || null;
                address['country'] = _this.find('select').find(':selected').val();
                addresses.push(address);
            })

            return {
                first_name : $('input[name=first_name]').val() || null,
                last_name : $('input[name=last_name]').val() || null,
                email : $('input[name=email]').val() || null,
                birth_date : $('input[name=birth_date]').val() || null,
                photo : $('input[name=avatar_img_name]').val() || null,
                gender : $('input[name=gender]:checked').val() || null,
                location : $('input[name=location]').val() || null,
                company : $('input[name=company]').val() || null,
                job_title : $('input[name=job_title]').val() || null,
                group_id : $(' select[name=group] option:selected').val() || null ,
                tags : $('#tags').val() || null ,
                facebook_link : $('input[name=facebook_link]').val() || null,
                twitter_link : $('input[name=twitter_link]').val() || null,
                linkedin_link : $('input[name=linkedin_link]').val() || null,
                instagram_link : $('input[name=instagram_link]').val() || null,
                phones : phones,
                addresses : addresses
            };

        }


        $("#contact_store").validate({
            validClass: "success",
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                $('.card-body').addClass('is-loading is-loading-primary');
                $('#btn-client-submit').addClass('is-loading disabled')


                url =  API_ENDPOINT + '/contacts';
                method = 'post';
                api(method, url, buildContactData(), function (res) {
                    window.location = res.redirect_to;
                });

                return false;

            }

        });

        $("#contact_update").validate({
            validClass: "success",
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                $('.card-body').addClass('is-loading is-loading-primary');
                $('#btn-client-submit').addClass('is-loading disabled')
                var contact_id =  $('input[name=cid]').val();
                url =  API_ENDPOINT + '/contacts/'+contact_id+'';
                method = 'put';
                api(method, url, buildContactData(), function (res) {
                    window.location = res.redirect_to;
                });

                return false;

            }

        });



    }
    return {
        init : init
    }
}

var groupsIndex = function (){
    var groups_table;
    var init = function () {

        $("#createGroupForm").validate({
            validClass: "success",
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                var formData = {};
                $(form).find("input[name]").each(function (index, node) {
                    formData[node.name] = node.value;
                });
                $(form).find("textarea[name]").each(function (index, node) {
                    formData[node.name] = node.value;
                });
                method = 'post';

                api(method,API_ENDPOINT+'/groups', formData, function () {
                    var url = API_ENDPOINT+'/groups' ;
                    groups_table.ajax.url(url).load();
                    $('#createGroupModal').modal('hide');
                });

                return false;
            }
        });


        $("#editGroupForm").validate({
            validClass: "success",
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                var formData = {};
                $(form).find("input[name]").each(function (index, node) {
                    formData[node.name] = node.value;
                });
                $(form).find("textarea[name]").each(function (index, node) {
                    formData[node.name] = node.value;
                });
                group_id = $('#group_id').val();
                method = 'put';
                api(method, API_ENDPOINT+'/groups/'+group_id, formData, function () {
                    $('#editGroupModal').modal('hide');
                    var url = API_ENDPOINT+'/groups' ;
                    groups_table.ajax.url(url).load();
                });

                return false;
            }
        });


        $('#createGroupModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });

        groups_table = $('#groups_table').DataTable({

            "serverSide": true,
            "ajax": API_ENDPOINT+'/groups',
            rowId: "id",
            "order": [[0, "desc"]],

            columns: [
                {data: 'name',orderable: false,className:'text-job'},
                {data: 'description',orderable: false},
                {data: 'count',orderable: false},
                {
                    data: null, orderable: false, className: 'text-center', render: function (data) {
                        var btn_delete ='<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger delete_group"  data-original-title="Remove">\n' +
                            '<i class="fa fa-trash"></i>\n' +
                            '</button>' ;
                        if(data.can_delete !== 1){
                            btn_delete = '';
                        }
                        return '<div class="form-button-action">' +
                            '<button type="button" class="btn btn-link btn-primary btn-lg edit_item "  data-toggle="tooltip" data-original-title="Edit" data-toggle="modal" data-target="#editGroupModal">\n' +
                            '<i class="fa fa-edit"></i>\n' +
                            '</button>' +
                            ''+btn_delete+''+
                            '</div>';
                    }
                }
            ],

            "fnDrawCallback": function () {
                $('button').tooltip();
                data = groups_table.ajax.json();
                $('.edit_item').on('click', function () {
                    var index = groups_table.row(this.closest('tr')).index();
                    var item = data.data[index];
                    $('#group_id').val(item.id);
                    $('#editName').val(item.name);
                    $('#editDescription').val(item.description);
                    $('#editGroupModal').modal('show');
                });

                $('.delete_group').on('click', function () {
                    var $this = this;
                    var data = groups_table.row($this.closest('tr')).data();


                    Swal.fire({
                        title: 'Are you sure you want to delete:',
                        text: data.name,
                        icon: 'warning',
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        showLoaderOnConfirm: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true,
                        showCancelButton: true,
                        preConfirm: function (){
                            var id = groups_table.row($this.closest('tr')).id();
                            return $.delete('' + API_ENDPOINT + '/groups/' + id + '',function (){

                            }).done(function (res){
                                var ajax_url = RootPath + '/api/groups';
                                groups_table.ajax.url(ajax_url).load();
                                if(res.status){
                                    Swal.fire({
                                        icon: 'success',
                                        text: res.message,
                                        timer: 2000,
                                        confirmButtonText: 'Ok',
                                        timerProgressBar: true,
                                    }).then(function (){
                                        swal.close();
                                    })

                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        text: res.message,
                                        confirmButtonText: 'ok'
                                    })
                                }
                            }).fail(function(res) {
                                Swal.fire({
                                    icon: 'error',
                                    text: res.messsge,
                                    confirmButtonText: 'Ok'
                                })
                            })

                        },

                    })
                });

            }
        });
    };
    return {
        init:init
    }
}

var tagsIndex = function (){
    var tags_table;
    var init = function () {

        $("#createTagForm").validate({
            validClass: "success",
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                var formData = {};
                $(form).find("input[name]").each(function (index, node) {
                    formData[node.name] = node.value;
                });

                method = 'post';
                api(method,API_ENDPOINT+'/tags', formData, function () {
                    $('#createTagModal').modal('hide');
                    var url = API_ENDPOINT+'/tags' ;
                    tags_table.ajax.url(url).load();
                });

                return false;
            }
        });


        $("#editTagForm").validate({
            validClass: "success",
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            submitHandler: function (form) {
                var formData = {};
                $(form).find("input[name]").each(function (index, node) {
                    formData[node.name] = node.value;
                });

                tag_id = $('#tag_id').val();
                method = 'put';
                api(method, API_ENDPOINT+'/tags/'+tag_id, formData, function () {
                    $('#editTagModal').modal('hide');
                    var url = API_ENDPOINT+'/tags' ;
                    tags_table.ajax.url(url).load();
                });

                return false;
            }
        });


        $('#createTagModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });

        tags_table = $('#tags_table').DataTable({

            "serverSide": true,
            "ajax": API_ENDPOINT+'/tags',
            rowId: "id",
            "order": [[0, "desc"]],

            columns: [
                {data: 'name',orderable: false,className:'text-job'},
                {data: 'count',orderable: false},
                {
                    data: null, orderable: false, className: 'text-center', render: function (data) {
                        var btn_delete ='<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger delete_tag"  data-original-title="Remove">\n' +
                            '<i class="fa fa-trash"></i>\n' +
                            '</button>' ;
                        if(data.can_delete !== 1){
                            btn_delete = '';
                        }
                        return '<div class="form-button-action">' +
                            '<button type="button" class="btn btn-link btn-primary btn-lg edit_item "  data-toggle="tooltip" data-original-title="Edit" data-toggle="modal" data-target="#editTagsModal">\n' +
                            '<i class="fa fa-edit"></i>\n' +
                            '</button>' +
                            ''+btn_delete+''+
                            '</div>';
                    }
                }
            ],

            "fnDrawCallback": function () {
                $('button').tooltip();
                data = tags_table.ajax.json();
                $('.edit_item').on('click', function () {
                    var index = tags_table.row(this.closest('tr')).index();
                    var item = data.data[index];
                    $('#tag_id').val(item.id);
                    $('#editName').val(item.name);
                    $('#editTagModal').modal('show');
                });
                $('.delete_tag').on('click', function () {
                    var $this = this;
                    var data = tags_table.row($this.closest('tr')).data();


                    Swal.fire({
                        title: 'Are you sure you want to delete:',
                        text: data.name,
                        icon: 'warning',
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        showLoaderOnConfirm: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true,
                        showCancelButton: true,
                        preConfirm: function (){
                            var id = tags_table.row($this.closest('tr')).id();
                            return $.delete('' + API_ENDPOINT + '/tags/' + id + '',function (){

                            }).done(function (res){
                                var ajax_url = RootPath + '/api/tags';
                                tags_table.ajax.url(ajax_url).load();
                                if(res.status){
                                    Swal.fire({
                                        icon: 'success',
                                        text: res.message,
                                        timer: 2000,
                                        confirmButtonText: 'Ok',
                                        timerProgressBar: true,
                                    }).then(function (){
                                        swal.close();
                                    })

                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        text: res.message,
                                        confirmButtonText: 'ok'
                                    })
                                }
                            }).fail(function(res) {
                                Swal.fire({
                                    icon: 'error',
                                    text: res.messsge,
                                    confirmButtonText: 'Ok'
                                })
                            })

                        },

                    })
                });


            }
        });
    };
    return {
        init:init
    }
}

$('#crop_modal').on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
        viewMode: 1,
        aspectRatio: 1,
        preview: '.img-preview',
        responsive: true
    });
}).on('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
});


function initCropper (default_image,image_to_crop,new_input,target){
    avatar = document.getElementById('' + default_image + '');
    image = document.getElementById('' + image_to_crop + '');
    input = document.getElementById('' + new_input + '');

    $('#crop').attr('onclick', 'cropImage(' + target + ')');

    var files = input.files[0];
    var done = function (url) {
        input.value = '';
        image.src = url;
        $('#crop_modal').modal('show');
    };
    var reader;
    var file;
    var url;


    file = files;

    if (URL) {
        done(URL.createObjectURL(file));
    } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
            done(reader.result);
        };
        reader.readAsDataURL(file);
    }
}
function cropImage(target) {


    var initialAvatarURL;
    var canvas;

    $('#crop_modal').modal('hide');

    if (cropper) {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        var originalData = {};
        originalData = cropper.getCroppedCanvas();

        var formData = new FormData();


        formData.append('image', originalData.toDataURL());
        formData.append('type', 'questions');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax(API_ENDPOINT+'/upload_image', {
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            xhr: function () {
                return  new XMLHttpRequest();

            },

            success: function (data) {
                $('#' + target.id + '').val(data.name)
            },

            error: function () {
                avatar.src = initialAvatarURL;

            },

            complete: function () {

            },
        });

    }
}
