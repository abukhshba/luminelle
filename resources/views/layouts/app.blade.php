<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('assets/back/css/main.css') }}" rel="stylesheet">
    <style>
        .cover-photo {
            position: relative;
            margin-top: -22px;
            height: 550px;
            background-image: url('{{ asset("assets/images/brand/cover1.jpg") }}');
            background-size: cover;
            background-position: center;
        }   

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="shortcut icon" type="image/png" href="/images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container navbar">
                <a class="logo-light" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/brand/logo.png') }}" height="50px" width="130px" class="main-logo" alt="logo">
                </a>
            
                <div class="navbar-links">
                    <a class="navbar-brand" href="{{ route('home') }}">Home</a>
                    <a class="navbar-brand" href="{{ route('home') }}">Categories</a>
                    <a class="navbar-brand" href="{{ route('home') }}">About Us</a>
                    <a class="navbar-brand" href="{{ route('home') }}">Contact Us</a>
                </div>
                <div class="user-profile">
                    <div class="profile-circle">
                        <img src="{{ asset('images/users/' . $user->image) }}" alt="User Profile">
                    </div>
                    <div class="profile-dropdown">
                        <div class="profile-name">{{ $user->name }}</div>
                        <ul class="dropdown-menu">
                            <li style="background-color: rgb(105, 198, 105)"><a href="{{ route('user.show', ['id' => $user->id]) }}">View Profile</a></li>
                            <li style="background-color: rgb(238, 93, 93)">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
            
            {{-- <div class="container">
                <a class=" logo-light " href="{{route('dashboard.home')}}"><img src="{{asset('assets/images/brand/logo.png')}}" height="40px" width="100px" class="main-logo" alt="logo"></a>
                <a class="navbar-brand" href="{{ route('home') }}">
                    Home
                </a> 
                <a class="navbar-brand" href="{{ route('home') }}">
                    Categories
                </a>  
                <a class="navbar-brand" href="{{ route('home') }}">
                    About Us
                </a> 
                <a class="navbar-brand" href="{{ route('home') }}">
                    Contact Us
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $user->name }}
                                </a>

               

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.show', ['id' => $user->id]) }}">
                                        View Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div> --}}
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <div class="container">
          <div class="footer-section-left">
            <h4>Navigations</h4>
            <ul>
              <li><a href="{{ route('home') }}">Home</a></li>
              <li><a href="">Categories</a></li>
              <li><a href="">About Us</a></li>
              <li><a href="">Contact Us</a></li>
            </ul>
          </div>
          <div class="footer-section-middle">
            <h4>Contact</h4>
            <p>Email: info@example.com</p>
            <p>Phone: +1234567890</p>
          </div>
          <div class="footer-section-right">
            <h4>Social Media</h4>
            <ul class="social-icons">
              <li><a href="#"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
              <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
              <li><a href="#"><i class="fab fa-telegram"></i> Telegram</a></li>
              <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
          </div>
        </div>
        <div class="bottom-footer">
          <div class="container">
            <p>&copy; {{ date('Y') }} Your Store. All rights reserved.</p>
          </div>
        </div>
      </footer>
      
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>     
</body>
</html>