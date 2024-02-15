<html>

<head>

    <title>@yield('myTitle')</title>
    <link rel="stylesheet" href={{ asset('css/template.css') }}>

</head>

<header>

    <a href="{{ route('home') }}">Inicio</a>
    <a href="{{ route('add_view') }}">Add instrument</a>

    <div class="user">
        @if (auth()->user())
            <div class="user_img">
                @if (auth()->user()->logo)
                    <img src="uploads/users/{{ auth()->user()->logo }}">
                @else
                    <img src="img/default.png">
                @endif
            </div>
            <h3>Logged as {{ auth()->user()->name }}</h3>
        @endif
    </div>
    <a href="{{ route('logout') }}">Logout</a>
</header>

<body>

    @yield('content')

</body>
<footer>
    <p>All rights reserved</p>
</footer>

</html>
