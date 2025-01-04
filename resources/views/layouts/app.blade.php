<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
    <title>@yield('title')</title>
    <style>
        nav {
            height: 100px;
            display: block;
            position: absolute;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('user.create') }}"></a></li>
            </ul>
        </nav>
    </header>
    @yield('content')
</body>


</html>