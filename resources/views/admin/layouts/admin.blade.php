@php
    $logo=asset(Storage::url('logo/'));
    $favicon=Utility::getValByName('company_favicon');
    $SITE_RTL = env('SITE_RTL');
    if($SITE_RTL == ''){
        $SITE_RTL = 'off';
    }

@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$SITE_RTL == 'on'?'rtl':''}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') &dash; {{(Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name', 'LeadGo')}}</title>

    <!-- <link rel="icon" href="{{$logo.'/'.(isset($favicon) && !empty($favicon)?$favicon:'favicon.png')}}" type="image"> -->
    <link rel="icon" href="{{ asset('/public/storage/logo/favicon.png')}}" type="image">

    @stack('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{ asset('/public/assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('/public/assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/libs/animate.css/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/public/assets/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/libs/select2/dist/css/select2.min.css') }}">

    @if($SITE_RTL=='on')
        <link rel="stylesheet" href="{{ asset('/public/css/bootstrap-rtl.css') }}">
    @endif
    <meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">

    {{-- scripts --}}
    <script src="{{ asset('/public/js/chatify/autosize.js') }}"></script>
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
    {{-- styles --}}
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
</head>

<body class="application application-offset">

<div class="container-fluid container-application">
    @include('partials.admin.navbar')
    <div class="main-content position-relative">
        @include('partials.admin.topbar')
        <div class="page-content">
            <div class="page-title">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                        <div class="d-inline-block">
                            <h5 class="h4 d-inline-block font-weight-400 mb-0 ">@yield('title')</h5>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                        @yield('action-button')
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        @include('partials.admin.footer')
    </div>
</div>

<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div>
                <h4 class="h4 font-weight-400 float-left modal-title"></h4>
                <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close">{{__('Close')}}</a>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<div id="omnisearch" class="omnisearch">
    <div class="container">
        <div class="omnisearch-form">
            <div class="form-group">
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control search_keyword" placeholder="{{__('Type and search ...')}}">
                </div>
            </div>
        </div>
        <div class="omnisearch-suggestions">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled mb-0 search-output text-sm">
                        <li>
                            <a class="list-link pl-4" href="#">
                                <i class="fas fa-search"></i>
                                <span>{{__('Type and search ...')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{asset('/public/assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/site.core.js') }}"></script>
<script src="{{ asset('/public/assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
<script src="{{ asset('/public/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('/public/assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('/public/assets/js/site.js') }}"></script>
<script src="{{ asset('/public/assets/js/datatables.min.js') }}"></script>
<script src="{{ asset('/public/assets/libs/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('/public/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{asset('/public/assets/libs/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/jquery.form.js')}}"></script>


<script type="text/javascript" src="{{asset('/public/assets/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    tinymce.init({
        selector: 'textarea#full-featured-non-premium',
        height: 400,
        plugins: 'lists, link, image, media',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist forecolor backcolor | link image media | removeformat help',
        menubar: false,
    });
</script>









@include('Chatify::layouts.footerLinks')
@if(Utility::getValByName('gdpr_cookie') == 'on')
    <script type="text/javascript">

        var defaults = {
            'messageLocales': {
                /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
                'en': "{{Utility::getValByName('cookie_text')}}"
            },
            'buttonLocales': {
                'en': 'Ok'
            },
            'cookieNoticePosition': 'bottom',
            'learnMoreLinkEnabled': false,
            'learnMoreLinkHref': '/cookie-banner-information.html',
            'learnMoreLinkText': {
                'it': 'Saperne di più',
                'en': 'Learn more',
                'de': 'Mehr erfahren',
                'fr': 'En savoir plus'
            },
            'buttonLocales': {
                'en': 'Ok'
            },
            'expiresIn': 30,
            'buttonBgColor': '#d35400',
            'buttonTextColor': '#fff',
            'noticeBgColor': '#051c4b',
            'noticeTextColor': '#fff',
            'linkColor': '#009fdd'
        };
    </script>
    <script src="{{ asset('/assets/js/cookie.notice.js')}}"></script>
@endif

{{-- Pusher JS--}}
@if(\Auth::user()->type != 'Super Admin')
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>


    <script>
        // $(document).ready(function () {
        //     pushNotification('{{ Auth::id() }}');
        //     $('.dev').select2();
        // });

        function pushNotification(id) {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                forceTLS: true
            });

            // Pusher Notification
            var channel = pusher.subscribe('send_notification');
            channel.bind('notification', function (data) {
                if (id == data.user_id) {
                    $(".notification-toggle").addClass('beep');
                    $(".notification-dropdown #notification-list").prepend(data.html);
                    $(".notification-dropdown #notification-list-mini").prepend(data.html);
                }
            });

            // Pusher Message
            var msgChannel = pusher.subscribe('my-channel');
            msgChannel.bind('my-chat', function (data) {
                if (id == data.to) {
                    getChat();
                }
            });
        }

        // Mark As Read Notification
        $(document).on("click", ".mark_all_as_read", function () {
            $.ajax({
                url: '{{route('notification.seen',\Auth::user()->id)}}',
                type: "get",
                cache: false,
                success: function (data) {
                    $('.notification-dropdown #notification-list').html('');
                    $(".notification-toggle").removeClass('beep');
                    $('.notification-dropdown #notification-list-mini').html('');
                }
            })
        });

        // Get chat for top ox
        // function getChat() {
        //     $.ajax({
        //         url: '{{route('message.data')}}',
        //         type: "get",
        //         cache: false,
        //         success: function (data) {
        //             if (data.length != 0) {
        //                 $(".message-toggle-msg").addClass('beep');
        //                 $(".dropdown-list-message-msg").html(data);
        //             }
        //         }
        //     })
        // }

        // getChat();

        $(document).on("click", ".mark_all_as_read_message", function () {
            $.ajax({
                url: '{{route('message.seen')}}',
                type: "get",
                cache: false,
                success: function (data) {
                    $('.dropdown-list-message-msg').html('');
                    $(".message-toggle-msg").removeClass('beep');
                }
            })
        });

        var date_picker_locale = {
            format: 'YYYY-MM-DD',
            daysOfWeek: [
                "{{__('Su')}}",
                "{{__('Mon')}}",
                "{{__('Tue')}}",
                "{{__('Wed')}}",
                "{{__('Thu')}}",
                "{{__('Fri')}}",
                "{{__('Sat')}}"
            ],

            monthNames: [
                "{{__('January')}}",
                "{{__('February')}}",
                "{{__('March')}}",
                "{{__('April')}}",
                "{{__('May')}}",
                "{{__('June')}}",
                "{{__('July')}}",
                "{{__('August')}}",
                "{{__('September')}}",
                "{{__('October')}}",
                "{{__('November')}}",
                "{{__('December')}}"
            ],
        };

    </script>
@endif


<script>
    var toster_pos="{{$SITE_RTL =='on' ?'left' : 'right'}}";
</script>
<script src="{{ asset('/public/assets/js/new-custom.js')}}"></script>

@if ($message = Session::get('success'))
    <script>show_toastr('Success', '{!! $message !!}', 'success')</script>
@endif

@if ($message = Session::get('error'))
    <script>show_toastr('Error', '{!! $message !!}', 'error')</script>
@endif

@if ($message = Session::get('info'))
    <script>show_toastr('Info', '{!! $message !!}', 'info')</script>
@endif

<script>
    var calender_header = {
        today: '{{__('today')}}',
        month: '{{__('month')}}',
        week: '{{__('week')}}',
        day: '{{__('day')}}',
        list: '{{__('list')}}'
    };

    var chart_keyword = [
        "{{__('Wed')}}",
        "{{__('Tue')}}",
        "{{__('Mon')}}",
        "{{__('Sun')}}",
        "{{__('Sat')}}",
        "{{__('Fri')}}",
        "{{__('Thu')}}",
    ];
</script>

@stack('script')

<script>
    $(document).ready(function () {
      if ($('.dataTable').length > 0) {
           if (!$.fn.DataTable.isDataTable('.dataTable') ) {
               
            $(".dataTable").dataTable({
                language: {
                    "lengthMenu": "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    "zeroRecords": "{{__('No data available in table')}}",
                    "info": "{{__('Showing page')}} _PAGE_ {{__('of')}} _PAGES_",
                    "infoEmpty": "{{__('No page available')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                    "paginate": {
                        "previous": "{{__('Previous')}}",
                        "next": "{{__('Next')}}",
                        "last": "{{__('Last')}}"
                    }
                },
                "aaSorting": [],
                order: [[0, 'desc']],

                aoColumnDefs : [
                    {"orderable": false, "bSortable": false, "aTargets": [ 0, 1 ] },
           
                ],

                // { orderable: false, targets: [0,1], bSortable: false}
                drawCallback: function(){
                    $('.paginate_button:not(.disabled)', this.api().table().container())
                    .on('click', function(){
                        var status = 0;

                            $( '.sub_chk' ).each( function(e) {
                                if ($(this).prop('checked') == true){
                                    status = 1;
                                }else{
                                  $('#select-all').prop('checked',false);
                                  return false;
                                }
                            });
                            if(status == 1){
                                $('#select-all').prop('checked',true);
                                  return false;
                            }else{
                                $('#select-all').prop('checked',false);
                                  return false;
                            }

                    });
                }

                // "sPaginationType": "full_numbers",
                            // "bDestroy": true,
                            // "aoColumnDefs": [
                            //   { 'bSortable': false, 'aTargets': [0] }
                            // ]
            })
           }
        }

        if ($('.dataTable_edit_dept').length > 0) {
            $(".dataTable_edit_dept").dataTable({
                language: {
                    "lengthMenu": "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    "zeroRecords": "{{__('No data available in table')}}",
                    "info": "{{__('Showing page')}} _PAGE_ {{__('of')}} _PAGES_",
                    "infoEmpty": "{{__('No page available')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                    "paginate": {
                        "previous": "{{__('Previous')}}",
                        "next": "{{__('Next')}}",
                        "last": "{{__('Last')}}"
                    }
                },
                order :[],

                aoColumnDefs: [
                    {"orderable": false, "bSortable": false, "aTargets": [ 1] },
                ],


                drawCallback: function(){
                    $('.paginate_button:not(.disabled)', this.api().table().container())
                    .on('click', function(){
                        var status = 0;

                            $( '.sub_chk' ).each( function(e) {
                                if ($(this).prop('checked') == true){
                                    status = 1;
                                }else{
                                  $('#select-all').prop('checked',false);
                                  return false;
                                }
                            });
                            if(status == 1){
                                $('#select-all').prop('checked',true);
                                  return false;
                            }else{
                                $('#select-all').prop('checked',false);
                                  return false;
                            }

                    });
                }

                // "sPaginationType": "full_numbers",
                            // "bDestroy": true,
                            // "aoColumnDefs": [
                            //   { 'bSortable': false, 'aTargets': [0] }
                            // ]
            })
        }

        if ($('.dataTable_department_list_apprisal').length > 0) {
            $(".dataTable_department_list_apprisal").dataTable({
                language: {
                    "lengthMenu": "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    "zeroRecords": "{{__('No data available in table')}}",
                    "info": "{{__('Showing page')}} _PAGE_ {{__('of')}} _PAGES_",
                    "infoEmpty": "{{__('No page available')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                    "paginate": {
                        "previous": "{{__('Previous')}}",
                        "next": "{{__('Next')}}",
                        "last": "{{__('Last')}}"
                    }
                },

                columnDefs: [
                   { orderable: false, targets: 2 }
                ],

            })
        }


        if ($('.dataTable_for_user_performence_rating_by_grade_level').length > 0) {
            $(".dataTable_for_user_performence_rating_by_grade_level").dataTable({
                language: {
                    "lengthMenu": "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    "zeroRecords": "{{__('No data available in table')}}",
                    "info": "{{__('Showing page')}} _PAGE_ {{__('of')}} _PAGES_",
                    "infoEmpty": "{{__('No page available')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                    "paginate": {
                        "previous": "{{__('Previous')}}",
                        "next": "{{__('Next')}}",
                        "last": "{{__('Last')}}"
                    }
                },

                // columnDefs: [
                //    { orderable: false, targets: 2 }
                // ],
                "aaSorting": [],
                order: [[4, 'desc']],

            })
        }

        if ($('.faq_dataTable').length > 0) {
            $(".faq_dataTable").dataTable({
                language: {
                    "lengthMenu": "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    "zeroRecords": "{{__('No data available in table')}}",
                    "info": "{{__('Showing page')}} _PAGE_ {{__('of')}} _PAGES_",
                    "infoEmpty": "{{__('No page available')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                    "paginate": {
                        "previous": "{{__('Previous')}}",
                        "next": "{{__('Next')}}",
                        "last": "{{__('Last')}}"
                    }
                },

                // columnDefs: [
                //    { orderable: false, targets: 2 }
                // ],
                "aaSorting": [],
                order: [[0, 'asc']],

            })
        }

        if ($('#tablerow').length > 0) {
            $("#tablerow").dataTable({
                language: {
                    "lengthMenu": "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    "zeroRecords": "{{__('No data available in table')}}",
                    "info": "{{__('Showing page')}} _PAGE_ {{__('of')}} _PAGES_",
                    "infoEmpty": "{{__('No page available')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                },
                "paging":   false,
            })
        }
        @if(Auth::user()->type != 'Super Admin')
        $(document).on('keyup', '.search_keyword', function () {
            search_data($(this).val());
        });

        if ($(".top-5-scroll").length) {
            $(".top-5-scroll").css({
                height: 315
            }).niceScroll();
        }
        @endif
    });

    @if(Auth::user()->type != 'Super Admin')
    // Common main search
    var currentRequest = null;

    function search_data(keyword = '') {
        currentRequest = $.ajax({
            url: '{{ route('search.json') }}',
            data: {keyword: keyword},
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (data) {
                $('.search-output').html(data);
            }
        });
    }
    @endif
</script>
<script>
    jQuery.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
  }
  });
    var base_url = window.location.origin+"/admin";
    $('.users_dataTablexxx').DataTable({
        "dom": '<"search-res-1 "f><"fr btn-res-1 btn-js-styl"B><"fr res-show-1 js-wiew"l>rt<"fl"i>p',
        // "dom": 'fBrtpi',
        "responsive": false,
        "paging": true,
        "scrollX": false,
        "searching": true,
        "autoWidth": false,
        "pageLength": 20,
        "order": [],
        "lengthMenu": [
            [20, 50, 100, 200, 500, 1000, 5000],
            ['20', '50', '100', '200' , '500', '1000', '5000']
        ],
        "processing": true,
        "serverSide": true,

        "ajax": {
            "url": base_url + '/user-list',
            "type": "POST",
            "dataType": 'JSON',
            data: function(d) {
                
            }
        },
      buttons: [
        
        ],
        "columns": [
            {orderable:false},
            {orderable:false},
            {orderable:false},
            {orderable:false},
            {orderable:false},
            {orderable:false},
            {orderable:false},
            {orderable:false},
        ],
        
        "drawCallback": function(settings) {

        },
        "createdRow": function ( row, data, index ) {
             $('td',row).attr('style','color:black;');
        }

  });
  $(document).on('click','.delete-icon',function(){
    var msg = $(this).data('confirm');
    var formid = $(this).data('formid');
    if(confirm(msg)){
        $('#'+formid).submit();
    }
});
</script>

</body>
</html>
