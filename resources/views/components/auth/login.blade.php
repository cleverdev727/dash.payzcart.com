<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(\App\Classes\DashboardUtils::isKeePays())
        <title>KeePays Login</title>
    @else
        <?php
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parse = parse_url($url);
         ?>
        <title>{{ucfirst($parse['host'])}}</title>
    @endif
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/icons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('custom/plugin/snackbar.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <style>
        .keepays-logo {
            position: relative;
            background: rgb(50 76 197);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 25px !important;
        }

    </style>
</head>
<body class="vertical-layout">
<div id="containerbar" class="containerbar authenticate-bg">
    <div class="container">
        <div class="auth-box login-box">
            <div class="row no-gutters align-items-center justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-box-right">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="javascript:void(0)" id="authenticateMerchantForm">
{{--                                    <div class="form-head">--}}
{{--                                        --}}
{{--                                    </div>--}}
                                    <h4 class="text-primary my-4">Log in !</h4>

                                    <div class="form-group">
                                        <label for="txtUsername" style="display: flex;color: #000000FF" >Username</label>
                                        <input type="email" class="form-control" id="txtUsername" name="txtUsername" autocomplete="off" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtPassword" style="display: flex;color: #000000FF">Password</label>
                                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" autocomplete="off" placeholder="Password">
                                    </div>
                                    <div class="form-group" id="newPasswordField" style="display: none">
                                        <label for="txtNewPassword">New Password</label>
                                        <input type="password" class="form-control" id="txtNewPassword" name="txtNewPassword" autocomplete="off" placeholder="New Password">
                                    </div>
                                    <div class="mt-3 pt-2">
                                        <button type="submit" class="btn btn-success btn-lg btn-block font-18">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/js/popper.min.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{URL::asset('assets/js/detect.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="{{URL::asset('custom/plugin/snackbar.min.js')}}"></script>
<script src="{{URL::asset('custom/js/dpz-client.js')}}"></script>
<script src="{{URL::asset('custom/js/component/authenticate.js')}}"></script>
</body>
</html>
