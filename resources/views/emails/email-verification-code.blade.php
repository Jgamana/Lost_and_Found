<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Email Verification Code</title>
</head>

<body style="
    margin: 0;
    padding: 35px 20px;
    background: #f5f8f7;
    font-family: Arial, sans-serif;
">

    <div style="
        max-width: 500px;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid #e4eceb;
        border-radius: 20px;
        padding: 35px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(41, 73, 71, 0.08);
    ">

        <div style="
            width: 58px;
            height: 58px;
            margin: 0 auto 18px;
            border-radius: 17px;
            background: #e8f2f0;
            color: #365c5a;
            font-size: 26px;
            line-height: 58px;
            font-weight: bold;
        ">
            ✓
        </div>


        <div style="
            color: #d6a51d;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 7px;
        ">
            MLG Lost &amp; Found
        </div>


        <h2 style="
            margin: 0 0 10px;
            color: #294947;
            font-size: 22px;
            font-weight: 700;
        ">
            Verify Your Email
        </h2>


        <p style="
            margin: 0;
            color: #7b8d8b;
            font-size: 13px;
            line-height: 1.6;
        ">
            Use the verification code below to complete your registration.
        </p>


        <div style="
            margin: 25px 0 18px;
            padding: 18px 15px;
            background: #f1f7f6;
            border: 1px solid #e4eceb;
            border-radius: 13px;
            color: #365c5a;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 8px;
        ">
            {{ $code }}
        </div>


        <p style="
            margin: 0;
            color: #7b8d8b;
            font-size: 12px;
            line-height: 1.5;
        ">
            This verification code will expire in 10 minutes.
        </p>


        <div style="
            width: 45px;
            height: 3px;
            margin: 22px auto;
            background: #d6a51d;
            border-radius: 10px;
        ">
        </div>


        <p style="
            margin: 0;
            color: #999999;
            font-size: 11px;
            line-height: 1.5;
        ">
            If you did not create an account, you can safely ignore this email.
        </p>


        <p style="
            margin: 18px 0 0;
            color: #b0bab8;
            font-size: 10px;
        ">
            MLG College of Learning, Inc.
        </p>

    </div>

</body>
</html>