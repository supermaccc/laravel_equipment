<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'IBM Plex Sans', sans-serif;
        font-family: 'IBM Plex Sans Thai', sans-serif;
    }
</style>
<body>
    <div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<h2>Don't have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<div class="login-show">
                <form action="/login" method="post">
                    <h2>LOGIN</h2>
                    <input type="text" name="name" id="name" placeholder="username" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <input type="submit" id="login_btn" value="Login">
                </form>
			</div>
			<div class="register-show">
                    <h2>REGISTER</h2>
                    <input type="text" name="name" id="r_name" placeholder="User Name" required>
                    <input type="email" name="email" id="r_email" placeholder="Email" required>
                    <input type="password" name="password" id="r_password" placeholder="Password" required>
                    <input type="password" name="c_password" id="c_password" placeholder="Confirm Password" required>
                    <input type="submit" id="register_btn" value="Register">
			</div>
		</div>
	</div>
    <div id="equipmentIndexRoute" data-route="{{ route('equipment_index') }}"></div>
    <div id="requestIndexRoute" data-route="{{ route('request') }}"></div>
</body>
<script src="/assets/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="/assets/js/login.js"></script>
<script>
    var baseUrl = "{{ url('/') }}";
</script>
</html>



 
 

