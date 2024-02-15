<html>

<head>

    <title>@yield('myTitle')</title>
    <link rel="stylesheet" href={{ asset('css/template.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
    <nav class="navbar navbar-expand-lg custom-navbar-color ms-3 me-3 mt-2 rounded">
        <div class="container-fluid">
            <a class="navbar-brand me-auto ms-3" href="{{ route('home') }}"><strong>Bandaw</strong></a>
            <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                @if (auth()->user())
                <h4 class="mx-4 my-2">Logged as {{ auth()->user()->name }}</h4>
                <img src="uploads/users/{{ auth()->user()->logo }}" alt="Logo" width="50" height="50"
                    class="d-inline-block align-text-top rounded-circle">
                @endif
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    <a class="nav-link" href="{{ route('add_view') }}">Add instrument</a>
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    
<body class="custom-container-color">

    @yield('content')

</body>
<footer class="footer bg-dark text-white text-center py-2 mt-5">
    <div class="container">
        <span>© 2024 All rights reserved</span>
    </div>
</footer>


</html>
