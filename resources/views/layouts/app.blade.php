<!DOCTYPE html>
<html lang="fr">
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
    
    <header class="header flex-col">
        @if(session('success'))
        <div class="alert success">
            
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close">X</button>
        </div>
        @endif
    
        @if(session('errors'))
            @if(session('errors')->has('password'))
                <div class="alert warning flex-center just-between">
                <p>Assurez vous d'avoir les bonnes informations du compte.</p>
                    <button type="button" class="btn-close">X</button>
                </div>
            @endif
        @endif
    
        @if(session('warning'))
            <div class="alert warning">
                <p>{{ session('warning') }}</p>
                <button type="button" class="btn-close">X</button>
            </div>
        @endif
    <!-- Header -->
     <div class="flex-center">

         <div class="logo">
             <img src="{{ asset('img/header/vino_logo_final.svg') }}" alt="Logo Vino">
         </div>
         
     </div>
    </header>

    


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
            <a class="nav-link {{ Request::routeIs('cellar.index') ? 'active' : '' }}" href="{{ route('cellar.index') }}"> <i class="fa-solid fa-warehouse"></i>@lang('lang.cellars')</a>
            <a class="nav-link {{ Request::routeIs('bottle.index') ? 'active' : '' }}" href="{{ route('bottle.index') }}"> <i class="fa-solid fa-bottle-droplet"></i>@lang('lang.bottles')</a>
            <a class="nav-link {{ Request::routeIs('user.show') ? 'active' : '' }}" href="{{ route('user.show', Auth::id()) }}"><i class="fa-solid fa-address-card"></i>Profil</a>
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
  <a class="nav-link" href="{{ route('user.login') }}">
  <i class="fa-solid fa-right-to-bracket"></i>@lang('lang.login')
  </a>
@else
  @if($isAdmin)
    <!-- Admin logged in -->
    <a class="nav-link" href="{{ route('logout') }}">
    <i class="fa-solid fa-right-from-bracket"></i>@lang('lang.logout') (Admin)
    </a>
  @elseif($isUser)
    <!-- User logged in -->
    <!-- <a class="nav-link" href="{{ route('logout') }}">
    <i class="fa-solid fa-right-from-bracket"></i>@lang('lang.logout')
    </a> -->
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