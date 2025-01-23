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
    <div class="logo">
        <img src="{{ asset('img/header/vino-logo-horizontale.svg') }}" alt="Logo Vino">
    </div>
    <ul>
        <div class="dropdown">
            <img src="{{ asset('img/navigation/language.png')}}" alt="language settings">
            <div class="dropdown-box">
                <a href="{{ route('lang', 'en') }}">@lang('lang.lang_en')</a>
                <a href="{{ route('lang', 'fr') }}">@lang('lang.lang_fr')</a>
            </div>
        </div>  
    </ul>

    </header>

    @if(session('success'))
    <div class="alert success">
        <p>{{ session('success') }}</p>
        <button type="button" class="btn-close">X</button>
    </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            <p>{{ session('error') }}</p>
            <button type="button" class="btn-close">X</button>
        </div>
    @endif


    <!-- Success Modal -->
    <div id="successModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button type="button" class="btn-close" id="closeModal">&times;</button>
            <p id="successMessage"></p>
        </div>
    </div>
    <!-- Content -->
    @yield('content')
    <!-- Navigation -->
    <nav class="navigation">
        <!-- Visible for regular users only -->
        @auth('web')
            <a class="nav-link" href="/"> <img src="{{asset('img/navigation/home.svg') }}" alt="nav-image">@lang('lang.home')</a>
            <a class="nav-link" href="{{ route('cellar.index') }}"> <img src="{{asset('img/navigation/my-collection.svg') }}" alt="nav-image">@lang('lang.cellars')</a>
            <a class="nav-link" href="{{ route('bottle.index') }}"> <img src="{{asset('img/navigation/catalog.svg') }}" alt="nav-image">@lang('lang.bottles')</a>
        @endauth
        @auth('admin')
            <a class="nav-link" href="{{ route('admin.dashboard') }}"> 
                <img src="{{asset('img/navigation/dashboard.png') }}" alt="nav-image">@lang('lang.dashboard')
            </a>
        @endauth
        @php
    $isAdmin = Auth::guard('admin')->check(); // Check if admin is logged in
    $isUser = Auth::guard('web')->check();    // Check if user is logged in
@endphp

@if(!$isAdmin && !$isUser)
  <!-- Guest: Not logged in -->
  <a class="nav-link" href="{{ route('auth.connection') }}">
    <img src="{{ asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.login')
  </a>
@else
  @if($isAdmin)
    <!-- Admin logged in -->
    <a class="nav-link" href="{{ route('logout') }}">
      <img src="{{ asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.logout') (Admin)
    </a>
  @elseif($isUser)
    <!-- User logged in -->
    <a class="nav-link" href="{{ route('logout') }}">
      <img src="{{ asset('img/navigation/profile.svg') }}" alt="nav-image">@lang('lang.logout')
    </a>
  @endif
@endif
    </nav>

    <!-----Script général réutilisable pour masquer la modale------>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const closeButtons = document.querySelectorAll(".btn-close");

        closeButtons.forEach(button => {
            button.addEventListener("click", function () {
                const alert = this.parentElement;
                alert.classList.add("hide");
            });
        });
    });

    </script>


    



</body>
</html>