<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Login | MasWe Farmhouse</title>
    <link rel="stylesheet" href="{{ asset('frontend/style/login.css') }}">
    <link href="{{ asset('frontend/library/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header>Login Form</header>
        <form autocomplete="off" action="{{ route('dashboard-login') }}" method="POST">
          @csrf
          <div class="field">
            <span class="fa fa-user" ></span>
            <input type="email" name="email"  required placeholder="Email">
          </div>
          <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" name="password" class="pass-key" required placeholder="Password">
          </div>
          <div class="pass">
            <a href="#">Forgot Password?</a>
          </div>
          <div class="field">
            <input style="border-radius: 8px;" type="submit" value="LogIn">
          </div>
        </form>
        <div class="login">Or login with</div>
        <div class="links">
          <div class="google">
            <a href="{{ route('user.login.google') }}" style="color:#fff;"><i class="fab fa-google"><span>Google</span></i></a>
          </div>
        </div>
        <div class="signup">Don't have account?
          <a href="{{ route('frontend.register') }}">Signup Now</a>
        </div>
      </div>
    </div>
  </body>
</html>
