<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="author" content="Equipe #1">

    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body>
    <!-- Header -->
    <!-- <header class="header">
        <div class="logo">VINO</div>
        <div class="welcome-user hidden">
             @auth
                <p>@lang('lang.welcome'), <span>{{ Auth::user()->name }}</span></p>
            @endauth -->
    <!-- <header>
        <div class="logo"><h1><a href="{{ route('login') }}">VINO</a></h1></div> -->
    <!-- </header> -->
    <!-- Content -->
    <!-- @yield('content') -->
    <!-- Navigation -->
    <footer>
        <nav class="mobile-fixed-footer">
            <ul class="navigation">
            @auth
                <!-- <p>@lang('lang.welcome'), <span>{{ Auth::user()->name }}</span></p> -->
                @if(Auth::user()->isAdmin)
                <button><a href="{{ route('bottle.delete') }}">@lang('lang.delete_bottle')</a></button>
                <button><a href="{{ route('bottle.scrape') }}">@lang('lang.scrape_bottle')</a></button>
                @endif
             @endauth
        </div>
        <ul>
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">@lang('lang.login')</a></li>
            @else
                <li><a class="nav-link" href="{{ route('logout') }}">@lang('lang.logout')</a></li>
            @endguest
            <!-- <ul class="nav_dropdown">
                <li><a class="nav-link" href="{{ route('lang', 'en') }}">@lang('lang.language_en')</a></li>
                <li><a class="nav-link" href="{{ route('lang', 'fr') }}">@lang('lang.language_fr')</a></li>
            </ul> -->
            <div class="hidden dropdown">
                <img src="{{ asset('img/navigation/language.png')}}" alt="language settings">
                <div class="dropdown-box">
                    <a href="{{ route('lang', 'en') }}">@lang('lang.lang_en')</a>
                    <a href="{{ route('lang', 'fr') }}">@lang('lang.lang_fr')</a>
                </div>
            </div>
        </ul>
</footer>
    <!-- Content -->
    @yield('content')
    <!-- Navigation -->
    <nav class="navigation">
      <a class="nav-link" href="/"> <img src="{{asset('img/navigation/home.svg') }}" alt="nav-image">@lang('lang.home')</a>
      <a class="nav-link" href="{{ route('cellar.index') }}"> <img src="{{asset('img/navigation/my-collection.svg') }}" alt="nav-image">@lang('lang.cellars')</a>
      <a class="nav-link" href="{{ route('bottle.index') }}"> <img src="{{asset('img/navigation/catalog.svg') }}" alt="nav-image">@lang('lang.bottles')</a>
      <a class="nav-link" href="{{ route('user.show') }}"> <img src="{{asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.profile')</a>
    </nav>
</body>
</html>