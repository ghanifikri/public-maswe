<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Transparent Login Form UI</title>
    <link rel="stylesheet" href="{{ asset('frontend/style/login.css') }}">
    <link href="{{ asset('frontend/library/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>Register Form</header>
            <form action="{{ route('register') }}" method="POST" autocomplete="off">
                @csrf
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="name" required placeholder="Full Name">
                </div>
                <div class="field space">
                    <span class="fa fa-envelope"></span>
                    <input type="email" name="email" required placeholder="Email or Phone">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input id="password" type="password" name="password" class="pass-key" required
                        placeholder="Password">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input id="password_confirmation" type="password" class="pass-key1" name="password_confirmation"
                        required placeholder="Confirm Password">
                </div>
                <div class="field space">
                    <input style="border-radius: 8px;" type="submit" value="Register">
                </div>
            </form>
            <div class="login">Or sign up with</div>
            <div class="links">
                <div class="google">
                    <i class="fab fa-google"><span>Google</span></i>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
