<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{csrf_token()}}"/>

    <link rel="shortcut icon" type="image/png" href="/images/icon.png">

    <!-- Title -->
    <title>{{ config('app.name') }}</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicons/apple-touch-icon.png')}}">
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicons/favicon-16x16.png')}}"> --}}
    <link rel="manifest" href="{{asset('assets/images/favicons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('assets/images/favicons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Icons css -->
    <link href="{{asset('assets/back/css/icons.css')}}" rel="stylesheet">

    <!-- Bootstrap css -->
    <link href="{{asset('assets/back/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.33/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />

    <!-- style css -->
    <link href="{{asset('assets/back/css/style.css')}}" rel="stylesheet">

    <!--- Animations css-->
    <link href="{{asset('assets/back/css/animate.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- JQuery min js -->
    <script src="{{asset('assets/back/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <style>
        body *{
            font-family: 'Cairo', sans-serif;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 10px;
        }

        .dl-table td{
            vertical-align: middle;
        }

        .no-records{
            text-align: center;
            color: #CCCCCC
        }

        .no-records .big-icon{
            font-size: 60px;
        }

        .badge.badge-dl{
            font-size: 13px;
            padding: 10px 20px !important;
            display: inline-block;
            font-family: inherit;
            border-radius: 12px;
        }

        .table-dl th,
        .table-dl td{
            vertical-align: middle;
        }


        .switch {
            position: relative;
            display: inline-block;
            width: 54px;
            height: 28px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .droos-badge{
            padding: 10px 20px !important;
            font-family: inherit;
        }

        .table-buttons{
            display: flex;
        }

        .table-buttons > a,
        .table-buttons > button,
        .table-buttons > form{
            margin: 2px;
        }

        .table td{
            vertical-align: middle;
        }

        .btn-icon i{
            font-size: 14px;
        }

        .dropdown button.dropdown-item{
            background: transparent;
            border: 0;
            border-bottom: 1px solid #f9f9f9;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .dropdown button.dropdown-item .fa{
            margin-left: 8px;
        }

        .dropdown button.dropdown-item:hover{
            background-color: #ecf0fa;
        }

        table.dataTable thead > tr > th {
            text-align: left;
            padding: 10px 30px 10px 10px;
        }

        .dark-theme .dataTables_wrapper .dataTables_paginate .paginate_button{
            color: #fff !important;
        }

        .droos-dropdown-options .dropdown-item{
            display: flex;
            align-items: center;
        }
        .droos-dropdown-options .dropdown-item i{
            margin-left: 6px;
        }


        .svg-loader{
            display:flex;
            position: relative;
            align-content: space-around;
            justify-content: center;
        }
        .loader-svg{
            position: absolute;
            left: 0; right: 0; top: 0; bottom: 0;
            fill: none;
            stroke-width: 5px;
            stroke-linecap: round;
            stroke: rgb(64, 0, 148);
        }
        .loader-svg.bg{
            stroke-width: 8px;
            stroke: rgb(207, 205, 245);
        }

        .animate{
            stroke-dasharray: 242.6;
            animation: fill-animation 1s cubic-bezier(1,1,1,1) 0s infinite;
        }

        #close-notification{
            margin-left: auto !important;
        }

        @keyframes fill-animation{
            0%{
                stroke-dasharray: 40 242.6;
                stroke-dashoffset: 0;
            }
            50%{
                stroke-dasharray: 141.3;
                stroke-dashoffset: 141.3;
            }
            100%{
                stroke-dasharray: 40 242.6;
                stroke-dashoffset: 282.6;
            }
        }

        .info-balloon{
            width: 30px;
            height: 30px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            border: 3px solid #eee;
            color: #eee;
            cursor: pointer;
        }

        .static-footer{
            text-align: left;
        }

        .side-menu__item.active .side-menu__icon.solid__icon path,
        .side-menu__item.active .side-menu__icon.solid__icon .colored,
        .slide:hover .side-menu__label, .slide:hover .angle, .slide:hover .side-menu__icon.solid__icon path,
        .slide:hover .side-menu__label, .slide:hover .angle, .slide:hover .side-menu__icon.solid__icon .colored{
            fill: var(--primary-bg-color) !important;
        }

        span.page-link{
            margin-left: 4px !important;
            border-radius: 5px
        }

        .card-header{
            border-bottom: 1px solid #e7e7e7;
        }
        .form-filters{
            display: flex;
        }
        .form-filters .form-inline label{
            padding: 5px 20px;
            margin: 5px;
            border-radius: 10px;
            border: 1px solid #e7e7e7;
        }
        .form-filters .form-inline input[type='checkbox']{
            display: none;
        }
        .form-filters .form-inline,
        .form-filters .form-inline *{
            cursor: pointer;
        }
        .form-filters .form-inline:hover{
            opacity: .7;
        }
        .form-filters .form-inline.active label{
            background-color: #3498db;
            color: #ffffff;
            border-color: #2980b9;
        }
        .image-upload-wrapper{
            display: flex;
        }

        .single-image-upload,
        .single-upload-image{
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }
        .single-image-upload{
            border: 3px dashed #e7e7e7;
            font-size: 3rem;
            color: #e7e7e7;
        }
        .single-upload-image{
            border: 3px solid #e7e7e7;
            margin-right: 10px;
        }
        .single-image-field{
            width: 0;
            height: 0;
            display: none;
        }
        .table-responsive {
            overflow-y: hidden !important;
        }
    </style>

    @yield('styles')
</head>

<body class="main-body app sidebar-mini">

<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/back/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page custom-index">
    <div>
        <!-- main-header -->
        <div class="main-header side-header sticky nav nav-item">
            <div class="container-fluid main-container ">
                <div class="main-header-left ">
                    {{-- <div class="responsive-logo">
                        <a href="{{route('dashboard.home')}}" class="header-logo">
                            <img src="{{asset('assets/images/brand/kian-logo.png')}}" class="logo-1" alt="logo">
                            <img src="{{asset('assets/back/img/brand/kian-logo-white.png')}}" class="dark-logo-1" alt="logo">
                        </a>
                    </div> --}}

                    <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                        <a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left" ></i></a>
                        <a class="close-toggle" href="javascript:void(0);"><i class="header-icons fe fe-x"></i></a>
                    </div>
                </div>

                <div class="main-header-right">
                    <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fe fe-more-vertical "></span>
                    </button>
                    <div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <ul class="nav nav-item  navbar-nav-right ms-auto">
                                <li class="dropdown nav-item main-layout">
                                    <a id="change-mood" class="new nav-link theme-layout nav-link-bg layout-setting" >
                                        <span class="dark-layout"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M20.742 13.045a8.088 8.088 0 0 1-2.077.271c-2.135 0-4.14-.83-5.646-2.336a8.025 8.025 0 0 1-2.064-7.723A1 1 0 0 0 9.73 2.034a10.014 10.014 0 0 0-4.489 2.582c-3.898 3.898-3.898 10.243 0 14.143a9.937 9.937 0 0 0 7.072 2.93 9.93 9.93 0 0 0 7.07-2.929 10.007 10.007 0 0 0 2.583-4.491 1.001 1.001 0 0 0-1.224-1.224zm-2.772 4.301a7.947 7.947 0 0 1-5.656 2.343 7.953 7.953 0 0 1-5.658-2.344c-3.118-3.119-3.118-8.195 0-11.314a7.923 7.923 0 0 1 2.06-1.483 10.027 10.027 0 0 0 2.89 7.848 9.972 9.972 0 0 0 7.848 2.891 8.036 8.036 0 0 1-1.484 2.059z"/></svg></span>
                                        <span class="light-layout"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M6.993 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007S14.761 6.993 12 6.993 6.993 9.239 6.993 12zM12 8.993c1.658 0 3.007 1.349 3.007 3.007S13.658 15.007 12 15.007 8.993 13.658 8.993 12 10.342 8.993 12 8.993zM10.998 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2h-3zm17 0h3v2h-3zM4.219 18.363l2.12-2.122 1.415 1.414-2.12 2.122zM16.24 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.342 7.759 4.22 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"/></svg></span>
                                    </a>
                                </li>

                                <li class="nav-item full-screen fullscreen-button">
                                    <a class="new nav-link full-screen-link" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
                                </li>

                                <li class="dropdown main-header-message right-toggle">
                                    <a class="nav-link pe-0" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs feather feather-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span>
                                    </a>
                                </li>

                                <li class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user d-flex" href=""><img alt="" src=""></a>
                                    <div class="dropdown-menu">
                                        <div class="main-header-profile bg-primary p-3">
                                            <div class="d-flex wd-100p">
                                                {{-- <div class="main-img-user"><img alt="" src="{{get_user_image()}}" class=""></div> --}}

                                                <div class="ms-3 my-auto">
                                                    <h6>

                                                    @if (Auth::guard('admin')->check())
                                                        {{ Auth::guard('admin')->user()->name }}
                                                    @endif

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <a class="dropdown-item" href="#"><i class="bx bx-cog"></i> تعديل الملف الشخصي </a>

                                        <a class="dropdown-item" onclick="document.getElementById('logout-form').submit()" href="#"><i class="bx bx-log-out"></i> تسجيل الخروج </a>

                                        <form action="{{route('dashboard.logout')}}" method="POST" id="logout-form" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /main-header -->

        <!-- main-sidebar -->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <div class="sticky">
            <aside class="app-sidebar sidebar-scroll">
                <div class="main-sidebar-header active">
                    <a class="desktop-logo logo-light active" href="{{route('dashboard.home')}}"><img src="{{asset('assets/images/brand/logo.png')}}" class="main-logo" alt="logo"></a>
                   
                </div>

                @include('admin.Layouts.Sidebar')

            </aside>
        </div>
        <!-- main-sidebar -->
    </div>

    <!-- main-content -->
    <div class="main-content app-content">

        <!-- container -->
        <div class="main-container container-fluid">
            @yield('content')
        </div>
        <!-- /Container -->
    </div>
    <!-- /main-content -->

    <!-- Sidebar-right-->
    <div class="sidebar sidebar-right sidebar-animate">
        <div class="panel panel-primary card mb-0 box-shadow">
            <div class="tab-menu-heading border-0 p-3">
                <div class="card-title mb-0">الإشعارات</div>

                <div class="card-options ms-auto">
                    <a href="javascript:void(0);" class="sidebar-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-primary brround avatar-md">CH</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>New Websites is Created</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-clock text-muted me-1"></i>
                                <small class="text-muted ms-auto">30 mins ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center p-3">
                    <div class="">
                        <span class="avatar bg-blue brround avatar-md">U</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Prepare for Presentation</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-clock text-muted me-1"></i>
                                <small class="text-muted ms-auto">2 days ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--/Sidebar-right-->

    <!-- Footer opened -->
    {{-- <div class="main-footer ht-45">
        <div class="container-fluid pd-t-0 ht-100p">
            <a href="https://droos.live" target="_blank">
                <img class="droos-logo" style="max-height: 25px" src="{{asset('assets/images/brand/droos.live.gif')}}" alt="" />
            </a>
        </div>
    </div> --}}
    <!-- Footer closed -->

</div>
<!-- End Page -->

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

<!-- Bootstrap Bundle js -->
<script src="{{asset('assets/back/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/back/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!--Internal  Chart.bundle js -->
{{--<script src="{{asset('assets/back/plugins/chart.js/Chart.bundle.min.js')}}"></script>--}}

<!-- Moment js -->
<script src="{{asset('assets/back/plugins/moment/moment.js')}}"></script>

<!--Internal Sparkline js -->
{{--<script src="{{asset('assets/back/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>--}}

<!-- Moment js -->
<script src="{{asset('assets/back/plugins/raphael/raphael.min.js')}}"></script>

<!--Internal Apexchart js-->
{{--<script src="{{asset('assets/back/js/apexcharts.js')}}"></script>--}}

<!-- Rating js-->
{{--<script src="{{asset('assets/back/plugins/ratings-2/jquery.star-rating.js')}}"></script>--}}
{{--<script src="{{asset('assets/back/plugins/ratings-2/star-rating.js')}}"></script>--}}

<!--Internal  Perfect-scrollbar js -->
<script src="{{asset('assets/back/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/back/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

<!-- Eva-icons js -->
<script src="{{asset('assets/back/js/eva-icons.min.js')}}"></script>

<!-- right-sidebar js -->
<script src="{{asset('assets/back/plugins/sidebar/sidebar.js')}}"></script>
<script src="{{asset('assets/back/plugins/sidebar/sidebar-custom.js')}}"></script>

<!-- Sticky js -->
<script src="{{asset('assets/back/js/sticky.js')}}"></script>
<script src="{{asset('assets/back/js/modal-popup.js')}}"></script>

<!-- Left-menu js-->
<script src="{{asset('assets/back/plugins/side-menu/sidemenu.js')}}"></script>

<!-- Internal Map -->
{{--<script src="{{asset('assets/back/plugins/jqvmap/jquery.vmap.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/back/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>--}}

<!--themecolor js-->
<script src="{{asset('assets/back/js/themecolor.js')}}"></script>

<!-- Apexchart js-->
{{--<script src="{{asset('assets/back/js/apexcharts.js')}}"></script>--}}
{{--<script src="{{asset('assets/back/js/jquery.vmap.sampledata.js')}}"></script>--}}

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.33/sweetalert2.min.js"></script>

<!-- custom js -->
<script src="{{asset('assets/back/js/custom.js')}}"></script>

{{--<script src="https://js.pusher.com/7.2/pusher.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!--Internal  index js -->
<script src="{{asset('assets/back/js/index.js')}}"></script>

<script>
    // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    //     return new bootstrap.Tooltip(tooltipTriggerEl)
    // })

    // $(document).load(function (){
    // $.fn.modal.Constructor.prototype._enforceFocus = function() {};
    // })

    toastr.options.progressBar = true
    toastr.options.positionClass = 'toast-bottom-left'

    $('body').on('click', '.delete', function (e){
        e.preventDefault();

        const form = $(this).parents('form');

        Swal.fire({
            title: "انت على وشك حذف العنصر",
            text: "هل انت متأكد من حذف العنصر؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "حذف العنصر",
            cancelButtonText: "الغاء",
            dangerMode: true,
        }).then(function(result) {
            if (result.isConfirmed) {
                form.submit();
            }
        })

    });

    $('#change-mood').on('click', function (){
        const isDark = $('body').hasClass('dark-theme');
        const changeTo = isDark ? '' : 'dark_theme';

        $.post('/change-mood', {changeTo: changeTo})
    });

    function playSound() {
        const audio = new Audio('/files/notification.mp3');
        audio.play();
    }

    // Pusher.logToConsole = true;

    {{--var pusher = new Pusher('44229bac5a674e4af255', {--}}
    {{--    cluster: 'eu'--}}
    {{--});--}}

    {{--let subscription = pusher.subscribe('VideoReadyEvent{{!is_admin() ? '.'.get_auth()->id() : ''}}');--}}

    {{--subscription.bind('App\\Events\\VideoReadyEvent', function(data) {--}}
    {{--    toastr.success(data.notification);--}}
    {{--    playSound();--}}
    {{--});--}}

</script>

@yield('scripts')

</body>
</html>
