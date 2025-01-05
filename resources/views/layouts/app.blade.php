<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <meta name="author" content="Mateo">
    <meta name="author" content="Dionis">
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">VINO</div>
        <div class="welcome-user">
             @auth
                <p>Welcome, <span>{{ Auth::user()->name }}</span></p>
                @if(Auth::user()->isAdmin)
                <p>test</p>
                <button><a href="{{ route('bottle.delete') }}">Delete Bottles</a></button>
                <button><a href="{{ route('bottle.scrape') }}">Scrape Bottles</a></button>
                @endif
             @endauth
        </div>
        <ul>
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @else
                <li><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
            @endguest
        </ul>
    </header>
    <!-- Content -->
    @yield('content')
    <!-- Navigation -->
    <nav class="navigation">
      <a class="nav-link" href="/"> <img src="{{asset('img/navigation/home.svg') }}" alt="nav-image"> Celliers</a>
      <a class="nav-link" href="{{ route('cellar.index') }}"> <img src="{{asset('img/navigation/my-collection.svg') }}" alt="nav-image"> Collection</a>
      <a class="nav-link" href="{{ route('bottle.index') }}"> <img src="{{asset('img/navigation/catalog.svg') }}" alt="nav-image"> List</a>
      <a class="nav-link" href="{{ route('user.show') }}"> <img src="{{asset('img/navigation/profile.svg') }}" alt="nav-image">Profil</a>
    </nav>
</body>
</html>