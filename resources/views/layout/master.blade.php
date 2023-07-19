<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/switchery/switchery.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/slick/slick.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/icons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css?v=2')}}">
    <link rel="stylesheet" href="{{URL::asset('custom/css/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('custom/plugin/snackbar.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('custom/css/media.css')}}">
    <link rel="stylesheet" href="{{URL::asset('custom/css/style.css?v=2')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        .otp.form-control {
            width: 40px;
            height: 40px;
            text-align: center;
            margin: auto;
            padding: 0;
        }
    </style>
    @yield('customStyle')
</head>

<body class="vertical-layout">
<div id="containerbar">
    <div class="leftbar">
        <div class="sidebar">
{{--            <div class="logobar">--}}
{{--                <a href="#" class="logo logo-large"><img class="img-fluid" src="/custom/img/payin-logo-1.svg" alt="logo"></a>--}}
{{--                <a href="#" class="logo logo-small"><img class="img-fluid" src="/custom/img/payin-logo-1.svg" alt="logo"></a>--}}
{{--            </div>--}}
            <div class="navigationbar active">
                <ul class="vertical-menu in">
                    <li> <a href="#" class="text-muted" style="font-size:13px"><b>PAYIN & PAYOUT</b></a></li>
                    <li>
                        <a href="/dashboard">
                            <img src="assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard">Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/payin">
                            <i class="feather icon-arrow-down-left"></i>Payin
                        </a>
                    </li>
                    <li>
                        <a href="/payouts">
                            <i class="feather icon-arrow-up-right"></i>Payouts
                        </a>
                    </li>
                    <li>
                        <a href="/refunds">
                            <i class="icon feather icon-rotate-cw"></i>Refunds
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="/statement">--}}
{{--                            <i class="feather icon-layout"></i>Statement--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li> <a href="#" class="text-muted" style="font-size:13px"><b>OTHER</b></a></li>
                    <li>
                        <a href="/reports">
                            <i class="feather icon-book"></i>Reports
                        </a>
                    </li>
                    <li>
                        <a href="/settings">
                            <i class="feather icon-settings"></i>Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="rightbar">
        <div class="topbar-mobile">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="mobile-logobar">

                    </div>
                    <div class="mobile-togglebar">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <div class="topbar-toggle-icon">
                                    <a class="topbar-toggle-hamburger" href="javascript:void(0);">
                                        <img src="assets/images/svg-icon/verticle.svg" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                    </a>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="menubar">
                                    <a class="menu-hamburger" href="javascript:void(0);">
                                        <img src="assets/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                        <img src="assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                    </a>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="profilebar">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/profile.svg" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                            <div class="dropdown-item">
                                                <div class="profilename">
                                                    <h5>{{\Illuminate\Support\Facades\Auth::user()->fullName}}</h5>
                                                </div>
                                            </div>
                                            <div class="userbox">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="media dropdown-item">
                                                        <a href="/settings" class="profile-icon"><img src="assets/images/svg-icon/user.svg" class="img-fluid" alt="user">My Profile</a>
                                                    </li>

                                                    <li class="media dropdown-item">
                                                        <a href="/logout" class="profile-icon"><img src="assets/images/svg-icon/logout.svg" class="img-fluid" alt="logout">Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="topbar">
            <div class="row align-items-center">
                <!-- Start col -->
                <div class="col-md-12 align-self-center">
                    <div class="togglebar">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <div class="menubar">
                                    <a class="menu-hamburger" href="javascript:void();">
                                        <img src="assets/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                        <img src="assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="infobar">
                        <ul class="list-inline mb-0">

                            <li class="list-inline-item">
                                <div class="profilebar">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/profile.svg" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                            <div class="dropdown-item">
                                                <div class="profilename">
                                                    <h5>{{\Illuminate\Support\Facades\Auth::user()->fullName}}</h5>
                                                </div>
                                            </div>
                                            <div class="userbox">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="media dropdown-item">
                                                        <a href="/settings" class="profile-icon"><img src="assets/images/svg-icon/user.svg" class="img-fluid" alt="user">My Profile</a>
                                                    </li>

                                                    <li class="media dropdown-item">
                                                        <a href="/logout" class="profile-icon"><img src="assets/images/svg-icon/logout.svg" class="img-fluid" alt="logout">Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="breadcrumbbar">
            <div class="row align-items-center">
                <div class="col-md-8 col-lg-8">
                    <h4 class="page-title">{{ucwords(Route::current()->uri)}}</h4>
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ucwords(Route::current()->uri)}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($alertData))
            @foreach($alertData as $alert)
                <div class="alert {{$alert['alert_type']}}" role="alert" style="margin: 30px 30px 0 30px;padding: 20px;">
                    <h4 class="alert-heading">{{$alert['alert_title']}}</h4>
                    <p>{{$alert['alert']}}</p>
                </div>
            @endforeach
        @endif

         <div class="row align-items-center">
            </div>

        <div class="contentbar pb-5">
                @yield('content')
        </div>
        <div class="footerbar pt-2">
            <footer class="footer">
                <p class="mb-0">© 2022 PayzCart - All Rights Reserved.</p>
            </footer>
        </div>
    </div>
</div>
<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/js/popper.min.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{URL::asset('assets/js/detect.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{URL::asset('assets/js/vertical-menu.js')}}"></script>
<script src="{{URL::asset('assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/apexcharts/irregular-data-series.js')}}"></script>
<script src="{{URL::asset('assets/plugins/slick/slick.min.js')}}"></script>
<script src="{{URL::asset('assets/js/custom/custom-to-do-list.js')}}"></script>
<script src="{{URL::asset('assets/js/core.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- custom js for this page -->
<script src="{{URL::asset('custom/plugin/snackbar.min.js')}}"></script>
<script src="{{URL::asset('custom/js/dpz-client.js?v=7')}}"></script>
<script src="{{URL::asset('custom/js/dpz-paginate.js')}}"></script>
<script src="{{URL::asset('assets/js/datepicker.js')}}"></script>


@yield('customJs')

</body>
</html>
