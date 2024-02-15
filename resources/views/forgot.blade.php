<!DOCTYPE html>
<html>

<head>
    <title>Pass Forgotten Form</title>
    <link rel="stylesheet" href={{ asset('css/user.css') }}>
</head>

<body>



    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($success))
            <div class="alert alert-danger">
                <p style="color:green">{{ $success }}</p>
            </div>
        @else
            @if (isset($error))
                <div class="alert alert-danger">
                    <p style="color:red">{{ $error }}</p>
                </div>
            @endif
            <p id="error"></p>
            <div id="registrationForm">
                <input type="text" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <p style="color:red">{{ $message }}</p>
                @enderror
                <input type="submit" value="SEND" name="send">
            </div>
        @endif
        <a id="goLogin" href="{{ route('login') }}">Go login if you shouldn't be here.</a>
    </form>
    <div id="login_button" style="display: none;">
        <form action="{{ route('login') }}">
            <input type="submit" value="GO LOGIN">
        </form>
    </div>
</body>


</html>
