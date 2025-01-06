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
        <nav class="mobile-fixed-footer">
            <ul class="navigation">
            @auth
                @if(Auth::user()->isAdmin)
                <li>@lang('lang.bottles')
                <ul class="dropdown">
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
                <ul class="dropdown hidden">
                    <li><a class="" href="{{ route('lang', 'en') }}">@lang('lang.lang_en')</a></li>
                    <li><a class="" href="{{ route('lang', 'fr') }}">@lang('lang.lang_fr')</a></li>
                </ul></li>
            </ul>
        </nav>
    </footer>

</body>
</html>