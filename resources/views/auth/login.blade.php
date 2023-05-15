<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>تسجيل الدخول | لوحة تحكم  </title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/images/icon.png">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicons/apple-touch-icon.png')}}">
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicons/favicon-32x32.png')}}"> --}}
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicons/favicon-16x16.png')}}"> --}}
    <link rel="manifest" href="{{asset('assets/images/favicons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('assets/images/favicons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <style>

        * {
            font-family: "Cairo", sans-serif;
        }

        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #dde5f4;
            height: 100vh;
            overflow-y: scroll;
            overflow-x: hidden
        }

        .screen-1 {
            background: #f1f7fe;
            padding: 1em;
            display: flex;
            flex-direction: column;
            border-radius: 30px;
            box-shadow: 0 0 2em #e6e9f9;
            /*gap: 1.5em;*/
            position: relative;
            min-width: 300px;
        }
        .screen-1 .logo-wrapper {
            text-align: center;
            /*margin-bottom: 2rem;*/
        }
        .screen-1 .logo-wrapper .logo {
            /*margin-top: -3em;*/
            width: auto;
            height: 110px;
        }
        .screen-1 .email {
            background: white;
            box-shadow: 0 0 2em #e6e9f9;
            padding: 1em;
            display: flex;
            flex-direction: column;
            /*gap: 0.5em;*/
            border-radius: 20px;
            color: #4d4d4d
        }
        .screen-1 .email input {
            outline: none;
            border: none;
            width: calc(100% - 25px);
        }
        .screen-1 .email input::-moz-placeholder {
            color: black;
            font-size: 0.9em;
        }
        .screen-1 .email input:-ms-input-placeholder {
            color: black;
            font-size: 0.9em;
        }
        .screen-1 .email input::placeholder {
            color: black;
            font-size: 0.9em;
        }
        .screen-1 .email i {
            color: #4d4d4d;
            margin-bottom: -0.2em;
        }
        .screen-1 .password {
            background: white;
            box-shadow: 0 0 2em #e6e9f9;
            padding: 1em;
            display: flex;
            flex-direction: column;
            /*gap: 0.5em;*/
            border-radius: 20px;
            color: #4d4d4d;
        }
        .screen-1 .password input {
            outline: none;
            border: none;
            min-width: calc(100% - 45px);
        }
        .screen-1 .password input::-moz-placeholder {
            color: black;
            font-size: 0.9em;
        }
        .screen-1 .password input:-ms-input-placeholder {
            color: black;
            font-size: 0.9em;
        }
        .screen-1 .password input::placeholder {
            color: black;
            font-size: 0.9em;
        }
        .screen-1 .password i {
            color: #4d4d4d;
            margin-bottom: -0.2em;
        }
        .screen-1 .password .show-hide {
            margin-right: auto;
            cursor: pointer;
        }
        .screen-1 .password .show-hide:hover {
            opacity: .7;
        }
        .screen-1 .login-btn {
            padding: 1em;
            background: #3e4684;
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;

            transition: all .25s ease-in;
            -webkit-transition: all .25s ease-in;
            -moz-transition: all .25s ease-in;
        }
        .screen-1 .login-btn:hover {
            opacity: .7;
        }

        .screen-1 .footer span {
            cursor: pointer;
        }

        button {
            cursor: pointer;
        }

        body::after {
            content: "";
            width: 1000px;
            height: 1025px;
            position: absolute;
            top: -25%;
            left: 50%;
            margin-left: -500px;
            margin-top: -500px;
            border-radius: 35%;
            background: rgba(255, 255, 255, .75);
            animation: wave 15s infinite linear;
            z-index: -1;
        }
        .text-center {
            text-align: center;
        }
        .droos-logo {
            height: 25px;
            margin-top: 1rem;
        }
        h6{
            margin: 0;
        }
        .mb-2{
            margin-bottom: 1rem;
        }

        @keyframes wave {
            from { transform: rotate(0deg);}
            from { transform: rotate(360deg);}
        }
    </style>
</head>
<body>



<form action="{{route('login.post')}}" method="POST">
    @csrf

    <div class="screen-1">
        <a href="{{url('/home')}}" class="logo-wrapper">
            <img class="logo" src="{{asset('assets/images/brand/loginLogo.png')}}" alt="" />
        </a>

        @include('messages')

        <div class="email mb-2">
            <label for="email">البريد الالكتروني أو رقم الهاتف</label>

            <div class="sec-2">
                <i class="lni lni-user"></i>
                <input type="text" id="email" name="email" placeholder="Username@gmail.com"/>
            </div>
        </div>

        <div class="password mb-2">
            <label for="password">كلمة المرور</label>

            <div class="sec-2">
                <i class="lni lni-lock-alt"></i>
                <input class="pas" id="password" type="password" name="password" placeholder="············"/>
                <i class="show-hide lni lni-eye"></i>
            </div>
        </div>

        <button type="submit" class="login-btn">تسجيل الدخول</button>
        <div class="sec-2">
            <p>ليس لديك حساب! <a style="text-decoration: none ; font-weight: 560" href="{{route('register')}}"><span>سجل الان</span></a></p>
        </div>
    </div>

    {{-- <div class="text-center">
        <a href="https://droos.live" target="_blank">
            <img class="droos-logo" src="{{asset('assets/images/brand/droos.live.gif')}}" alt="" />
        </a>

        <h6>Version: 2.0.10</h6>
    </div> --}}
</form>

</body>
</html>
