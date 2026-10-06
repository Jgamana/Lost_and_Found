<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Verify Email | MLG Lost & Found</title>

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
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f8f7;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .verification-page {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .verification-card {
            width: 420px;
            max-width: 100%;
            background: #ffffff;
            border: 1px solid #e4eceb;
            border-radius: 22px;
            padding: 34px 30px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(41, 73, 71, 0.10);
        }

        .verification-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 19px;
            border-radius: 18px;
            background: #e8f2f0;
            color: #365c5a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .verification-label {
            color: #d6a51d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .verification-card h2 {
            color: #294947;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .verification-card > p {
            color: #7b8d8b;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .alert {
            font-size: 12px;
            text-align: left;
            border-radius: 11px;
            border: none;
            margin-bottom: 16px;
        }

        .code-input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dfe8e6;
            border-radius: 12px;
            background: #fbfcfc;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 8px;
            color: #365c5a;
            outline: none;
            transition: 0.2s ease;
        }

        .code-input::placeholder {
            color: #b8c5c3;
            opacity: 1;
        }

        .code-input:focus {
            background: #ffffff;
            border-color: #365c5a;
            box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.10);
        }

        .verify-button {
            width: 100%;
            margin-top: 17px;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: #365c5a;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .verify-button:hover {
            background: #294947;
        }

        .resend-button {
            margin-top: 16px;
            border: none;
            background: transparent;
            color: #365c5a;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
        }

        .resend-button:hover {
            color: #294947;
            text-decoration: underline;
        }

        .verification-divider {
            width: 45px;
            height: 3px;
            margin: 20px auto 0;
            background: #d6a51d;
            border-radius: 10px;
        }

        @media (max-width: 480px) {

            body {
                padding: 15px;
            }

            .verification-card {
                padding: 28px 21px;
                border-radius: 19px;
            }

            .verification-card h2 {
                font-size: 20px;
            }

            .code-input {
                font-size: 21px;
                letter-spacing: 6px;
            }

        }

    </style>

</head>

<body>

<div class="verification-page">

    <div class="verification-card">

        <div class="verification-icon">
            <i class="bi bi-envelope-check"></i>
        </div>


        <div class="verification-label">
            Account Verification
        </div>


        <h2>
            Verify Your Email
        </h2>


        <p>
            We sent a 6-digit verification code to your email address.
            Enter the code below to complete your registration.
        </p>


        @if(session('success'))

            <div class="alert alert-success">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ $errors->first('code') }}
            </div>

        @endif


        <form
            action="{{ route('verification.verify') }}"
            method="POST"
        >

            @csrf

            <input
                type="text"
                name="code"
                class="code-input"
                maxlength="6"
                inputmode="numeric"
                pattern="[0-9]{6}"
                placeholder="000000"
                autocomplete="one-time-code"
                required
            >


            <button
                type="submit"
                class="verify-button"
            >

                <i class="bi bi-check-circle me-1"></i>

                Verify Email

            </button>

        </form>


        <form
            action="{{ route('verification.resend') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="resend-button"
            >

                <i class="bi bi-arrow-repeat me-1"></i>

                Resend Code

            </button>

        </form>


        <div class="verification-divider"></div>

    </div>

</div>

</body>
</html>