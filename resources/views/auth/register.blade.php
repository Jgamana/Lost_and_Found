<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Register | MLG Lost & Found
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
            background: #eef6f5;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: #d9ebe9;
            top: -260px;
            left: -180px;
            z-index: 0;
        }

        body::after {
            content: "";
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: #f5e8bd;
            bottom: -300px;
            right: -180px;
            z-index: 0;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 35px 20px;
            position: relative;
            z-index: 1;
        }

        .auth-container {
            width: 100%;
            max-width: 1050px;
            min-height: 650px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 18px 45px rgba(41, 73, 71, 0.14);
            display: flex;
            position: relative;
            overflow: hidden;
        }

        .top-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 52%;
            height: 75px;
            display: flex;
            align-items: center;
            padding: 0 45px;
            z-index: 5;
        }

        .system-name {
            font-size: 14px;
            font-weight: 700;
            color: #365c5a;
        }

        .form-section {
            width: 52%;
            padding: 105px 70px 45px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-content {
            width: 100%;
            max-width: 370px;
        }

        .form-title {
            text-align: center;
            color: #365c5a;
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .form-description {
            text-align: center;
            color: #7b8d8b;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            color: #365c5a;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 44px;
            border: 1px solid #dbe8e6;
            border-radius: 12px;
            padding: 0 15px;
            font-size: 13px;
            color: #263b3a;
            background: #fbfdfd;
        }

        .form-control:focus {
            border-color: #365c5a;
            box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.10);
            outline: none;
            background: #ffffff;
        }

        select.form-control {
            cursor: pointer;
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
            cursor: pointer;
            font-size: 16px;
        }

        .password-toggle:hover {
            color: #365c5a;
        }

        .register-btn {
            width: 100%;
            height: 44px;
            border: none;
            border-radius: 12px;
            background: #365c5a;
            color: white;
            font-size: 14px;
            font-weight: 600;
            margin-top: 5px;
            transition: 0.2s;
        }

        .register-btn:hover {
            background: #294947;
            color: white;
        }

        .register-btn:disabled {
            opacity: 0.75;
            cursor: not-allowed;
        }

        .login-text {
            text-align: center;
            font-size: 13px;
            color: #7b8d8b;
            margin-top: 20px;
        }

        .login-link {
            color: #365c5a;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .login-link:hover {
            color: #d6a51d;
        }

        .auth-alert {
            border-radius: 12px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .auth-alert ul {
            padding-left: 18px;
        }

        .visual-section {
            width: 48%;
            min-height: 650px;
            background: #365c5a;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visual-section::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(214, 165, 29, 0.18);
            top: -100px;
            right: -70px;
        }

        .visual-section::after {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            border-radius: 50%;
            border: 45px solid rgba(255, 255, 255, 0.08);
            bottom: -150px;
            left: -130px;
        }

        .circle-one,
        .circle-two,
        .circle-three {
            position: absolute;
            border-radius: 50%;
            border: 35px solid rgba(255, 255, 255, 0.10);
        }

        .circle-one {
            width: 550px;
            height: 550px;
            right: -330px;
            top: 45px;
        }

        .circle-two {
            width: 430px;
            height: 430px;
            right: -265px;
            top: 105px;
        }

        .circle-three {
            width: 310px;
            height: 310px;
            right: -205px;
            top: 165px;
        }

        .visual-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 30px;
        }

        .visual-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 22px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #d6a51d;
        }

        .visual-title {
            font-size: 29px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .visual-text {
            font-size: 14px;
            line-height: 1.7;
            max-width: 300px;
            margin: auto;
            color: rgba(255, 255, 255, 0.78);
        }

        .visual-highlight {
            display: inline-block;
            margin-top: 22px;
            padding: 8px 15px;
            border-radius: 50px;
            background: rgba(214, 165, 29, 0.18);
            border: 1px solid rgba(214, 165, 29, 0.35);
            color: #f7dda0;
            font-size: 12px;
            font-weight: 600;
        }

        .register-loading {
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

        .register-loading.show {
            opacity: 1;
            visibility: visible;
        }

        .loading-card {
            width: 210px;
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

        @keyframes loadingSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 800px) {

            .auth-container {
                min-height: auto;
                flex-direction: column;
                border-radius: 20px;
            }

            .top-header {
                position: relative;
                width: 100%;
                height: 70px;
                padding: 0 25px;
            }

            .form-section {
                width: 100%;
                padding: 30px 30px 40px;
            }

            .visual-section {
                width: 100%;
                min-height: 320px;
            }

            .circle-one {
                width: 400px;
                height: 400px;
                right: -260px;
            }

            .circle-two {
                width: 320px;
                height: 320px;
                right: -210px;
            }

            .circle-three {
                width: 240px;
                height: 240px;
                right: -160px;
            }

            .visual-icon {
                width: 80px;
                height: 80px;
                font-size: 38px;
            }

            .visual-title {
                font-size: 24px;
            }

        }

    </style>

</head>

<body>

<div class="auth-wrapper">

    <div class="auth-container">

        <div class="top-header">

            <span class="system-name">
                MLG Lost & Found System
            </span>

        </div>

        <div class="form-section">

            <div class="form-content">

                <h1 class="form-title">
                    Create Account
                </h1>

                <p class="form-description">
                    Register to access the MLG Lost & Found System
                </p>

                @if ($errors->any())

                    <div class="alert alert-danger auth-alert">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                @if (session('error'))

                    <div class="alert alert-danger auth-alert">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        {{ session('error') }}

                    </div>

                @endif

                @if (session('success'))

                    <div class="alert alert-success auth-alert">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                    </div>

                @endif

                <form
                    action="{{ route('register') }}"
                    method="POST"
                >

                    @csrf

                    <div class="form-group">

                        <label class="form-label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Email
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
                            Account Type
                        </label>

                        <select
                            name="role"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Select account type
                            </option>

                            <option
                                value="student"
                                {{ old('role') === 'student' ? 'selected' : '' }}
                            >
                                Student
                            </option>

                            <option
                                value="faculty"
                                {{ old('role') === 'faculty' ? 'selected' : '' }}
                            >
                                Faculty
                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                name="password"
                                id="registerPassword"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="toggleRegisterPassword(
                                    'registerPassword',
                                    'registerPasswordIcon'
                                )"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="registerPasswordIcon"
                                ></i>

                            </button>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                name="password_confirmation"
                                id="registerPasswordConfirmation"
                                class="form-control"
                                placeholder="Confirm your password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="toggleRegisterPassword(
                                    'registerPasswordConfirmation',
                                    'registerPasswordConfirmationIcon'
                                )"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="registerPasswordConfirmationIcon"
                                ></i>

                            </button>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="register-btn"
                    >
                        Create Account
                    </button>

                </form>

                <div class="login-text">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        class="login-link"
                    >
                        Login
                    </a>

                </div>

            </div>

        </div>

        <div class="visual-section">

            <div class="circle-one"></div>

            <div class="circle-two"></div>

            <div class="circle-three"></div>

            <div class="visual-content">

                <div class="visual-icon">
                    <i class="bi bi-search"></i>
                </div>

                <div class="visual-title">
                    Lost & Found
                </div>

                <p class="visual-text">
                    A simple way for students and faculty
                    to report, find, and recover lost belongings.
                </p>

                <div class="visual-highlight">
                    MLG COLLEGE OF LEARNING, INC.
                </div>

            </div>

        </div>

    </div>

</div>

<div id="registerLoading" class="register-loading">

    <div class="loading-card">

        <div class="loading-spinner"></div>

        <div class="loading-title">
            Creating account...
        </div>

        <div class="loading-text">
            Sending verification code
        </div>

    </div>

</div>

<script>

function toggleRegisterPassword(
    inputId,
    iconId
) {

    const password =
        document.getElementById(inputId);

    const icon =
        document.getElementById(iconId);

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

document.addEventListener('DOMContentLoaded', function () {

    const registerForm =
        document.querySelector(
            'form[action="{{ route('register') }}"]'
        );

    const loadingScreen =
        document.getElementById('registerLoading');

    const registerButton =
        document.querySelector('.register-btn');

    if (
        registerForm &&
        loadingScreen &&
        registerButton
    ) {

        registerForm.addEventListener(
            'submit',
            function () {

                loadingScreen.classList.add('show');

                registerButton.disabled = true;

                registerButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span> Sending code...';

            }
        );

    }

});

</script>

</body>

</html>