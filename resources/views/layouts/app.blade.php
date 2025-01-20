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
        <div class="scraping-controls">
            <button id="start-scraping" class="btn btn-success">Start Scraping</button>
            <button id="stop-scraping" class="btn btn-danger">Stop Scraping</button>
            <p id="scraping-status" style="margin-top: 10px;"></p>
            <span class="loader_start hide"></span>
            <span class="loader_stop hide"></span>
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

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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


    <script>
        document.getElementById('start-scraping').addEventListener('click', function () {
        const statusText = document.getElementById('scraping-status');
        const loaderStart = document.querySelector('.loader_start');
        const loaderStop = document.querySelector('.loader_stop');

        // Show the starting loader and hide the stopping loader
        loaderStart.classList.remove('hide');
        loaderStop.classList.add('hide');

        statusText.textContent = 'Scraping in progress...';
        
        

        fetch('/scrape-bouteilles')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = data.message;
                } else {
                    statusText.textContent = 'Scraping failed.';
                }
            })
            .catch(err => {
                console.error('Error during scraping:', err);
                statusText.textContent = 'An error occurred. Please try again.';
            })
            .finally(() => {
                // Hide the loader once scraping starts successfully
                loaderStart.classList.add('hide');
            });
    });


    document.getElementById('stop-scraping').addEventListener('click', function () {
        const statusText = document.getElementById('scraping-status');

        statusText.textContent = 'Stopping scraping...';

        fetch('/scraping/stop')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = data.message;
                    // Refresh the page after a short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000); // 1 second delay before refreshing
                } else {
                    statusText.textContent = 'Failed to stop scraping.';
                }
            })
            .catch(err => {
                console.error('Error during stop:', err);
                statusText.textContent = 'An error occurred while stopping scraping.';
            })
            .finally(() => {
                // Hide the loader once scraping stops successfully
                loaderStop.classList.add('hide');
            });
    });

    </script>



</body>
</html>