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
    <link rel="icon" href="{{ asset('/storage/logo/favicon.png')}}" type="image">

    @stack('head')

    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/libs/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/ac.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/datatables.min.css') }}">




    <link rel="stylesheet" href="{{ asset('/assets/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">
    @if($SITE_RTL=='on')
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-rtl.css') }}">
    @endif
    <meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">

    {{-- scripts --}}
    <script src="{{ asset('/js/chatify/autosize.js') }}"></script>
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
                    <div class="col-xl-12 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
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

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
    "></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js
    "></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<script type="text/javascript" src="{{asset('assets/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
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
        $(document).ready(function () {
            pushNotification('{{ Auth::id() }}');
        });

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
<script src="{{ asset('/assets/js/new-custom.js')}}"></script>

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

                // columnDefs: [
                //    { orderable: false, targets: 1 }
                // ],

                aoColumnDefs: [
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
                dom: 'lBfrtip',
                paging: true,
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
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    { extend: 'excel', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -915 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 5.82421875 15.9598214285714  L 5.02734375 15.9598214285714  L 5.02734375 17.1428571428571  L 8.3203125 17.1428571428571  L 8.3203125 15.9598214285714  L 7.44140625 15.9598214285714  L 8.6484375 14.1629464285714  C 8.6875 14.1108630952381  8.7265625 14.0494791666667  8.765625 13.9787946428571  C 8.8046875 13.9081101190476  8.833984375 13.8578869047619  8.853515625 13.828125  C 8.873046875 13.7983630952381  8.88671875 13.7834821428571  8.89453125 13.7834821428571  L 8.91796875 13.7834821428571  C 8.92578125 13.813244047619  8.9453125 13.8504464285714  8.9765625 13.8950892857143  C 8.9921875 13.9248511904762  9.009765625 13.9527529761905  9.029296875 13.9787946428571  C 9.048828125 14.0048363095238  9.072265625 14.0345982142857  9.099609375 14.0680803571429  C 9.126953125 14.1015625  9.15234375 14.1331845238095  9.17578125 14.1629464285714  L 10.4296875 15.9598214285714  L 9.5390625 15.9598214285714  L 9.5390625 17.1428571428571  L 12.94921875 17.1428571428571  L 12.94921875 15.9598214285714  L 12.15234375 15.9598214285714  L 9.90234375 12.9129464285714  L 12.1875 9.765625  L 12.97265625 9.765625  L 12.97265625 8.57142857142857  L 9.703125 8.57142857142857  L 9.703125 9.765625  L 10.5703125 9.765625  L 9.36328125 11.5401785714286  C 9.33203125 11.5922619047619  9.29296875 11.6536458333333  9.24609375 11.7243303571429  C 9.19921875 11.7950148809524  9.1640625 11.8452380952381  9.140625 11.875  L 9.1171875 11.9084821428571  L 9.09375 11.9084821428571  C 9.0859375 11.8787202380952  9.06640625 11.8415178571429  9.03515625 11.796875  C 8.98828125 11.7150297619048  8.921875 11.6294642857143  8.8359375 11.5401785714286  L 7.59375 9.765625  L 8.484375 9.765625  L 8.484375 8.57142857142857  L 5.0859375 8.57142857142857  L 5.0859375 9.765625  L 5.8828125 9.765625  L 8.09765625 12.8013392857143  L 5.82421875 15.9598214285714  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 915 189 )" /> </g> </svg>' },
                    { extend: 'pdf', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -953 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 8.765625 9.296875  C 9.1953125 10.5171130952381  9.765625 11.4025297619048  10.4765625 11.953125  C 10.734375 12.1465773809524  11.0625 12.3549107142857  11.4609375 12.578125  C 11.921875 12.5260416666667  12.37890625 12.5  12.83203125 12.5  C 13.98046875 12.5  14.671875 12.6822916666667  14.90625 13.046875  C 15.03125 13.2105654761905  15.0390625 13.4040178571429  14.9296875 13.6272321428571  C 14.9296875 13.6346726190476  14.92578125 13.6421130952381  14.91796875 13.6495535714286  L 14.89453125 13.671875  L 14.89453125 13.6830357142857  C 14.84765625 13.9657738095238  14.5703125 14.1071428571429  14.0625 14.1071428571429  C 13.6875 14.1071428571429  13.23828125 14.0327380952381  12.71484375 13.8839285714286  C 12.19140625 13.735119047619  11.68359375 13.5379464285714  11.19140625 13.2924107142857  C 9.46484375 13.4709821428571  7.93359375 13.7797619047619  6.59765625 14.21875  C 5.40234375 16.1681547619048  4.45703125 17.1428571428571  3.76171875 17.1428571428571  C 3.64453125 17.1428571428571  3.53515625 17.1168154761905  3.43359375 17.0647321428571  L 3.15234375 16.9308035714286  C 3.14453125 16.9233630952381  3.12109375 16.9047619047619  3.08203125 16.875  C 3.00390625 16.8005952380952  2.98046875 16.6666666666667  3.01171875 16.4732142857143  C 3.08203125 16.1755952380952  3.30078125 15.835193452381  3.66796875 15.4520089285714  C 4.03515625 15.0688244047619  4.55078125 14.7098214285714  5.21484375 14.375  C 5.32421875 14.3080357142857  5.4140625 14.3303571428571  5.484375 14.4419642857143  C 5.5 14.4568452380952  5.5078125 14.4717261904762  5.5078125 14.4866071428571  C 5.9140625 13.8541666666667  6.33203125 13.1212797619048  6.76171875 12.2879464285714  C 7.29296875 11.2760416666667  7.69921875 10.3013392857143  7.98046875 9.36383928571429  C 7.79296875 8.75372023809524  7.673828125 8.16034226190476  7.623046875 7.58370535714286  C 7.572265625 7.00706845238095  7.59765625 6.53273809523809  7.69921875 6.16071428571429  C 7.78515625 5.86309523809524  7.94921875 5.71428571428571  8.19140625 5.71428571428571  L 8.4375 5.71428571428571  L 8.44921875 5.71428571428571  C 8.62890625 5.71428571428571  8.765625 5.77008928571429  8.859375 5.88169642857143  C 9 6.03794642857143  9.03515625 6.29092261904762  8.96484375 6.640625  C 8.94921875 6.68526785714286  8.93359375 6.71502976190476  8.91796875 6.72991071428571  C 8.92578125 6.75223214285714  8.9296875 6.78199404761905  8.9296875 6.81919642857143  L 8.9296875 7.15401785714286  C 8.9140625 8.06919642857143  8.859375 8.78348214285714  8.765625 9.296875  Z M 4.306640625 15.7142857142857  C 4.021484375 16.0416666666667  3.828125 16.3169642857143  3.7265625 16.5401785714286  C 4.1328125 16.3616071428571  4.66796875 15.7738095238095  5.33203125 14.7767857142857  C 4.93359375 15.0744047619048  4.591796875 15.3869047619048  4.306640625 15.7142857142857  Z M 8.390625 6.25  L 8.390625 6.27232142857143  C 8.2734375 6.58482142857143  8.265625 7.07589285714286  8.3671875 7.74553571428571  C 8.375 7.69345238095238  8.40234375 7.5297619047619  8.44921875 7.25446428571429  C 8.44921875 7.23214285714286  8.4765625 7.07217261904762  8.53125 6.77455357142857  C 8.5390625 6.74479166666667  8.5546875 6.71502976190476  8.578125 6.68526785714286  C 8.5703125 6.67782738095238  8.56640625 6.6703869047619  8.56640625 6.66294642857143  C 8.55859375 6.64806547619047  8.5546875 6.63690476190476  8.5546875 6.62946428571429  C 8.546875 6.46577380952381  8.49609375 6.33184523809524  8.40234375 6.22767857142857  C 8.40234375 6.23511904761905  8.3984375 6.24255952380952  8.390625 6.25  Z M 7.46484375 12.7232142857143  C 7.23046875 13.139880952381  7.0546875 13.4486607142857  6.9375 13.6495535714286  C 7.9921875 13.2477678571429  9.1015625 12.9464285714286  10.265625 12.7455357142857  C 10.25 12.7380952380952  10.19921875 12.7027529761905  10.11328125 12.6395089285714  C 10.02734375 12.5762648809524  9.96484375 12.5260416666667  9.92578125 12.4888392857143  C 9.33203125 11.9903273809524  8.8359375 11.3355654761905  8.4375 10.5245535714286  C 8.2265625 11.1644345238095  7.90234375 11.8973214285714  7.46484375 12.7232142857143  Z M 14.53125 13.5044642857143  C 14.53125 13.4970238095238  14.5234375 13.4858630952381  14.5078125 13.4709821428571  C 14.3203125 13.2924107142857  13.7734375 13.203125  12.8671875 13.203125  C 13.4609375 13.4114583333333  13.9453125 13.515625  14.3203125 13.515625  C 14.4296875 13.515625  14.5 13.5119047619048  14.53125 13.5044642857143  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 953 189 )" /> </g> </svg>'
                    }
                ],
            })
        }

        if ($('.dataTable_for_user_performence_rating_by_department').length > 0) {
            $(".dataTable_for_user_performence_rating_by_department").dataTable({
                dom: 'lBfrtip',
                paging: true,
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
                recordsTotal: 30,
                // columnDefs: [
                //    { orderable: false, targets: 2 }
                // ],
                "aaSorting": [],
                order: [[3, 'desc']],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    { extend: 'excel', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -915 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 5.82421875 15.9598214285714  L 5.02734375 15.9598214285714  L 5.02734375 17.1428571428571  L 8.3203125 17.1428571428571  L 8.3203125 15.9598214285714  L 7.44140625 15.9598214285714  L 8.6484375 14.1629464285714  C 8.6875 14.1108630952381  8.7265625 14.0494791666667  8.765625 13.9787946428571  C 8.8046875 13.9081101190476  8.833984375 13.8578869047619  8.853515625 13.828125  C 8.873046875 13.7983630952381  8.88671875 13.7834821428571  8.89453125 13.7834821428571  L 8.91796875 13.7834821428571  C 8.92578125 13.813244047619  8.9453125 13.8504464285714  8.9765625 13.8950892857143  C 8.9921875 13.9248511904762  9.009765625 13.9527529761905  9.029296875 13.9787946428571  C 9.048828125 14.0048363095238  9.072265625 14.0345982142857  9.099609375 14.0680803571429  C 9.126953125 14.1015625  9.15234375 14.1331845238095  9.17578125 14.1629464285714  L 10.4296875 15.9598214285714  L 9.5390625 15.9598214285714  L 9.5390625 17.1428571428571  L 12.94921875 17.1428571428571  L 12.94921875 15.9598214285714  L 12.15234375 15.9598214285714  L 9.90234375 12.9129464285714  L 12.1875 9.765625  L 12.97265625 9.765625  L 12.97265625 8.57142857142857  L 9.703125 8.57142857142857  L 9.703125 9.765625  L 10.5703125 9.765625  L 9.36328125 11.5401785714286  C 9.33203125 11.5922619047619  9.29296875 11.6536458333333  9.24609375 11.7243303571429  C 9.19921875 11.7950148809524  9.1640625 11.8452380952381  9.140625 11.875  L 9.1171875 11.9084821428571  L 9.09375 11.9084821428571  C 9.0859375 11.8787202380952  9.06640625 11.8415178571429  9.03515625 11.796875  C 8.98828125 11.7150297619048  8.921875 11.6294642857143  8.8359375 11.5401785714286  L 7.59375 9.765625  L 8.484375 9.765625  L 8.484375 8.57142857142857  L 5.0859375 8.57142857142857  L 5.0859375 9.765625  L 5.8828125 9.765625  L 8.09765625 12.8013392857143  L 5.82421875 15.9598214285714  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 915 189 )" /> </g> </svg>' },
                    { extend: 'pdf', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -953 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 8.765625 9.296875  C 9.1953125 10.5171130952381  9.765625 11.4025297619048  10.4765625 11.953125  C 10.734375 12.1465773809524  11.0625 12.3549107142857  11.4609375 12.578125  C 11.921875 12.5260416666667  12.37890625 12.5  12.83203125 12.5  C 13.98046875 12.5  14.671875 12.6822916666667  14.90625 13.046875  C 15.03125 13.2105654761905  15.0390625 13.4040178571429  14.9296875 13.6272321428571  C 14.9296875 13.6346726190476  14.92578125 13.6421130952381  14.91796875 13.6495535714286  L 14.89453125 13.671875  L 14.89453125 13.6830357142857  C 14.84765625 13.9657738095238  14.5703125 14.1071428571429  14.0625 14.1071428571429  C 13.6875 14.1071428571429  13.23828125 14.0327380952381  12.71484375 13.8839285714286  C 12.19140625 13.735119047619  11.68359375 13.5379464285714  11.19140625 13.2924107142857  C 9.46484375 13.4709821428571  7.93359375 13.7797619047619  6.59765625 14.21875  C 5.40234375 16.1681547619048  4.45703125 17.1428571428571  3.76171875 17.1428571428571  C 3.64453125 17.1428571428571  3.53515625 17.1168154761905  3.43359375 17.0647321428571  L 3.15234375 16.9308035714286  C 3.14453125 16.9233630952381  3.12109375 16.9047619047619  3.08203125 16.875  C 3.00390625 16.8005952380952  2.98046875 16.6666666666667  3.01171875 16.4732142857143  C 3.08203125 16.1755952380952  3.30078125 15.835193452381  3.66796875 15.4520089285714  C 4.03515625 15.0688244047619  4.55078125 14.7098214285714  5.21484375 14.375  C 5.32421875 14.3080357142857  5.4140625 14.3303571428571  5.484375 14.4419642857143  C 5.5 14.4568452380952  5.5078125 14.4717261904762  5.5078125 14.4866071428571  C 5.9140625 13.8541666666667  6.33203125 13.1212797619048  6.76171875 12.2879464285714  C 7.29296875 11.2760416666667  7.69921875 10.3013392857143  7.98046875 9.36383928571429  C 7.79296875 8.75372023809524  7.673828125 8.16034226190476  7.623046875 7.58370535714286  C 7.572265625 7.00706845238095  7.59765625 6.53273809523809  7.69921875 6.16071428571429  C 7.78515625 5.86309523809524  7.94921875 5.71428571428571  8.19140625 5.71428571428571  L 8.4375 5.71428571428571  L 8.44921875 5.71428571428571  C 8.62890625 5.71428571428571  8.765625 5.77008928571429  8.859375 5.88169642857143  C 9 6.03794642857143  9.03515625 6.29092261904762  8.96484375 6.640625  C 8.94921875 6.68526785714286  8.93359375 6.71502976190476  8.91796875 6.72991071428571  C 8.92578125 6.75223214285714  8.9296875 6.78199404761905  8.9296875 6.81919642857143  L 8.9296875 7.15401785714286  C 8.9140625 8.06919642857143  8.859375 8.78348214285714  8.765625 9.296875  Z M 4.306640625 15.7142857142857  C 4.021484375 16.0416666666667  3.828125 16.3169642857143  3.7265625 16.5401785714286  C 4.1328125 16.3616071428571  4.66796875 15.7738095238095  5.33203125 14.7767857142857  C 4.93359375 15.0744047619048  4.591796875 15.3869047619048  4.306640625 15.7142857142857  Z M 8.390625 6.25  L 8.390625 6.27232142857143  C 8.2734375 6.58482142857143  8.265625 7.07589285714286  8.3671875 7.74553571428571  C 8.375 7.69345238095238  8.40234375 7.5297619047619  8.44921875 7.25446428571429  C 8.44921875 7.23214285714286  8.4765625 7.07217261904762  8.53125 6.77455357142857  C 8.5390625 6.74479166666667  8.5546875 6.71502976190476  8.578125 6.68526785714286  C 8.5703125 6.67782738095238  8.56640625 6.6703869047619  8.56640625 6.66294642857143  C 8.55859375 6.64806547619047  8.5546875 6.63690476190476  8.5546875 6.62946428571429  C 8.546875 6.46577380952381  8.49609375 6.33184523809524  8.40234375 6.22767857142857  C 8.40234375 6.23511904761905  8.3984375 6.24255952380952  8.390625 6.25  Z M 7.46484375 12.7232142857143  C 7.23046875 13.139880952381  7.0546875 13.4486607142857  6.9375 13.6495535714286  C 7.9921875 13.2477678571429  9.1015625 12.9464285714286  10.265625 12.7455357142857  C 10.25 12.7380952380952  10.19921875 12.7027529761905  10.11328125 12.6395089285714  C 10.02734375 12.5762648809524  9.96484375 12.5260416666667  9.92578125 12.4888392857143  C 9.33203125 11.9903273809524  8.8359375 11.3355654761905  8.4375 10.5245535714286  C 8.2265625 11.1644345238095  7.90234375 11.8973214285714  7.46484375 12.7232142857143  Z M 14.53125 13.5044642857143  C 14.53125 13.4970238095238  14.5234375 13.4858630952381  14.5078125 13.4709821428571  C 14.3203125 13.2924107142857  13.7734375 13.203125  12.8671875 13.203125  C 13.4609375 13.4114583333333  13.9453125 13.515625  14.3203125 13.515625  C 14.4296875 13.515625  14.5 13.5119047619048  14.53125 13.5044642857143  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 953 189 )" /> </g> </svg>'
                    }
                ],

            })
        }

        if ($('.dataTable_for_user_performence_rating_by_department_bottom').length > 0) {
            $(".dataTable_for_user_performence_rating_by_department_bottom").dataTable({
                dom: 'lBfrtip',
                paging: true,
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
                recordsTotal: 30,
                // columnDefs: [
                //    { orderable: false, targets: 2 }
                // ],
                "aaSorting": [],
                order: [[3, 'asc']],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    { extend: 'excel', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -915 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 5.82421875 15.9598214285714  L 5.02734375 15.9598214285714  L 5.02734375 17.1428571428571  L 8.3203125 17.1428571428571  L 8.3203125 15.9598214285714  L 7.44140625 15.9598214285714  L 8.6484375 14.1629464285714  C 8.6875 14.1108630952381  8.7265625 14.0494791666667  8.765625 13.9787946428571  C 8.8046875 13.9081101190476  8.833984375 13.8578869047619  8.853515625 13.828125  C 8.873046875 13.7983630952381  8.88671875 13.7834821428571  8.89453125 13.7834821428571  L 8.91796875 13.7834821428571  C 8.92578125 13.813244047619  8.9453125 13.8504464285714  8.9765625 13.8950892857143  C 8.9921875 13.9248511904762  9.009765625 13.9527529761905  9.029296875 13.9787946428571  C 9.048828125 14.0048363095238  9.072265625 14.0345982142857  9.099609375 14.0680803571429  C 9.126953125 14.1015625  9.15234375 14.1331845238095  9.17578125 14.1629464285714  L 10.4296875 15.9598214285714  L 9.5390625 15.9598214285714  L 9.5390625 17.1428571428571  L 12.94921875 17.1428571428571  L 12.94921875 15.9598214285714  L 12.15234375 15.9598214285714  L 9.90234375 12.9129464285714  L 12.1875 9.765625  L 12.97265625 9.765625  L 12.97265625 8.57142857142857  L 9.703125 8.57142857142857  L 9.703125 9.765625  L 10.5703125 9.765625  L 9.36328125 11.5401785714286  C 9.33203125 11.5922619047619  9.29296875 11.6536458333333  9.24609375 11.7243303571429  C 9.19921875 11.7950148809524  9.1640625 11.8452380952381  9.140625 11.875  L 9.1171875 11.9084821428571  L 9.09375 11.9084821428571  C 9.0859375 11.8787202380952  9.06640625 11.8415178571429  9.03515625 11.796875  C 8.98828125 11.7150297619048  8.921875 11.6294642857143  8.8359375 11.5401785714286  L 7.59375 9.765625  L 8.484375 9.765625  L 8.484375 8.57142857142857  L 5.0859375 8.57142857142857  L 5.0859375 9.765625  L 5.8828125 9.765625  L 8.09765625 12.8013392857143  L 5.82421875 15.9598214285714  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 915 189 )" /> </g> </svg>' },
                    { extend: 'pdf', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -953 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 8.765625 9.296875  C 9.1953125 10.5171130952381  9.765625 11.4025297619048  10.4765625 11.953125  C 10.734375 12.1465773809524  11.0625 12.3549107142857  11.4609375 12.578125  C 11.921875 12.5260416666667  12.37890625 12.5  12.83203125 12.5  C 13.98046875 12.5  14.671875 12.6822916666667  14.90625 13.046875  C 15.03125 13.2105654761905  15.0390625 13.4040178571429  14.9296875 13.6272321428571  C 14.9296875 13.6346726190476  14.92578125 13.6421130952381  14.91796875 13.6495535714286  L 14.89453125 13.671875  L 14.89453125 13.6830357142857  C 14.84765625 13.9657738095238  14.5703125 14.1071428571429  14.0625 14.1071428571429  C 13.6875 14.1071428571429  13.23828125 14.0327380952381  12.71484375 13.8839285714286  C 12.19140625 13.735119047619  11.68359375 13.5379464285714  11.19140625 13.2924107142857  C 9.46484375 13.4709821428571  7.93359375 13.7797619047619  6.59765625 14.21875  C 5.40234375 16.1681547619048  4.45703125 17.1428571428571  3.76171875 17.1428571428571  C 3.64453125 17.1428571428571  3.53515625 17.1168154761905  3.43359375 17.0647321428571  L 3.15234375 16.9308035714286  C 3.14453125 16.9233630952381  3.12109375 16.9047619047619  3.08203125 16.875  C 3.00390625 16.8005952380952  2.98046875 16.6666666666667  3.01171875 16.4732142857143  C 3.08203125 16.1755952380952  3.30078125 15.835193452381  3.66796875 15.4520089285714  C 4.03515625 15.0688244047619  4.55078125 14.7098214285714  5.21484375 14.375  C 5.32421875 14.3080357142857  5.4140625 14.3303571428571  5.484375 14.4419642857143  C 5.5 14.4568452380952  5.5078125 14.4717261904762  5.5078125 14.4866071428571  C 5.9140625 13.8541666666667  6.33203125 13.1212797619048  6.76171875 12.2879464285714  C 7.29296875 11.2760416666667  7.69921875 10.3013392857143  7.98046875 9.36383928571429  C 7.79296875 8.75372023809524  7.673828125 8.16034226190476  7.623046875 7.58370535714286  C 7.572265625 7.00706845238095  7.59765625 6.53273809523809  7.69921875 6.16071428571429  C 7.78515625 5.86309523809524  7.94921875 5.71428571428571  8.19140625 5.71428571428571  L 8.4375 5.71428571428571  L 8.44921875 5.71428571428571  C 8.62890625 5.71428571428571  8.765625 5.77008928571429  8.859375 5.88169642857143  C 9 6.03794642857143  9.03515625 6.29092261904762  8.96484375 6.640625  C 8.94921875 6.68526785714286  8.93359375 6.71502976190476  8.91796875 6.72991071428571  C 8.92578125 6.75223214285714  8.9296875 6.78199404761905  8.9296875 6.81919642857143  L 8.9296875 7.15401785714286  C 8.9140625 8.06919642857143  8.859375 8.78348214285714  8.765625 9.296875  Z M 4.306640625 15.7142857142857  C 4.021484375 16.0416666666667  3.828125 16.3169642857143  3.7265625 16.5401785714286  C 4.1328125 16.3616071428571  4.66796875 15.7738095238095  5.33203125 14.7767857142857  C 4.93359375 15.0744047619048  4.591796875 15.3869047619048  4.306640625 15.7142857142857  Z M 8.390625 6.25  L 8.390625 6.27232142857143  C 8.2734375 6.58482142857143  8.265625 7.07589285714286  8.3671875 7.74553571428571  C 8.375 7.69345238095238  8.40234375 7.5297619047619  8.44921875 7.25446428571429  C 8.44921875 7.23214285714286  8.4765625 7.07217261904762  8.53125 6.77455357142857  C 8.5390625 6.74479166666667  8.5546875 6.71502976190476  8.578125 6.68526785714286  C 8.5703125 6.67782738095238  8.56640625 6.6703869047619  8.56640625 6.66294642857143  C 8.55859375 6.64806547619047  8.5546875 6.63690476190476  8.5546875 6.62946428571429  C 8.546875 6.46577380952381  8.49609375 6.33184523809524  8.40234375 6.22767857142857  C 8.40234375 6.23511904761905  8.3984375 6.24255952380952  8.390625 6.25  Z M 7.46484375 12.7232142857143  C 7.23046875 13.139880952381  7.0546875 13.4486607142857  6.9375 13.6495535714286  C 7.9921875 13.2477678571429  9.1015625 12.9464285714286  10.265625 12.7455357142857  C 10.25 12.7380952380952  10.19921875 12.7027529761905  10.11328125 12.6395089285714  C 10.02734375 12.5762648809524  9.96484375 12.5260416666667  9.92578125 12.4888392857143  C 9.33203125 11.9903273809524  8.8359375 11.3355654761905  8.4375 10.5245535714286  C 8.2265625 11.1644345238095  7.90234375 11.8973214285714  7.46484375 12.7232142857143  Z M 14.53125 13.5044642857143  C 14.53125 13.4970238095238  14.5234375 13.4858630952381  14.5078125 13.4709821428571  C 14.3203125 13.2924107142857  13.7734375 13.203125  12.8671875 13.203125  C 13.4609375 13.4114583333333  13.9453125 13.515625  14.3203125 13.515625  C 14.4296875 13.515625  14.5 13.5119047619048  14.53125 13.5044642857143  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 953 189 )" /> </g> </svg>'
                    }
                ],

            })
        }

        if ($('.dataTable_for_user_performence_rating_by_departmentnew').length > 0) {
            $(".dataTable_for_user_performence_rating_by_departmentnew").dataTable({
                dom: 'lBfrtip',
                paging: true,
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
                recordsTotal: 30,
                // columnDefs: [
                //    { orderable: false, targets: 2 }
                // ],
                "aaSorting": [],
                order: [[0, 'asc']],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    { extend: 'excel', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -915 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 5.82421875 15.9598214285714  L 5.02734375 15.9598214285714  L 5.02734375 17.1428571428571  L 8.3203125 17.1428571428571  L 8.3203125 15.9598214285714  L 7.44140625 15.9598214285714  L 8.6484375 14.1629464285714  C 8.6875 14.1108630952381  8.7265625 14.0494791666667  8.765625 13.9787946428571  C 8.8046875 13.9081101190476  8.833984375 13.8578869047619  8.853515625 13.828125  C 8.873046875 13.7983630952381  8.88671875 13.7834821428571  8.89453125 13.7834821428571  L 8.91796875 13.7834821428571  C 8.92578125 13.813244047619  8.9453125 13.8504464285714  8.9765625 13.8950892857143  C 8.9921875 13.9248511904762  9.009765625 13.9527529761905  9.029296875 13.9787946428571  C 9.048828125 14.0048363095238  9.072265625 14.0345982142857  9.099609375 14.0680803571429  C 9.126953125 14.1015625  9.15234375 14.1331845238095  9.17578125 14.1629464285714  L 10.4296875 15.9598214285714  L 9.5390625 15.9598214285714  L 9.5390625 17.1428571428571  L 12.94921875 17.1428571428571  L 12.94921875 15.9598214285714  L 12.15234375 15.9598214285714  L 9.90234375 12.9129464285714  L 12.1875 9.765625  L 12.97265625 9.765625  L 12.97265625 8.57142857142857  L 9.703125 8.57142857142857  L 9.703125 9.765625  L 10.5703125 9.765625  L 9.36328125 11.5401785714286  C 9.33203125 11.5922619047619  9.29296875 11.6536458333333  9.24609375 11.7243303571429  C 9.19921875 11.7950148809524  9.1640625 11.8452380952381  9.140625 11.875  L 9.1171875 11.9084821428571  L 9.09375 11.9084821428571  C 9.0859375 11.8787202380952  9.06640625 11.8415178571429  9.03515625 11.796875  C 8.98828125 11.7150297619048  8.921875 11.6294642857143  8.8359375 11.5401785714286  L 7.59375 9.765625  L 8.484375 9.765625  L 8.484375 8.57142857142857  L 5.0859375 8.57142857142857  L 5.0859375 9.765625  L 5.8828125 9.765625  L 8.09765625 12.8013392857143  L 5.82421875 15.9598214285714  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 915 189 )" /> </g> </svg>' },
                    { extend: 'pdf', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -953 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 8.765625 9.296875  C 9.1953125 10.5171130952381  9.765625 11.4025297619048  10.4765625 11.953125  C 10.734375 12.1465773809524  11.0625 12.3549107142857  11.4609375 12.578125  C 11.921875 12.5260416666667  12.37890625 12.5  12.83203125 12.5  C 13.98046875 12.5  14.671875 12.6822916666667  14.90625 13.046875  C 15.03125 13.2105654761905  15.0390625 13.4040178571429  14.9296875 13.6272321428571  C 14.9296875 13.6346726190476  14.92578125 13.6421130952381  14.91796875 13.6495535714286  L 14.89453125 13.671875  L 14.89453125 13.6830357142857  C 14.84765625 13.9657738095238  14.5703125 14.1071428571429  14.0625 14.1071428571429  C 13.6875 14.1071428571429  13.23828125 14.0327380952381  12.71484375 13.8839285714286  C 12.19140625 13.735119047619  11.68359375 13.5379464285714  11.19140625 13.2924107142857  C 9.46484375 13.4709821428571  7.93359375 13.7797619047619  6.59765625 14.21875  C 5.40234375 16.1681547619048  4.45703125 17.1428571428571  3.76171875 17.1428571428571  C 3.64453125 17.1428571428571  3.53515625 17.1168154761905  3.43359375 17.0647321428571  L 3.15234375 16.9308035714286  C 3.14453125 16.9233630952381  3.12109375 16.9047619047619  3.08203125 16.875  C 3.00390625 16.8005952380952  2.98046875 16.6666666666667  3.01171875 16.4732142857143  C 3.08203125 16.1755952380952  3.30078125 15.835193452381  3.66796875 15.4520089285714  C 4.03515625 15.0688244047619  4.55078125 14.7098214285714  5.21484375 14.375  C 5.32421875 14.3080357142857  5.4140625 14.3303571428571  5.484375 14.4419642857143  C 5.5 14.4568452380952  5.5078125 14.4717261904762  5.5078125 14.4866071428571  C 5.9140625 13.8541666666667  6.33203125 13.1212797619048  6.76171875 12.2879464285714  C 7.29296875 11.2760416666667  7.69921875 10.3013392857143  7.98046875 9.36383928571429  C 7.79296875 8.75372023809524  7.673828125 8.16034226190476  7.623046875 7.58370535714286  C 7.572265625 7.00706845238095  7.59765625 6.53273809523809  7.69921875 6.16071428571429  C 7.78515625 5.86309523809524  7.94921875 5.71428571428571  8.19140625 5.71428571428571  L 8.4375 5.71428571428571  L 8.44921875 5.71428571428571  C 8.62890625 5.71428571428571  8.765625 5.77008928571429  8.859375 5.88169642857143  C 9 6.03794642857143  9.03515625 6.29092261904762  8.96484375 6.640625  C 8.94921875 6.68526785714286  8.93359375 6.71502976190476  8.91796875 6.72991071428571  C 8.92578125 6.75223214285714  8.9296875 6.78199404761905  8.9296875 6.81919642857143  L 8.9296875 7.15401785714286  C 8.9140625 8.06919642857143  8.859375 8.78348214285714  8.765625 9.296875  Z M 4.306640625 15.7142857142857  C 4.021484375 16.0416666666667  3.828125 16.3169642857143  3.7265625 16.5401785714286  C 4.1328125 16.3616071428571  4.66796875 15.7738095238095  5.33203125 14.7767857142857  C 4.93359375 15.0744047619048  4.591796875 15.3869047619048  4.306640625 15.7142857142857  Z M 8.390625 6.25  L 8.390625 6.27232142857143  C 8.2734375 6.58482142857143  8.265625 7.07589285714286  8.3671875 7.74553571428571  C 8.375 7.69345238095238  8.40234375 7.5297619047619  8.44921875 7.25446428571429  C 8.44921875 7.23214285714286  8.4765625 7.07217261904762  8.53125 6.77455357142857  C 8.5390625 6.74479166666667  8.5546875 6.71502976190476  8.578125 6.68526785714286  C 8.5703125 6.67782738095238  8.56640625 6.6703869047619  8.56640625 6.66294642857143  C 8.55859375 6.64806547619047  8.5546875 6.63690476190476  8.5546875 6.62946428571429  C 8.546875 6.46577380952381  8.49609375 6.33184523809524  8.40234375 6.22767857142857  C 8.40234375 6.23511904761905  8.3984375 6.24255952380952  8.390625 6.25  Z M 7.46484375 12.7232142857143  C 7.23046875 13.139880952381  7.0546875 13.4486607142857  6.9375 13.6495535714286  C 7.9921875 13.2477678571429  9.1015625 12.9464285714286  10.265625 12.7455357142857  C 10.25 12.7380952380952  10.19921875 12.7027529761905  10.11328125 12.6395089285714  C 10.02734375 12.5762648809524  9.96484375 12.5260416666667  9.92578125 12.4888392857143  C 9.33203125 11.9903273809524  8.8359375 11.3355654761905  8.4375 10.5245535714286  C 8.2265625 11.1644345238095  7.90234375 11.8973214285714  7.46484375 12.7232142857143  Z M 14.53125 13.5044642857143  C 14.53125 13.4970238095238  14.5234375 13.4858630952381  14.5078125 13.4709821428571  C 14.3203125 13.2924107142857  13.7734375 13.203125  12.8671875 13.203125  C 13.4609375 13.4114583333333  13.9453125 13.515625  14.3203125 13.515625  C 14.4296875 13.515625  14.5 13.5119047619048  14.53125 13.5044642857143  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 953 189 )" /> </g> </svg>'
                    }
                ],


            })
        }

        if ($('.dataTable_for_overall_training_needs').length > 0) {
            $(".dataTable_for_overall_training_needs").dataTable({
                dom: 'lBfrtip',
                paging: true,
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
                recordsTotal: 30,
                // columnDefs: [
                //    { orderable: false, targets: 2 }
                // ],
                "aaSorting": [],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                order: [[0, 'asc']],
                buttons: [
                    { extend: 'excel', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -915 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 5.82421875 15.9598214285714  L 5.02734375 15.9598214285714  L 5.02734375 17.1428571428571  L 8.3203125 17.1428571428571  L 8.3203125 15.9598214285714  L 7.44140625 15.9598214285714  L 8.6484375 14.1629464285714  C 8.6875 14.1108630952381  8.7265625 14.0494791666667  8.765625 13.9787946428571  C 8.8046875 13.9081101190476  8.833984375 13.8578869047619  8.853515625 13.828125  C 8.873046875 13.7983630952381  8.88671875 13.7834821428571  8.89453125 13.7834821428571  L 8.91796875 13.7834821428571  C 8.92578125 13.813244047619  8.9453125 13.8504464285714  8.9765625 13.8950892857143  C 8.9921875 13.9248511904762  9.009765625 13.9527529761905  9.029296875 13.9787946428571  C 9.048828125 14.0048363095238  9.072265625 14.0345982142857  9.099609375 14.0680803571429  C 9.126953125 14.1015625  9.15234375 14.1331845238095  9.17578125 14.1629464285714  L 10.4296875 15.9598214285714  L 9.5390625 15.9598214285714  L 9.5390625 17.1428571428571  L 12.94921875 17.1428571428571  L 12.94921875 15.9598214285714  L 12.15234375 15.9598214285714  L 9.90234375 12.9129464285714  L 12.1875 9.765625  L 12.97265625 9.765625  L 12.97265625 8.57142857142857  L 9.703125 8.57142857142857  L 9.703125 9.765625  L 10.5703125 9.765625  L 9.36328125 11.5401785714286  C 9.33203125 11.5922619047619  9.29296875 11.6536458333333  9.24609375 11.7243303571429  C 9.19921875 11.7950148809524  9.1640625 11.8452380952381  9.140625 11.875  L 9.1171875 11.9084821428571  L 9.09375 11.9084821428571  C 9.0859375 11.8787202380952  9.06640625 11.8415178571429  9.03515625 11.796875  C 8.98828125 11.7150297619048  8.921875 11.6294642857143  8.8359375 11.5401785714286  L 7.59375 9.765625  L 8.484375 9.765625  L 8.484375 8.57142857142857  L 5.0859375 8.57142857142857  L 5.0859375 9.765625  L 5.8828125 9.765625  L 8.09765625 12.8013392857143  L 5.82421875 15.9598214285714  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 915 189 )" /> </g> </svg>'
                    },
                    { extend: 'pdf', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -953 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 8.765625 9.296875  C 9.1953125 10.5171130952381  9.765625 11.4025297619048  10.4765625 11.953125  C 10.734375 12.1465773809524  11.0625 12.3549107142857  11.4609375 12.578125  C 11.921875 12.5260416666667  12.37890625 12.5  12.83203125 12.5  C 13.98046875 12.5  14.671875 12.6822916666667  14.90625 13.046875  C 15.03125 13.2105654761905  15.0390625 13.4040178571429  14.9296875 13.6272321428571  C 14.9296875 13.6346726190476  14.92578125 13.6421130952381  14.91796875 13.6495535714286  L 14.89453125 13.671875  L 14.89453125 13.6830357142857  C 14.84765625 13.9657738095238  14.5703125 14.1071428571429  14.0625 14.1071428571429  C 13.6875 14.1071428571429  13.23828125 14.0327380952381  12.71484375 13.8839285714286  C 12.19140625 13.735119047619  11.68359375 13.5379464285714  11.19140625 13.2924107142857  C 9.46484375 13.4709821428571  7.93359375 13.7797619047619  6.59765625 14.21875  C 5.40234375 16.1681547619048  4.45703125 17.1428571428571  3.76171875 17.1428571428571  C 3.64453125 17.1428571428571  3.53515625 17.1168154761905  3.43359375 17.0647321428571  L 3.15234375 16.9308035714286  C 3.14453125 16.9233630952381  3.12109375 16.9047619047619  3.08203125 16.875  C 3.00390625 16.8005952380952  2.98046875 16.6666666666667  3.01171875 16.4732142857143  C 3.08203125 16.1755952380952  3.30078125 15.835193452381  3.66796875 15.4520089285714  C 4.03515625 15.0688244047619  4.55078125 14.7098214285714  5.21484375 14.375  C 5.32421875 14.3080357142857  5.4140625 14.3303571428571  5.484375 14.4419642857143  C 5.5 14.4568452380952  5.5078125 14.4717261904762  5.5078125 14.4866071428571  C 5.9140625 13.8541666666667  6.33203125 13.1212797619048  6.76171875 12.2879464285714  C 7.29296875 11.2760416666667  7.69921875 10.3013392857143  7.98046875 9.36383928571429  C 7.79296875 8.75372023809524  7.673828125 8.16034226190476  7.623046875 7.58370535714286  C 7.572265625 7.00706845238095  7.59765625 6.53273809523809  7.69921875 6.16071428571429  C 7.78515625 5.86309523809524  7.94921875 5.71428571428571  8.19140625 5.71428571428571  L 8.4375 5.71428571428571  L 8.44921875 5.71428571428571  C 8.62890625 5.71428571428571  8.765625 5.77008928571429  8.859375 5.88169642857143  C 9 6.03794642857143  9.03515625 6.29092261904762  8.96484375 6.640625  C 8.94921875 6.68526785714286  8.93359375 6.71502976190476  8.91796875 6.72991071428571  C 8.92578125 6.75223214285714  8.9296875 6.78199404761905  8.9296875 6.81919642857143  L 8.9296875 7.15401785714286  C 8.9140625 8.06919642857143  8.859375 8.78348214285714  8.765625 9.296875  Z M 4.306640625 15.7142857142857  C 4.021484375 16.0416666666667  3.828125 16.3169642857143  3.7265625 16.5401785714286  C 4.1328125 16.3616071428571  4.66796875 15.7738095238095  5.33203125 14.7767857142857  C 4.93359375 15.0744047619048  4.591796875 15.3869047619048  4.306640625 15.7142857142857  Z M 8.390625 6.25  L 8.390625 6.27232142857143  C 8.2734375 6.58482142857143  8.265625 7.07589285714286  8.3671875 7.74553571428571  C 8.375 7.69345238095238  8.40234375 7.5297619047619  8.44921875 7.25446428571429  C 8.44921875 7.23214285714286  8.4765625 7.07217261904762  8.53125 6.77455357142857  C 8.5390625 6.74479166666667  8.5546875 6.71502976190476  8.578125 6.68526785714286  C 8.5703125 6.67782738095238  8.56640625 6.6703869047619  8.56640625 6.66294642857143  C 8.55859375 6.64806547619047  8.5546875 6.63690476190476  8.5546875 6.62946428571429  C 8.546875 6.46577380952381  8.49609375 6.33184523809524  8.40234375 6.22767857142857  C 8.40234375 6.23511904761905  8.3984375 6.24255952380952  8.390625 6.25  Z M 7.46484375 12.7232142857143  C 7.23046875 13.139880952381  7.0546875 13.4486607142857  6.9375 13.6495535714286  C 7.9921875 13.2477678571429  9.1015625 12.9464285714286  10.265625 12.7455357142857  C 10.25 12.7380952380952  10.19921875 12.7027529761905  10.11328125 12.6395089285714  C 10.02734375 12.5762648809524  9.96484375 12.5260416666667  9.92578125 12.4888392857143  C 9.33203125 11.9903273809524  8.8359375 11.3355654761905  8.4375 10.5245535714286  C 8.2265625 11.1644345238095  7.90234375 11.8973214285714  7.46484375 12.7232142857143  Z M 14.53125 13.5044642857143  C 14.53125 13.4970238095238  14.5234375 13.4858630952381  14.5078125 13.4709821428571  C 14.3203125 13.2924107142857  13.7734375 13.203125  12.8671875 13.203125  C 13.4609375 13.4114583333333  13.9453125 13.515625  14.3203125 13.515625  C 14.4296875 13.515625  14.5 13.5119047619048  14.53125 13.5044642857143  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 953 189 )" /> </g> </svg>'
                    }
                ],

            })
        }

        if ($('#tablerow').length > 0) {
            $("#tablerow").dataTable({
                dom: 'lBfrtip',
                paging: true,
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

                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    { extend: 'excel', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -915 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 5.82421875 15.9598214285714  L 5.02734375 15.9598214285714  L 5.02734375 17.1428571428571  L 8.3203125 17.1428571428571  L 8.3203125 15.9598214285714  L 7.44140625 15.9598214285714  L 8.6484375 14.1629464285714  C 8.6875 14.1108630952381  8.7265625 14.0494791666667  8.765625 13.9787946428571  C 8.8046875 13.9081101190476  8.833984375 13.8578869047619  8.853515625 13.828125  C 8.873046875 13.7983630952381  8.88671875 13.7834821428571  8.89453125 13.7834821428571  L 8.91796875 13.7834821428571  C 8.92578125 13.813244047619  8.9453125 13.8504464285714  8.9765625 13.8950892857143  C 8.9921875 13.9248511904762  9.009765625 13.9527529761905  9.029296875 13.9787946428571  C 9.048828125 14.0048363095238  9.072265625 14.0345982142857  9.099609375 14.0680803571429  C 9.126953125 14.1015625  9.15234375 14.1331845238095  9.17578125 14.1629464285714  L 10.4296875 15.9598214285714  L 9.5390625 15.9598214285714  L 9.5390625 17.1428571428571  L 12.94921875 17.1428571428571  L 12.94921875 15.9598214285714  L 12.15234375 15.9598214285714  L 9.90234375 12.9129464285714  L 12.1875 9.765625  L 12.97265625 9.765625  L 12.97265625 8.57142857142857  L 9.703125 8.57142857142857  L 9.703125 9.765625  L 10.5703125 9.765625  L 9.36328125 11.5401785714286  C 9.33203125 11.5922619047619  9.29296875 11.6536458333333  9.24609375 11.7243303571429  C 9.19921875 11.7950148809524  9.1640625 11.8452380952381  9.140625 11.875  L 9.1171875 11.9084821428571  L 9.09375 11.9084821428571  C 9.0859375 11.8787202380952  9.06640625 11.8415178571429  9.03515625 11.796875  C 8.98828125 11.7150297619048  8.921875 11.6294642857143  8.8359375 11.5401785714286  L 7.59375 9.765625  L 8.484375 9.765625  L 8.484375 8.57142857142857  L 5.0859375 8.57142857142857  L 5.0859375 9.765625  L 5.8828125 9.765625  L 8.09765625 12.8013392857143  L 5.82421875 15.9598214285714  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 915 189 )" /> </g> </svg>'
                    },
                    { extend: 'pdf', text: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="20px" xmlns="http://www.w3.org/2000/svg"> <g transform="matrix(1 0 0 1 -953 -189 )"> <path d="M 13.546875 0.758928571428572  L 17.203125 4.24107142857143  C 17.421875 4.44940476190476  17.609375 4.73214285714286  17.765625 5.08928571428571  C 17.921875 5.44642857142857  18 5.77380952380952  18 6.07142857142857  L 18 18.9285714285714  C 18 19.2261904761905  17.890625 19.4791666666667  17.671875 19.6875  C 17.453125 19.8958333333333  17.1875 20  16.875 20  L 1.125 20  C 0.8125 20  0.546875 19.8958333333333  0.328125 19.6875  C 0.109375 19.4791666666667  0 19.2261904761905  0 18.9285714285714  L 0 1.07142857142857  C 0 0.773809523809523  0.109375 0.520833333333333  0.328125 0.3125  C 0.546875 0.104166666666667  0.8125 0  1.125 0  L 11.625 0  C 11.9375 0  12.28125 0.0744047619047628  12.65625 0.223214285714286  C 13.03125 0.372023809523809  13.328125 0.550595238095237  13.546875 0.758928571428572  Z M 12.48046875 1.76339285714286  C 12.38671875 1.67410714285714  12.2265625 1.5922619047619  12 1.51785714285714  L 12 5.71428571428571  L 16.40625 5.71428571428571  C 16.328125 5.4985119047619  16.2421875 5.34598214285714  16.1484375 5.25669642857143  L 12.48046875 1.76339285714286  Z M 1.5 18.5714285714286  L 16.5 18.5714285714286  L 16.5 7.14285714285714  L 11.625 7.14285714285714  C 11.3125 7.14285714285714  11.046875 7.03869047619047  10.828125 6.83035714285714  C 10.609375 6.62202380952381  10.5 6.36904761904762  10.5 6.07142857142857  L 10.5 1.42857142857143  L 1.5 1.42857142857143  L 1.5 18.5714285714286  Z M 8.765625 9.296875  C 9.1953125 10.5171130952381  9.765625 11.4025297619048  10.4765625 11.953125  C 10.734375 12.1465773809524  11.0625 12.3549107142857  11.4609375 12.578125  C 11.921875 12.5260416666667  12.37890625 12.5  12.83203125 12.5  C 13.98046875 12.5  14.671875 12.6822916666667  14.90625 13.046875  C 15.03125 13.2105654761905  15.0390625 13.4040178571429  14.9296875 13.6272321428571  C 14.9296875 13.6346726190476  14.92578125 13.6421130952381  14.91796875 13.6495535714286  L 14.89453125 13.671875  L 14.89453125 13.6830357142857  C 14.84765625 13.9657738095238  14.5703125 14.1071428571429  14.0625 14.1071428571429  C 13.6875 14.1071428571429  13.23828125 14.0327380952381  12.71484375 13.8839285714286  C 12.19140625 13.735119047619  11.68359375 13.5379464285714  11.19140625 13.2924107142857  C 9.46484375 13.4709821428571  7.93359375 13.7797619047619  6.59765625 14.21875  C 5.40234375 16.1681547619048  4.45703125 17.1428571428571  3.76171875 17.1428571428571  C 3.64453125 17.1428571428571  3.53515625 17.1168154761905  3.43359375 17.0647321428571  L 3.15234375 16.9308035714286  C 3.14453125 16.9233630952381  3.12109375 16.9047619047619  3.08203125 16.875  C 3.00390625 16.8005952380952  2.98046875 16.6666666666667  3.01171875 16.4732142857143  C 3.08203125 16.1755952380952  3.30078125 15.835193452381  3.66796875 15.4520089285714  C 4.03515625 15.0688244047619  4.55078125 14.7098214285714  5.21484375 14.375  C 5.32421875 14.3080357142857  5.4140625 14.3303571428571  5.484375 14.4419642857143  C 5.5 14.4568452380952  5.5078125 14.4717261904762  5.5078125 14.4866071428571  C 5.9140625 13.8541666666667  6.33203125 13.1212797619048  6.76171875 12.2879464285714  C 7.29296875 11.2760416666667  7.69921875 10.3013392857143  7.98046875 9.36383928571429  C 7.79296875 8.75372023809524  7.673828125 8.16034226190476  7.623046875 7.58370535714286  C 7.572265625 7.00706845238095  7.59765625 6.53273809523809  7.69921875 6.16071428571429  C 7.78515625 5.86309523809524  7.94921875 5.71428571428571  8.19140625 5.71428571428571  L 8.4375 5.71428571428571  L 8.44921875 5.71428571428571  C 8.62890625 5.71428571428571  8.765625 5.77008928571429  8.859375 5.88169642857143  C 9 6.03794642857143  9.03515625 6.29092261904762  8.96484375 6.640625  C 8.94921875 6.68526785714286  8.93359375 6.71502976190476  8.91796875 6.72991071428571  C 8.92578125 6.75223214285714  8.9296875 6.78199404761905  8.9296875 6.81919642857143  L 8.9296875 7.15401785714286  C 8.9140625 8.06919642857143  8.859375 8.78348214285714  8.765625 9.296875  Z M 4.306640625 15.7142857142857  C 4.021484375 16.0416666666667  3.828125 16.3169642857143  3.7265625 16.5401785714286  C 4.1328125 16.3616071428571  4.66796875 15.7738095238095  5.33203125 14.7767857142857  C 4.93359375 15.0744047619048  4.591796875 15.3869047619048  4.306640625 15.7142857142857  Z M 8.390625 6.25  L 8.390625 6.27232142857143  C 8.2734375 6.58482142857143  8.265625 7.07589285714286  8.3671875 7.74553571428571  C 8.375 7.69345238095238  8.40234375 7.5297619047619  8.44921875 7.25446428571429  C 8.44921875 7.23214285714286  8.4765625 7.07217261904762  8.53125 6.77455357142857  C 8.5390625 6.74479166666667  8.5546875 6.71502976190476  8.578125 6.68526785714286  C 8.5703125 6.67782738095238  8.56640625 6.6703869047619  8.56640625 6.66294642857143  C 8.55859375 6.64806547619047  8.5546875 6.63690476190476  8.5546875 6.62946428571429  C 8.546875 6.46577380952381  8.49609375 6.33184523809524  8.40234375 6.22767857142857  C 8.40234375 6.23511904761905  8.3984375 6.24255952380952  8.390625 6.25  Z M 7.46484375 12.7232142857143  C 7.23046875 13.139880952381  7.0546875 13.4486607142857  6.9375 13.6495535714286  C 7.9921875 13.2477678571429  9.1015625 12.9464285714286  10.265625 12.7455357142857  C 10.25 12.7380952380952  10.19921875 12.7027529761905  10.11328125 12.6395089285714  C 10.02734375 12.5762648809524  9.96484375 12.5260416666667  9.92578125 12.4888392857143  C 9.33203125 11.9903273809524  8.8359375 11.3355654761905  8.4375 10.5245535714286  C 8.2265625 11.1644345238095  7.90234375 11.8973214285714  7.46484375 12.7232142857143  Z M 14.53125 13.5044642857143  C 14.53125 13.4970238095238  14.5234375 13.4858630952381  14.5078125 13.4709821428571  C 14.3203125 13.2924107142857  13.7734375 13.203125  12.8671875 13.203125  C 13.4609375 13.4114583333333  13.9453125 13.515625  14.3203125 13.515625  C 14.4296875 13.515625  14.5 13.5119047619048  14.53125 13.5044642857143  Z " fill-rule="nonzero" fill="#acacac" stroke="none" transform="matrix(1 0 0 1 953 189 )" /> </g> </svg>'
                    }
                ],

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
</body>
</html>
