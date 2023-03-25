<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>linky - Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body class="text-center">

<main class="form-signin">
    <img src="images/logo-nobk.png" width="200">
    <p></p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
<!--        <h5 class="mb-3 fw-normal">/home</h5>-->
        <h1 class="h3 mb-3 fw-normal" style="color: #807f7f">Sign in</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <label for="floatingInput">{{ __('E-Mail Address') }}</label>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
            <label for="floatingPassword">{{ __('Password') }}</label>
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="checkbox mb-3">
            <label>
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                {{ __('Remember Me') }}
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Login') }}</button>
<!--        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>-->
    </form>
</main>



</body>
</html>


