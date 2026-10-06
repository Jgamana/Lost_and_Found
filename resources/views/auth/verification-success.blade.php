<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Email Verified | MLG Lost & Found</title>

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
            align-items: center;
            justify-content: center;
        }

        .verification-card {
            width: 330px;
            max-width: 100%;
            background: #ffffff;
            border: 1px solid #e4eceb;
            border-radius: 22px;
            padding: 32px 28px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(41, 73, 71, 0.10);
        }

        .verification-icon {
            width: 62px;
            height: 62px;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: #e8f2f0;
            color: #365c5a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 700;
        }

        .verification-title {
            color: #294947;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .verification-text {
            color: #7b8d8b;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .loading-spinner {
            width: 36px;
            height: 36px;
            margin: 0 auto;
            border: 4px solid #e4efed;
            border-top-color: #365c5a;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .loading-text {
            color: #365c5a;
            font-size: 11px;
            font-weight: 600;
            margin-top: 12px;
        }

        .verification-line {
            width: 45px;
            height: 3px;
            margin: 20px auto 0;
            background: #d6a51d;
            border-radius: 10px;
        }

        @keyframes spin {

            to {
                transform: rotate(360deg);
            }

        }

        @media (max-width: 480px) {

            .verification-card {
                width: 100%;
                padding: 28px 22px;
            }

        }

    </style>

</head>

<body>

<div class="verification-page">

    <div class="verification-card">

        <div class="verification-icon">
            ✓
        </div>


        <div class="verification-title">
            Email Verified!
        </div>


        <div class="verification-text">
            Your email address has been successfully verified.
        </div>


        <div class="loading-spinner"></div>


        <div class="loading-text">
            Logging you in...
        </div>


        <div class="verification-line"></div>

    </div>

</div>


<script>

    setTimeout(function () {

        window.location.href = "{{ url('/student/dashboard') }}";

    }, 1500);

</script>

</body>
</html>