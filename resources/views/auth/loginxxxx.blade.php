<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Netizens Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/pages/auth.css')}}">
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/logo/favicon.png')}}" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="{{ asset('dist/assets/images/logo/sesarengan.png')}}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <!-- <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p> -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" type="email" name="email" class="form-control form-control-xl" placeholder="Email" :value="old('email')" tabindex="1" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password" type="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold"
                                style="color: #256f6a;">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html" style="color: #256f6a;">Forgot
                                password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="background-color: aqua;">

                </div>
            </div>
        </div>

    </div>
</body>

</html>