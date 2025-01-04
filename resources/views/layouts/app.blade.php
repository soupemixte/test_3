<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" />
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
    </header>
    @yield('content')

    <!-- Navigation -->
    <!-- FIXME: if active navigation link is highlighted -->
    <nav class="navigation">
      <button class="nav-button"><a href="/">Home</a></button>
      <button class="nav-button"><a href="{{ route('cellar.index') }}">Collection</a></button>
      <button class="nav-button"><a href="{{ route('bottle.index') }}">List</a></button>
      <button class="nav-button"><a href="{{ route('login') }}">Login</a></button>
    </nav>
</body>


</html>