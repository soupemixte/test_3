<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')

    <footer>
        <div class="footer_nav">
            <a href="/">Home</a>
            <a href="#collection">Collection</a>
            <a href="{{ route('bottle.index') }}">Search</a>
            <a href="#profile">Profile</a>
        </div>
    </footer>
</body>


</html>