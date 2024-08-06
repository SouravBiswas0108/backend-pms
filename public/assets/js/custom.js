/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(function () {
    commonLoader();
});
$(document).ready(function() {
    var baseUrl = window.location.origin + "/admin/";

    // $('#my-table').find('tr:not(:first)').each(function () {

    //     if (!$(this).find(':checkbox').is(':checked'))
    //         alert('++++');
    //         $('#my-table').append(this);
    // });


    if($('.toggle_activity').attr('data-toggle') == 1){
        $(this).prop('checked', true);
    }else{
        $(this).prop('checked', false);
    }

    $(document).on('change','#role_selecter', function(){
        var role = this.value;
        // console.log(role); return false;
        if(role){
            if(role == 9){
                $('.menu').css("display","block");
                $('.sidebarmenu').css("display","block");
            }else{
                $('.menu').css("display","none");
                $('.sidebarmenu').css("display","none");
            }
        }
    });


    $('#select-all').on('click', function() {
        // e.preventDefault();
        var myArray = $('.selected_staff').val();
        if(myArray !=""){
           myArray = myArray.split(',');

        }else{
            myArray = [];
        }

        $(".sub_chk").prop('checked', $(this).is(':checked'));



        $( '.sub_chk' ).each( function(e) {
            if ($(this).prop('checked') == true){


                if(jQuery.inArray($( this ).val(), myArray) != -1) {
                    console.log("is in array");
                } else {
                    myArray.push($( this ).val())
                }
            }else{
               if(jQuery.inArray($( this ).val(), myArray) != -1) {
                    myArray.splice( $.inArray($( this ).val(), myArray), 1 );
                }
            }
        });
        // console.log(myArray)
        $('.selected_staff').val(myArray);
        console.log(myArray)
    });

    // $( "#datetimepicker1" ).datepicker({  maxDate: new Date() });

    $('.sub_chk').on('click', function() {
        // var newarray = [];
        // $(this).prop('checked', $(this).is(':checked'));

        var already_selected = $('.selected_staff').val();
        if(already_selected !=""){
           already_selected = already_selected.split(',');

        }else{
            already_selected = [];
        }
        console.log(already_selected)
        if ($(this).prop('checked') == true){
            console.log("yes");
            if(jQuery.inArray($( this ).val(), already_selected) != -1) {
                console.log("is in array");
            } else {
                already_selected.push($( this ).val())
            }

        }else{
            console.log("no");
            console.log($( this ).val());
            if(jQuery.inArray($( this ).val(), already_selected) != -1) {
                already_selected.splice( $.inArray($( this ).val(), already_selected), 1 );
            }
            //console.log($( this ).val());

        }
        $('.selected_staff').val(already_selected)
        console.log(already_selected);

    });



    // $('.sub_chk_edit').on('click', function() {
    //     var checkboxes = document.querySelectorAll("input[type=checkbox]");
    //     var checked = [];

    //     for (var i = 0; i < checkboxes.length; i++) {
    //         var checkbox = checkboxes[i];
    //         if (checkbox.checked)
    //         checked.push(checkbox.value);
    //     }
    //     $('.selected_staff_edit').val(checked);
    //     console.log(checked);
    // });






    var previousSupervisorData = [];
    var previousOfficerData = [];

    $('.supervisor_name').on('change', function() {
        $('.officer_name').children('option').show();
        var selectedSupervisor = this.value;
        var exists = 0 != $('.officer_name option[value='+selectedSupervisor+']').length;
        var exists = false;
        if(previousSupervisorData != ''){
            $('.officer_name option').each(function(){
                if (this.value == selectedSupervisor) {
                    exists = true;
                    $(".officer_name").children("option[value^=" + previousSupervisorData + "]").show();
                    return false;
                }
            });
        }
        $('.officer_name option').each(function(){
            if (this.value == selectedSupervisor) {
                exists = true;
                previousSupervisorData = selectedSupervisor;
                $(".officer_name").children("option[value^=" + selectedSupervisor + "]").hide();
                return false;
            }
        });
        // var valuetake = $('.supervisor_name').val();
        // if(valuetake !=""){
        //     console.log(valuetake);
        //  $('#dept_officer_name').val(valuetake);
        // }
        // console.log(valuetake);
    });


    $('.officer_name').on('change', function() {
        $('.supervisor_name').children('option').show();
        var selectedOffisor = this.value;
        var Oexists = 0 != $('.supervisor_name option[value='+selectedOffisor+']').length;
        var Oexists = false;
        if(previousOfficerData != ''){
            $('.supervisor_name option').each(function(){
                if (this.value == selectedOffisor) {
                    Oexists = true;
                    $(".supervisor_name").children("option[value^=" + previousOfficerData + "]").show();
                    return false;
                }
            });
        }else{
                $('.supervisor_name option').each(function(){
                if (this.value == selectedOffisor) {
                    Oexists = true;
                    previousOfficerData = selectedOffisor;
                    $(".supervisor_name").children("option[value^=" + selectedOffisor + "]").hide();
                    return false;
                }
            });
        }
    });



    $('.assign_infos').on('change', function() {
        var assign_infos = this.value;
        var user_id = $("#staff_id").val();
        // console.log(assign_infos);
        $.ajax({
            type: "POST",
            url: baseUrl+"checkUserDutiesExist",
            data: {
                'assign_infos': assign_infos,
                'user_id': user_id,
            },
            dataType: "json",
            success: function (response) {
                // console.log(response); return false;
                if(response.success == 1 && response.duties != ''){
                    tinyMCE. activeEditor. setContent(response.duties);
                }else{
                    tinymce.get('full-featured-non-premium').setContent('');
                }
            },
            error: function (request, status, error) {
                console.log(request);
            }
        });
    });


    $('.next').on('click', function(e) {
        // e.preventDefault();
        if($('#dept_name').val() == ''){
            $('.requireNameMsg').show();
        }else{
            $('.requireNameMsg').hide();
            $('.step_1').hide();
            $('.step_2').show();
        }
    });

    $('.click_fpswrd').on('click', function(e) {
        // e.preventDefault();
        $('.error_msg_fpswrd').show();
    });

    // var fileInput = document.getElementById("csv"),

    //     readFile = function () {
    //         var reader = new FileReader();
    //         reader.onload = function () {
    //             document.getElementById('out').innerHTML = reader.result;
    //         };
    //         // start reading the file. When it is done, calls the onload event defined above.
    //         reader.readAsBinaryString(fileInput.files[0]);
    //     };

    // fileInput.addEventListener('change', readFile);


    // $("#create_user").click(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "/pages/test/",
    //         data: {
    //             id: $(this).val(), // < note use of 'this' here
    //             access_token: $("#access_token").val()
    //         },
    //         success: function(result) {
    //             alert('ok');
    //         },
    //         error: function(result) {
    //             alert('error');
    //         }
    //     });
    // });

    // $('#dept_submit').on('click', function(e) {
    //     // e.preventDefault();
    //     if($('#selected_staff').val() == ''){
    //         $('.requireStaffMsg').show();
    //     }else{
    //         $('.requireStaffMsg').hide();
    //         // $('.step_1').hide();
    //         // $('.step_2').show();
    //     }


    // });
    // var checkboxes = $(".sub_chk"),
    // submitButt = $("#dept_submit");

    // checkboxes.click(function() {
    //     submitButt.attr("disabled", !checkboxes.is(":checked"));
    // });

    $('.back').on('click', function(e) {
        // e.preventDefault();
        $('.step_2').hide();
        $('.step_1').show();
    });


    $('.clickme').click(function() {
       // if(confirm("Are you sure you want to navigate away from this page?"))
       // {
          history.go(-1);
       // }
       return false;
    });


    $(document).on('click', "#edit-item", function() {
        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        //     var supervisor_name = $('.supervisor_name').val();
        //     var officer_name = $('.officer_name').val();
        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal').modal(options)

    })





    // on modal show
    $('#edit-modal').on('show.bs.modal', function() {

        var el = $(".edit-item-trigger-clicked");
        // alert(el); // See how its usefull right here?
        var row = el.closest(".data-row");
        // alert(row);

        // get the data
        var id = el.data('item-id');
        var name = row.children(".dept_name").text();
        // alert(name);
        // console.log(name);
        // return false;
        var description = row.children(".description").text();

        // fill the data in the input fields
        $("#modal-input-id").val(id);
        $("#modal-input-name").val(name);
        $("#modal-input-description").val(description);


         var dept_name = $('#dept_name').val();
         var officer_name = jQuery(".officer_name option:selected").text();
         var supervisor_name = jQuery(".supervisor_name option:selected").text();
         // alert(officer_name);
         // alert(supervisor_name);
         // var dept_name = $('#dept_name').val();
         localStorage.setItem(dept_name,dept_name);
         localStorage.setItem(officer_name,officer_name);
         localStorage.setItem(supervisor_name,supervisor_name);
        $('#modal-dept_name').val(localStorage.getItem(dept_name));
        $('#modal-officer_name').val(localStorage.getItem(officer_name));
        $('#modal-supervisor_name').val(localStorage.getItem(supervisor_name));

    })


     // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    });
    $('.close_new').on('click', function(e) {
        // e.preventDefault();
        $('.modal_pre').hide();
        // $('.step_1').show();
    });

});

var baseUrl = window.location.origin + "/admin/";

jQuery(document).on('click', '.toggle_activity',function(){
    // alert('+++++');
    var togg = $(this);
    var user_table_id = atob($(this).val());
    var toggle_activity_Value = $(this).attr('data-toggle');
    if(confirm("Do you really want to change the activity of this User?")){
        jQuery.ajax({
            url: baseUrl+'userstatus',
            data:{
                'user_table_id' : user_table_id,
                'toggle_activity_Value' : toggle_activity_Value,
            },
            type: "POST",
            dataType: "json",
            success: function(response) {
                // console.log(response); return false;
                if(response.success == 1){
                    if(response.db_status == 1){
                        // $(this).prop('checked', false);
                        togg.prop('checked', true);
                    }else{
                        togg.prop('checked', false);
                    }
                    var next_activity_value = toggle_activity_Value == '0' ? 1:0;
                    togg.attr('data-toggle',next_activity_value);
                    // window.location.reload();
                }
            },
            error : function(response){
                console.log("Error");
            },
        });
    }
});


$(document).on('click', '#create_user_btn', function (e) {
   
    e.preventDefault();
    var staff_id = $('#staff_id').val();

    $('[name="ippis_no"]').next('span').html('');
    $('[name="fname"]').next('span').html('');
    $('[name="lname"]').next('span').html('');
    $('[name="date_of_current_posting"]').next('span').html('');
    $('.errorgender').html('');
    $('.error_org_name').html('');
    $('.error_grade').html('');
    $('.error_role').html('');
    $('[name="email"]').next('span').html('');
    $('[name="phone"]').next('span').html('');
    $('[name="password"]').next('span').html('');
    $('[name="recovery_email"]').next('span').html('');

    $.ajax({
        type: "POST",
        url: baseUrl+"users",
        data: $("#create_user_form").serialize(),
        dataType: "json",
        success: function (response) {
            console.log(response);
            if(response.success == 1 ){
                show_toastr('Success', 'User Created Successfully!', 'success')
                window.location.reload();
            }
            if(response.success == 0 ){
                show_toastr('Error', 'Permission Denied.', 'error')
                window.location.reload();
            }

        },
        error: function (request, status, error) {
            console.log(request);
            if (request.status == 401) {

                $('[name="ippis_no"]').next('span').html(request.responseJSON.error.ippis_no);
                $('[name="fname"]').next('span').html(request.responseJSON.error.fname);
                $('[name="lname"]').next('span').html(request.responseJSON.error.lname);
                $('[name="email"]').next('span').html(request.responseJSON.error.email);
                $('[name="phone"]').next('span').html(request.responseJSON.error.phone);
                $('[name="password"]').next('span').html(request.responseJSON.error.password);
                $('[name="date_of_current_posting"]').next('span').html(request.responseJSON.error.date_of_current_posting);
                $('.errorgender').html(request.responseJSON.error.gender);
                $('.error_org_name').html(request.responseJSON.error.org_code);
                $('.error_grade').html(request.responseJSON.error.grade_level);
                $('.error_role').html(request.responseJSON.error.role);
                $('.error_recovery_email').html(request.responseJSON.error.recovery_email);
            }else{

            }
        }
    });
    // show_toastr('Error', 'The ippis no field is required.', 'error')
});




$(document).on('click', '#edit_user_btn', function (e) {
    e.preventDefault();
    var staff_id = $('#staff_id').val();

    $('[name="ippis_no"]').next('span').html('');
    $('[name="fname"]').next('span').html('');
    $('[name="lname"]').next('span').html('');
    $('[name="phone"]').next('span').html('');
    $('[name="date_of_current_posting"]').next('span').html('');
    $('.errorgender').html('');
    $('.error_grade').html('');
    $('.error_org_name').html('');
    $('.error_role').html('');
    $('[name="recovery_email"]').next('span').html('');
    
    $.ajax({
        type: "POST",
        url: baseUrl+"users/"+staff_id,
        data: $("#edit_user_form").serialize(),
        dataType: "json",
        success: function (response) {
            // console.log(response);

            if(response.success == 1 ){
                show_toastr('Success', 'User Updated Successfully!', 'success')
                window.location.reload();
            }
            if(response.error == 1 ){
                show_toastr('Error', 'Invalid User!', 'error')
                window.location.reload();
            }
            if(response.error == 2 ){
                show_toastr('Error', 'Permission Denied.', 'error')
                window.location.reload();
            }
        },
        error: function (request, status, error) {
            if (request.status == 401) {
                $('[name="ippis_no"]').next('span').html(request.responseJSON.error.ippis_no);
                $('[name="fname"]').next('span').html(request.responseJSON.error.fname);
                $('[name="lname"]').next('span').html(request.responseJSON.error.lname);
                $('[name="phone"]').next('span').html(request.responseJSON.error.phone);
                $('[name="date_of_current_posting"]').next('span').html(request.responseJSON.error.date_of_current_posting);
                $('.errorgender').html(request.responseJSON.error.gender);
                $('.error_grade').html(request.responseJSON.error.grade_level);
                $('.error_org_name').html(request.responseJSON.error.org_code);
                $('.error_role').html(request.responseJSON.error.role);
                $('.error_recovery_email').html(request.responseJSON.error.recovery_email);
            }else{

            }
        }
    });
    // show_toastr('Error', 'The ippis no field is required.', 'error')
});



$('#csvdata').on('hidden.bs.modal', function () {
    $('#csv').val(null);
});

$(document).on('change', '#csv', function(event){
    // alert('test');
    var fd = new FormData();
    // var formData = new FormData(jQuery('form[name="plannedaudit"]')[0]);
    fd.append('file', this.files[0]); // since this is your file input
    if(this.files && this.files[0]){
        $.ajax({
            type: "POST",
            url: baseUrl+"userCreateFromCsv",
            data: fd,
            dataType: "json",
            processData: false, // important
            contentType: false, // important
            success: function (response) {
                console.log(response);
                var trowhtml ="";
                if(response.success == 1 ){
                    jQuery('#tablerow').dataTable().fnClearTable();
                    $.each(response.allrows , function(index, row) {
                        // console.log(index);
                        // console.log(row);
                        jQuery('#tablerow').dataTable().fnAddData([
                            "<input type='checkbox' name='json_allrows_checkbox[]' class='checkboxID' id='checkboxID_"+index+"' value="+index+">",
                            row.ippis_no,
                            row.staff_id,
                            row.fname,
                            row.lname,
                            row.email,
                            row.password,
                            row.org_code,
                            row.gender,
                            row.date_of_current_posting,
                            row.type,
                        ]);
                    });
                    $('#csvdata').modal('show');

                    $('.json_allrows').val(response.json_allrows);
                }
                if(response.error == 1){
                    show_toastr('Error', response.message, 'error')
                    // window.location.reload();
                }
                if(response.error == 2){
                    show_toastr('Error', 'Your CSV files having empty values in some Columns ...Your columns must be in this sequence <strong> staff_id, fname, lname, email, password, org_code, gender, date_of_current_posting, type, ippis_no </strong>!', 'error')
                    // window.location.reload();
                }
            },
            error: function (request, status, error) {
                // console.log('request');return false;
            }
        });
    }

});


$('#select_all_user').on('click', function() {
    $(".checkboxID").prop('checked', $(this).is(':checked'));
});


$(document).on('click', '#create_bulkuser_btn', function (e) {
    e.preventDefault();

    var formData = new FormData(jQuery('#csv_form_id_new')[0]);
    // alert(formData);
    // return false;
    $.ajax({
        type: "POST",
        url: baseUrl+"Create_bulkuser",
        data: formData,
        dataType: "json",
        processData: false, // important
        contentType: false, // important
        success: function (response) {
            // return false;
            // console.log('response');return false;

            if(response.success == 1 ){
                if(response.notinserted==0){
                    // show_toastr('Error', response.notinserted+' '+'User are not inerted !', 'error');
                    setTimeout(function(){
                       show_toastr('Success', 'User List Uploded Successfully!', 'success');
                    }, 1000);

                }else{
                    show_toastr('Error', response.notinserted+' '+'User are not inerted !', 'error');
                    setTimeout(function(){
                       show_toastr('Success', 'Remaining user Uploded Successfully!', 'success');
                    }, 1000);

                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);

                }

                // window.location.reload();
            }
            if(response.error == 1 ){
                show_toastr('Error', response.notinserted+' '+'User are not inerted !', 'error')
                setTimeout(function(){
                    window.location.reload();
                }, 3000);


            }

        },
        error: function (request, status, error) {
            // console.log('request');return false;
        }
    });
    // show_toastr('Error', 'The ippis no field is required.', 'error')
});


$(".usertypeClass").hover(
    function ()
    {
        var details = $(this).attr('details');
        $("#"+details).toggle();
    });

function show_toastr(title, message, type) {
    var o, i;
    var icon = '';
    var cls = '';

    if (type == 'success') {
        icon = 'fas fa-check-circle';
        cls = 'success';
    } else {
        icon = 'fas fa-times-circle';
        cls = 'danger';
    }

    $.notify({icon: icon, title: " " + title, message: message, url: ""}, {
        element: "body",
        type: cls,
        allow_dismiss: !0,
        placement: {
            from: 'top',
            align: toster_pos
        },
        offset: {x: 15, y: 15},
        spacing: 10,
        z_index: 1080,
        delay: 2500,
        timer: 2000,
        url_target: "_blank",
        mouse_over: !1,
        animate: {enter: o, exit: i},
        template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    });
}

$(document).on('click', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]', function () {
    var title = $(this).data('title');
    var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
    var url = $(this).data('url');

    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);

    $.ajax({
        url: url,
        success: function (data) {
            $('#commonModal .modal-body').html(data);
            $("#commonModal").modal('show');
            commonLoader();
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr('Error', data.error, 'error')
        }
    });

});

$(document).on('click', 'a[data-ajax-popup-over="true"], button[data-ajax-popup-over="true"], div[data-ajax-popup-over="true"]', function () {

    var title = $(this).data('title');
    var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
    var url = $(this).data('url');

    $("#commonModalOver .modal-title").html(title);
    $("#commonModalOver .modal-dialog").addClass('modal-' + size);

    $.ajax({
        url: url,
        success: function (data) {
            $('#commonModalOver .modal-body').html(data);
            $("#commonModalOver").modal('show');
            commonLoader();
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr('Error', data.error, 'error')
        }
    });

});

function arrayToJson(form) {
    var data = $(form).serializeArray();
    var indexed_array = {};

    $.map(data, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

$(document).on("submit", "#commonModalOver form", function (e) {
    e.preventDefault();
    var data = arrayToJson($(this));
    data.ajax = true;

    var url = $(this).attr('action');
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (data) {
            show_toastr('Success', data.success, 'success');
            $(data.target).append('<option value="' + data.record.id + '">' + data.record.name + '</option>');
            $(data.target).val(data.record.id);
            $(data.target).trigger('change');
            $("#commonModalOver").modal('hide');
            commonLoader();
        },
        error: function (data) {
            data = data.responseJSON;
            show_toastr('Error', data.error, 'error')
        }
    });
});

(function ($, window, i) {
    // Bootstrap 4 Modal
    $.fn.fireModal = function (options) {
        var options = $.extend({
            size: 'modal-md',
            center: false,
            animation: true,
            title: 'Modal Title',
            closeButton: false,
            header: true,
            bodyClass: '',
            footerClass: '',
            body: '',
            buttons: [],
            autoFocus: true,
            created: function () {
            },
            appended: function () {
            },
            onFormSubmit: function () {
            },
            modal: {}
        }, options);
        this.each(function () {
            i++;
            var id = 'fire-modal-' + i,
                trigger_class = 'trigger--' + id,
                trigger_button = $('.' + trigger_class);
            $(this).addClass(trigger_class);
            // Get modal body
            let body = options.body;
            if (typeof body == 'object') {
                if (body.length) {
                    let part = body;
                    body = body.removeAttr('id').clone().removeClass('modal-part');
                    part.remove();
                } else {
                    body = '<div class="text-danger">Modal part element not found!</div>';
                }
            }
            // Modal base template
            var modal_template = '   <div class="modal' + (options.animation == true ? ' fade' : '') + '" tabindex="-1" role="dialog" id="' + id + '">  ' +
                '     <div class="modal-dialog ' + options.size + (options.center ? ' modal-dialog-centered' : '') + '" role="document">  ' +
                '       <div class="modal-content">  ' +
                ((options.header == true) ?
                    '         <div class="modal-header">  ' +
                    '           <h5 class="modal-title mx-auto">' + options.title + '</h5>  ' +
                    ((options.closeButton == true) ?
                        '           <button type="button" class="close" data-dismiss="modal" aria-label="Close">  ' +
                        '             <span aria-hidden="true">&times;</span>  ' +
                        '           </button>  '
                        : '') +
                    '         </div>  '
                    : '') +
                '         <div class="modal-body text-center text-dark">  ' +
                '         </div>  ' +
                (options.buttons.length > 0 ?
                    '         <div class="modal-footer mx-auto">  ' +
                    '         </div>  '
                    : '') +
                '       </div>  ' +
                '     </div>  ' +
                '  </div>  ';
            // Convert modal to object
            var modal_template = $(modal_template);
            // Start creating buttons from 'buttons' option
            var this_button;
            options.buttons.forEach(function (item) {
                // get option 'id'
                let id = "id" in item ? item.id : '';
                // Button template
                this_button = '<button type="' + ("submit" in item && item.submit == true ? 'submit' : 'button') + '" class="' + item.class + '" id="' + id + '">' + item.text + '</button>';
                // add click event to the button
                this_button = $(this_button).off('click').on("click", function () {
                    // execute function from 'handler' option
                    item.handler.call(this, modal_template);
                });
                // append generated buttons to the modal footer
                $(modal_template).find('.modal-footer').append(this_button);
            });
            // append a given body to the modal
            $(modal_template).find('.modal-body').append(body);
            // add additional body class
            if (options.bodyClass) $(modal_template).find('.modal-body').addClass(options.bodyClass);
            // add footer body class
            if (options.footerClass) $(modal_template).find('.modal-footer').addClass(options.footerClass);
            // execute 'created' callback
            options.created.call(this, modal_template, options);
            // modal form and submit form button
            let modal_form = $(modal_template).find('.modal-body form'),
                form_submit_btn = modal_template.find('button[type=submit]');
            // append generated modal to the body
            $("body").append(modal_template);
            // execute 'appended' callback
            options.appended.call(this, $('#' + id), modal_form, options);
            // if modal contains form elements
            if (modal_form.length) {
                // if `autoFocus` option is true
                if (options.autoFocus) {
                    // when modal is shown
                    $(modal_template).on('shown.bs.modal', function () {
                        // if type of `autoFocus` option is `boolean`
                        if (typeof options.autoFocus == 'boolean')
                            modal_form.find('input:eq(0)').focus(); // the first input element will be focused
                        // if type of `autoFocus` option is `string` and `autoFocus` option is an HTML element
                        else if (typeof options.autoFocus == 'string' && modal_form.find(options.autoFocus).length)
                            modal_form.find(options.autoFocus).focus(); // find elements and focus on that
                    });
                }
                // form object
                let form_object = {
                    startProgress: function () {
                        modal_template.addClass('modal-progress');
                    },
                    stopProgress: function () {
                        modal_template.removeClass('modal-progress');
                    }
                };
                // if form is not contains button element
                if (!modal_form.find('button').length) $(modal_form).append('<button class="d-none" id="' + id + '-submit"></button>');
                // add click event
                form_submit_btn.click(function () {
                    modal_form.submit();
                });
                // add submit event
                modal_form.submit(function (e) {
                    // start form progress
                    form_object.startProgress();
                    // execute `onFormSubmit` callback
                    options.onFormSubmit.call(this, modal_template, e, form_object);
                });
            }
            $(document).on("click", '.' + trigger_class, function () {
                $('#' + id).modal(options.modal);
                return false;
            });
        });
    }
    // Bootstrap Modal Destroyer
    $.destroyModal = function (modal) {
        modal.modal('hide');
        modal.on('hidden.bs.modal', function () {
        });
    }
})(jQuery, this, 0);

$('[data-confirm]').each(function () {
    var me = $(this),
        me_data = me.data('confirm');

    me_data = me_data.split("|");
    me.fireModal({
        title: me_data[0],
        body: me_data[1],
        buttons: [
            {
                text: me.data('confirm-text-yes') || 'Yes',
                class: 'btn btn-sm btn-danger rounded-pill',
                handler: function () {
                    eval(me.data('confirm-yes'));
                }
            },
            {
                text: me.data('confirm-text-cancel') || 'Cancel',
                class: 'btn btn-sm btn-secondary rounded-pill',
                handler: function (modal) {
                    $.destroyModal(modal);
                    eval(me.data('confirm-no'));
                }
            }
        ]
    })
});


function commonLoader() {
    if ($(".datepicker").length) {
        $('.datepicker').daterangepicker({
            locale: date_picker_locale,
            singleDatePicker: true,
        });
    }

    if ($(".daterange-picker").length) {
        $('.daterange-picker').daterangepicker({
            locale: date_picker_locale,
        });
    }
    if ($(".select2").length) {
        $(".select2").select2({
            disableOnMobile: false,
            nativeOnMobile: false
        });
    }

    if ($(".summernote-simple").length) {
        $('.summernote-simple').summernote({
            dialogsInBody: !0,
            minHeight: 200,
            toolbar: [
                ['style', ['style']],
                ["font", ["bold", "italic", "underline", "clear", "strikethrough"]],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ["para", ["ul", "ol", "paragraph"]],
            ]
        });
    }

    if ($(".jscolor").length) {
        jscolor.installByClassName("jscolor");
    }

    // for Choose file
    $(document).on('change', 'input[type=file]', function () {
        var fileclass = $(this).attr('data-filename');
        var finalname = $(this).val().split('\\').pop();
        $('.' + fileclass).html(finalname);
    });
}

$(document).ready(function(){
    //alert('hi');
    var selectedValue = $('.disable_select').val();
      if(selectedValue.length !== 0 )
      {
        $('.officer_name').prop("disabled",false);
      }
        $('.disable_select').on('select2:select', function (e) {
            var data = e.params.data;
         // console.log(data.id);
          var id=data.id;
          var optionToDisable = $('.officer_name option[value="'+id+'"]');
          optionToDisable.prop('class', 'block-option-color');

// Add the "disabled" attribute
         optionToDisable.attr('disabled', true);
            $('.officer_name').prop("disabled",false);


     });
     $('.disable_select').on('select2:unselect', function (e) {

        var selectedValue = $('.disable_select').val();

        if(selectedValue.length === 0 )
        {
            $('.officer_name').attr("disabled",true);
        }
        var data = e.params.data;
          //console.log(data);

          var optionToEnable = $('.officer_name option[value="'+data.id+'"]');
          optionToEnable.attr('disabled', false);
           optionToEnable.removeClass('block-option-color');
     });


});
$(document).ready(function() {
    let year = $('.year-filter').val();
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add the CSRF token to the headers
        }
      });
    $.ajax({
      url: baseUrl+'yearfilterSessionSave',
      type: 'POST',
      data: { year: year },
      success: function(response) {
        console.log(response); // Output the response to the console
      },
      error: function() {
        console.log('An error occurred.');
      }
    });

$('.year-filter').on('change', function() {
    // Get the new value of the input element
    var year = $(this).val();
   
    // Send AJAX request
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add the CSRF token to the headers
        }
      });

    $.ajax({
        url: baseUrl+'yearfilterSessionSave',
        type: 'POST',
        data: { year: year },
        success: function(response) {
          console.log(response); // Output the response to the console
          location.reload();
        },
        error: function() {
          console.log('An error occurred.');
        }
      });
     
            // Handle response data
            //console.log(data);

     });
    });
    
    $(document).ready(function () {
        var no_dept=$('#no_dept').val();
        if(no_dept==1)
        {
          $('#no_department').modal('show');
              // Get the modal element
          var modal = $('#no_department');
  
          // Get the buttons in the modal
          var yesButton = modal.find('#yesButton');
          var noButton = modal.find('#noButton');
          var token = $('meta[name="csrf-token"]').attr('content');
          // Attach event listeners to the buttons
          yesButton.click(function() {
              //show_toastr('Success','hi','success');
              $.ajax({
                  type: "get",
                  url: "/admin/Department_copy",
                  success: function(response) {
                   //  window.location.href = response.url;
                     if(response.success==1)
                     {
                      show_toastr('Success',response.message, 'success');
                      location.reload();
                     }
                     else if(response.error==1)
                     {
                      show_toastr('Error',response.message, 'error');
  
                     }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error:", errorThrown);
                  }
                });
              modal.modal('hide');
          });
  
          noButton.click(function() {
              modal.modal('hide');
          });
  
          // Show the modal
           //modal.modal('show');
      }
           });

        // Submit the form when the "Save" button is clicked
    $("#finalFormSubBtn").on("click", function(e) {
        e.preventDefault();
        // alert("Dd");
        // Create a FormData object to send the form data
        var form = $("#finalForm");
        var formData = new FormData(form[0]);
        console.log(form.attr("action"));
        // Submit the form with AJAX
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: form.attr("method"),
            url: form.attr("action"),
            data: formData,
            processData: false, // Prevent jQuery from processing data
            contentType: false, // Ensure the content type is set to false
            success: function(response) {
                // Check for success or error message in the JSON response
                if(response.success == 1)
                {
                    window.location.href= baseUrl+"/admin/mpms_form";
                }else if (response.errors) {

                    // console.log(response.errors);
                    $.each(response.errors, function (key, value) {
                        var formattedKey = key.replace('.', '[').replace(/\.|]$/g, ']');
                        var index = formattedKey.charAt(11);
                        let regex = new RegExp(`(objactives\\[${index}\\])`, "g");
                        let modifiedString = formattedKey.replace(regex, "$1[") + "]";


                       console.log(modifiedString);

                        var field = form.find('[name="' + modifiedString + '"]');
                        field.addClass('is-invalid'); // Add a class to highlight the field
                        field.after('<span class="invalid-feedback">This field is required</span>');
                    });
                }
            }
        });
    });


   $(window).on('load', function() {
        $("#loader-container").fadeOut(500);
    });

    // Show loader when the page starts loading
    $(document).ready(function() {
        $("#loader-container").show();
    });
