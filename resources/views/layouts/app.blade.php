<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <meta name="author" content="Equipe #1">
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">VINO</div>
        <div class="welcome-user hidden">
             @auth
                <!-- <p>@lang('lang.welcome'), <span>{{ Auth::user()->name }}</span></p> -->
                @if(Auth::user()->isAdmin)
                <button><a href="{{ route('bottle.delete') }}">@lang('lang.delete_bottle')</a></button>
                <button><a href="{{ route('bottle.scrape') }}">@lang('lang.scrape_bottle')</a></button>
                @endif
             @endauth
        </div>
        <ul>
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

    </header>
    <!-- Content -->
    @yield('content')
    <!-- Navigation -->
    <nav class="navigation">
      <!-- <a class="nav-link" href="/"> <img src="{{asset('img/navigation/home.svg') }}" alt="nav-image">@lang('lang.home')</a> -->
      <a class="nav-link" href="{{ route('cellar.index') }}"> <img src="{{asset('img/navigation/my-collection.svg') }}" alt="nav-image">@lang('lang.cellars')</a>
      <a class="nav-link" href="{{ route('bottle.index') }}"> <img src="{{asset('img/navigation/catalog.svg') }}" alt="nav-image">@lang('lang.bottles')</a>
      @guest
        <a class="nav-link" href="{{ route('login') }}"><img src="{{asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.login')</a>
        @else
        <a class="nav-link" href="{{ route('logout') }}"><img src="{{asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.logout')</a>
        @endguest
      <!-- <a class="nav-link" href="{{ route('user.show') }}"> @lang('lang.profile')</a> -->
    </nav>
</body>
</html>