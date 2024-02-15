<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href={{ asset('css/user.css') }}>
</head>

<body>
    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p id="error"></p>
        <div id="registrationForm">

            <input type="text" id="bandname" name="bandname" placeholder="Band Name" value="{{ old("bandname") }}>
            @error('bandname')
                <p style="color:red"> {{ $message }}</p>
            @enderror
            <input type="email" id="email" name="email" placeholder="Email" value="{{ old("email") }}>
            @error('email')
                <p style="color:red"> {{ $message }}</p>
            @enderror
            <input type="text" id="username" name="username" placeholder="Username" value="{{ old("username") }}>
            @error('username')
                <p style="color:red"> {{ $message }}</p>
            @enderror
            <input type="password" id="password" name="password" placeholder="Password">
            @error('password')
                <p style="color:red"> {{ $message }}</p>
            @enderror
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
            @error('password_confirmation')
                <p style="color:red"> {{ $message }}</p>
            @enderror
            <input type="file" id="formFile" name="user_img">
            <input type="submit" value="REGISTER" name="register">

        </div>

        <a id="goLogin" href="{{ route('login') }}">Already a member? Go login.</a>
        {{-- <div id="registrationSuccess" style="display: none;">
				<p>Registration successful. You are now a member of our website!</p> 
            </div> --}}
    </form>
    <div id="login_button" style="display: none;">
        <form action="{{ route('login') }}">
            <input type="submit" value="GO LOGIN">
        </form>
    </div>

    

</body>

</html>
