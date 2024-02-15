<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
    <link rel="stylesheet" href={{ asset('css/user.css') }}>
</head>

<body>
	<form action="{{route('login')}}" method="post">
        @csrf
		<p id="error"></p>
		<input type="text" id="name" name="name" placeholder="User" value="">

		<input type="password" id="password" name="password" placeholder="Password">

		<input type="submit" value="SIGN IN" name="signin">

		<a href="{{route('register')}}">Not a member? Sign up now</a>

		<a href="forgot_password.php">Did you forget your password?</a>

	</form>
</body>
</html>
