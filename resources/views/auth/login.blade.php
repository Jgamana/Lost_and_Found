<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Login | MLG Lost & Found
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f3f7f6;
            color: #263b3a;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1050px;
            min-height: 610px;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 15px 45px rgba(38, 59, 58, 0.10);
            border: 1px solid #e4eceb;
        }

        .auth-form-section {
            width: 55%;
            padding: 55px 75px;
            display: flex;
            align-items: center;
        }

        .auth-form-content {
            width: 100%;
            max-width: 390px;
            margin: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 38px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #e4f0ef;
            color: #365c5a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .brand-text {
            color: #365c5a;
            font-size: 14px;
            font-weight: 700;
        }

        .brand-subtitle {
            color: #7b8d8b;
            font-size: 10px;
            margin-top: 2px;
        }

        .auth-title {
            color: #263b3a;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .auth-description {
            color: #7b8d8b;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #365c5a;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            height: 46px;
            border: 1px solid #e4eceb;
            border-radius: 11px;
            padding: 0 15px;
            font-size: 13px;
            color: #263b3a;
            background: #fbfdfd;
        }

        .form-control:focus {
            border-color: #365c5a;
            box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.10);
            background: white;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #7b8d8b;
            padding: 0;
        }

        .password-toggle:hover {
            color: #365c5a;
        }

        .forgot-password {
            text-align: right;
            margin-top: -8px;
            margin-bottom: 22px;
        }

        .forgot-password a {
            color: #365c5a;
            font-size: 12px;
            text-decoration: none;
        }

        .forgot-password a:hover {
            color: #d6a51d;
        }

        .login-button {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 11px;
            background: #365c5a;
            color: white;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #294947;
            color: white;
        }

        .register-text {
            text-align: center;
            color: #7b8d8b;
            font-size: 13px;
            margin-top: 24px;
        }

        .register-link {
            color: #365c5a;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .register-link:hover {
            color: #d6a51d;
        }

        .auth-alert {
            border-radius: 11px;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .auth-visual {
            width: 45%;
            background: #365c5a;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .auth-visual::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            border-radius: 50%;
            border: 55px solid rgba(214, 165, 29, 0.18);
            right: -155px;
            top: -75px;
        }

        .auth-visual::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            border: 35px solid rgba(255, 255, 255, 0.08);
            left: -145px;
            bottom: -80px;
        }

        .visual-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 40px;
        }

        .visual-icon {
            width: 86px;
            height: 86px;
            border-radius: 22px;
            margin: 0 auto 22px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #d6a51d;
        }

        .visual-title {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .visual-text {
            max-width: 310px;
            margin: auto;
            color: rgba(255, 255, 255, 0.72);
            font-size: 13px;
            line-height: 1.7;
        }

        .visual-line {
            width: 45px;
            height: 3px;
            border-radius: 5px;
            background: #d6a51d;
            margin: 20px auto;
        }

        @media (max-width: 800px) {

            .auth-container {
                flex-direction: column;
                min-height: auto;
            }

            .auth-form-section {
                width: 100%;
                padding: 40px 28px;
            }

            .auth-visual {
                width: 100%;
                min-height: 280px;
            }

            .brand {
                margin-bottom: 28px;
            }

            .auth-title {
                font-size: 26px;
            }

            .visual-title {
                font-size: 23px;
            }

        }


        .login-loading {
    position: fixed;
    inset: 0;
    background: rgba(41, 73, 71, 0.18);
    backdrop-filter: blur(3px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: 0.2s ease;
}

.login-loading.show {
    opacity: 1;
    visibility: visible;
}

.loading-card {
    width: 190px;
    background: white;
    border-radius: 18px;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(41, 73, 71, 0.20);
}

.loading-spinner {
    width: 38px;
    height: 38px;
    margin: 0 auto 14px;
    border: 4px solid #e4efed;
    border-top-color: #365c5a;
    border-radius: 50%;
    animation: loadingSpin 0.8s linear infinite;
}

.loading-title {
    color: #365c5a;
    font-size: 14px;
    font-weight: 700;
}

.loading-text {
    color: #7b8d8b;
    font-size: 11px;
    margin-top: 4px;
}

.button-spinner {
    display: inline-block;
    width: 14px;
    height: 14px;
    margin-right: 7px;
    vertical-align: -2px;
    border: 2px solid rgba(255,255,255,0.4);
    border-top-color: white;
    border-radius: 50%;
    animation: loadingSpin 0.7s linear infinite;
}

@keyframes loadingSpin {
    to {
        transform: rotate(360deg);
    }
}

    </style>

</head>

<body>

<div class="auth-wrapper">

    <div class="auth-container">

        <div class="auth-form-section">

            <div class="auth-form-content">

                <div class="brand">

                    <!-- <div class="brand-icon">
                        <i class="bi bi-search"></i>
                    </div> -->

                    <div>

                        <div class="brand-text">
                            MLG Lost & Found
                        </div>

                        <div class="brand-subtitle">
                            MLG College of Learning, Inc.
                        </div>

                    </div>

                </div>


                <h1 class="auth-title">
                    Welcome Back
                </h1>

                <p class="auth-description">
                    Sign in to access your Lost & Found account.
                </p>


                @if($errors->any())

                    <div class="alert alert-danger auth-alert">

                        <ul class="mb-0 ps-3">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                @if(session('success'))

                    <div class="alert alert-success auth-alert">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                    </div>

                @endif


                <form
                    action="{{ url('/login') }}"
                    method="POST"
                >

                    @csrf


                    <div class="form-group">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                name="password"
                                id="loginPassword"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="passwordIcon"
                                ></i>

                            </button>

                        </div>

                    </div>


                    <div class="forgot-password">

                        <a href="#">
                            Forgot password?
                        </a>

                    </div>


                    <button
                        type="submit"
                        class="login-button"
                    >

                        <i class="bi bi-box-arrow-in-right me-2"></i>

                        Login

                    </button>

                </form>


                <div class="register-text">

                    Don't have an account?

                    <a
                        href="{{ route('register') }}"
                        class="register-link"
                    >
                        Create an account
                    </a>

                </div>

            </div>

        </div>


        <div class="auth-visual">

            <div class="visual-content">

                <div class="visual-icon">

                    <i class="bi bi-search"></i>

                </div>

                <div class="visual-title">
                    Lost & Found
                </div>

                <div class="visual-line"></div>

                <p class="visual-text">
                    A simple and organized way to report,
                    manage, find, and recover lost belongings
                    within MLG College of Learning, Inc.
                </p>

            </div>

        </div>

    </div>

</div>


<script>

function togglePassword() {

    const password =
        document.getElementById('loginPassword');

    const icon =
        document.getElementById('passwordIcon');

    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }

}



</script>

<div id="loginLoading" class="login-loading">

    <div class="loading-card">

        <div class="loading-spinner"></div>

        <div class="loading-title">
            Logging in...
        </div>

        <div class="loading-text">
            Please wait
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const loginForm = document.querySelector('form[action="{{ url('/login') }}"]');
    const loadingScreen = document.getElementById('loginLoading');
    const loginButton = document.querySelector('.login-btn');

    if (loginForm) {

        loginForm.addEventListener('submit', function () {

            loadingScreen.classList.add('show');

            loginButton.disabled = true;

            loginButton.innerHTML =
                '<span class="button-spinner"></span> Logging in...';

        });

    }

});
</script>

</body>

</html>