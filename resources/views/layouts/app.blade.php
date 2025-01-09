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
        <nav class="bot-nav">
            <ul class="navigation">
                <li>
                    <a href="/" class="nav-link">@lang('lang.home')</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('cellar.index') }}">@lang('lang.cellars')</a>
                </li>
                <li>
                    <a href="{{ route('bottle.index') }}" class="nav-link">@lang('lang.bottles')</a>
                </li>
                <li class="dropdown">@lang('lang.profile')
                <div class="dropdown-box">
                    @auth
                    @if(Auth::user()->isAdmin)
                        <a class="nav-link" href="{{ route('bottle.delete') }}">@lang('lang.delete_bottle')</a>
                        <a class="nav-link" href="{{ route('bottle.scrape') }}">@lang('lang.scrape_bottle')</a>
                    @endif
                    @endauth
                    <a class="nav-link" href="{{ route('lang', 'en') }}">@lang('lang.lang_en')</a>
                    <a class="nav-link" href="{{ route('lang', 'fr') }}">@lang('lang.lang_fr')</a>
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">@lang('lang.login')</a>
                    @else
                        <a class="nav-link" href="{{ route('logout') }}">@lang('lang.logout')</a>
                    @endguest
                </div>
                </li>
            </ul>
        </nav>
    </footer>


</body>
</html>