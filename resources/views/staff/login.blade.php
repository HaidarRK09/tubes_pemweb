<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff dan Pasien</title>
    <link rel="stylesheet" href="{{ asset('backend/css/login/login.css') }}">
</head>
<body>

	<div class="header">
		<a href="#default" class="logo">Klinik Cikijing</a>
	</div> 

<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" method="POST" action="{{ route('staff.login') }}">
                @csrf
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" name="username" class="login__input" placeholder="Username" required>
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" name="password" class="login__input" placeholder="Password" required>
                </div>
                @if($errors->has('login'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('login') }}
                    </div>
                @endif
                <button type="submit" class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
                
            </form>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>

</body>
</html>
