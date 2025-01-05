<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <meta name="author" content="John Doe">
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>@yield('title')</title>
    <!-- <style>
        nav {
            height: 100px;
            display: block;
            position: absolute;
        }
    </style> -->
</head>
<body>
    <!-- <header>
        <nav>
            <ul>
                <li><a href="{{ route('user.create') }}"></a></li>
            </ul>
        </nav>
    </header> -->
    <!-- Header -->
    <header class="header">
        <div class="logo">VINO</div>
        <div class="welcome-user">
             @auth
                <p>Welcome, <span>{{ Auth::user()->name }}</span></p>
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
             @endauth
        </div>
    </header>
    
    @if(session('success'))
        <div class="">
            {{session('success')}}
            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </div>
    @endif
    @yield('content')

    <!-- Navigation -->
    <!-- FIXME: if active navigation link is highlighted -->
    <nav class="navigation">
      <a class="nav-link" href="/"> <img src="{{asset('img/navigation/home.svg') }}" alt="nav-image"></button> Celliers</a>
      <a class="nav-link" href="{{ route('cellar.index') }}"> <img src="{{asset('img/navigation/my-collection.svg') }}" alt="nav-image"> Collection</a>
      <a class="nav-link" href="{{ route('bottle.index') }}"> <img src="{{asset('img/navigation/catalog.svg') }}" alt="nav-image"> List</a>
      <a class="nav-link" href="{{ route('user.show') }}"> <img src="{{asset('img/navigation/profile.svg') }}" alt="nav-image">Profil</a>
    </nav>
</body>


</html>