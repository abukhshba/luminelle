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
        .cover-photo-title {
            position: relative;
            margin-top: -24px;
            height: 850px;
            background-image: url('{{ asset("assets/images/brand/cover1.jpg") }}');
            background-size: cover;
            background-position: center;
        }   
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/starability-basic/css/starability-all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:wght@400;700&display=swap">

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
        <nav class="navbar">

            <div class="container navbar">
                <a class="logo-light" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/brand/logo.png') }}" height="50px" width="140px" class="main-logo" alt="logo">
                </a>
            
                <div class="navbar-links">
                    <a class="navbar-brand" href="{{ route('home') }}">Home</a>
                    <a class="navbar-brand" href="{{route('categories.products', [2]) }}">Wedding</a>
                    <a class="navbar-brand" href="{{route('categories.products', [1]) }}">Soiree</a>
                    {{--<a class="navbar-brand" href="{{ route('about') }}">About Us</a>--}}
                    <a class="navbar-brand" href="#contact">Contact Us</a>
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
              <li><a  href="{{route('categories.products', [2]) }}">Wedding</a></li>
              <li><a href="{{route('categories.products', [1]) }}">Soiree</a></li>
              <li><a href="#contact">Contact Us</a></li>
              <li><a href="{{route('termsAndConditions')}}">Terms And Conditions</a></li>
            </ul>
          </div>
          <div id="contact" class="footer-section-middle">
            <h4>Contact</h4>
            <p>Email: abukhshba@gmail.com</p>
            <p>Phone: +201013367402</p>
          </div>
          <div class="footer-section-right">
            <h4>Social Media</h4>
            <ul class="social-icons">
              <li><a href="#"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
              <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
              <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
              <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
          </div>
        </div>
        <div class="bottom-footer">
          <div class="container">
            <p>&copy; {{ date('Y') }} Luminelle Store. All rights reserved.</p>
          </div>
        </div>
      </footer>
      
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>     
</body>
</html>