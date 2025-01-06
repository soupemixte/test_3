<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"> -->
    <meta name="author" content="Equipe #1">
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo"><h1>VINO</h1></div>
    </header>
    <!-- Content -->
    @yield('content')
    <!-- Navigation -->
    <footer>
        <nav>
            <ul>
            @auth
                @if(Auth::user()->isAdmin)
                <li>@lang('lang.bottles')
                <ul>
                    <li><a href="{{ route('bottle.delete') }}">@lang('lang.delete_bottle')</a></li>
                    <li><a href="{{ route('bottle.scrape') }}">@lang('lang.scrape_bottle')</a></li>
                </ul></li>
                @endif
            @endauth
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">@lang('lang.login')</a></li>
            @else
                <li><a class="nav-link" href="{{ route('logout') }}">@lang('lang.logout')</a></li>
            @endguest
                <li>@lang('lang.lang')
                <ul>
                    <li><a class="nav-link" href="{{ route('lang', 'en') }}">@lang('lang.lang_en')</a></li>
                    <li><a class="nav-link" href="{{ route('lang', 'fr') }}">@lang('lang.lang_fr')</a></li>
                </ul></li>
            </ul>
        </nav>
    </footer>
    <!-- <nav class="navigation">
      <a class="nav-link" href="/"> <img src="{{asset('img/navigation/home.svg') }}" alt="nav-image">@lang('lang.home')</a>
      <a class="nav-link" href="{{ route('cellar.index') }}"> <img src="{{asset('img/navigation/my-collection.svg') }}" alt="nav-image">@lang('lang.cellars')</a>
      <a class="nav-link" href="{{ route('bottle.index') }}"> <img src="{{asset('img/navigation/catalog.svg') }}" alt="nav-image">@lang('lang.bottles')</a>
      <a class="nav-link" href="{{ route('user.show') }}"> <img src="{{asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.profile')</a>
    </nav> -->
</body>
</html>