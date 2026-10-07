<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        MLG Lost & Found
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

        :root {
            --teal: #365c5a;
            --teal-dark: #294947;
            --gold: #d6a51d;
            --gold-light: #e8d28a;
            --text: #263b3a;
            --muted: #7b8d8b;
            --border: #e4eceb;
            --light: #f7faf9;
            --background: #f4f9f8;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #ffffff;
            color: var(--text);
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        body.modal-open {
            overflow: hidden;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        /* --------------------------------------------------
           NAVBAR
        -------------------------------------------------- */

        .landing-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
        }

        .navbar-container {
            width: min(1120px, calc(100% - 40px));
            margin: auto;
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--teal);
            font-size: 15px;
            font-weight: 700;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f2f0;
            color: var(--teal);
            border-radius: 12px;
            font-size: 20px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-link-item {
            color: #667674;
            font-size: 13px;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .nav-link-item:hover {
            color: var(--teal);
        }

        .nav-login {
            border: none;
            background: transparent;
            color: var(--teal);
            font-size: 13px;
            font-weight: 700;
            padding: 0;
            cursor: pointer;
        }

        .nav-register {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 17px;
            border: none;
            border-radius: 11px;
            background: var(--teal);
            color: white;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .nav-register:hover {
            background: var(--teal-dark);
            color: white;
            transform: translateY(-1px);
        }

        /* --------------------------------------------------
           HERO
        -------------------------------------------------- */

        .hero {
            position: relative;
            overflow: hidden;
            background: var(--background);
            min-height: 620px;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            right: -100px;
            top: -150px;
            border-radius: 50%;
            background: rgba(54, 92, 90, 0.09);
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            left: -130px;
            bottom: -145px;
            border-radius: 50%;
            background: rgba(214, 165, 29, 0.10);
        }

        .hero-container {
            position: relative;
            z-index: 2;
            width: min(1120px, calc(100% - 40px));
            margin: auto;
            display: grid;
            grid-template-columns:
                minmax(0, 1.15fr)
                minmax(320px, 0.85fr);
            gap: 70px;
            align-items: center;
            padding: 75px 0;
        }

        .hero-content {
            max-width: 650px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 13px;
            border-radius: 20px;
            background: #e8f2f0;
            color: var(--teal);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin-bottom: 18px;
        }

        .hero-label i {
            color: var(--gold);
        }

        .hero-title {
            color: var(--text);
            font-size: clamp(42px, 5vw, 66px);
            font-weight: 700;
            line-height: 1.02;
            letter-spacing: -2px;
            margin: 0 0 20px;
        }

        .hero-title span {
            color: var(--teal);
        }

        .hero-text {
            max-width: 620px;
            color: #667674;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 19px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .hero-button-primary {
            border: none;
            background: var(--teal);
            color: white;
        }

        .hero-button-primary:hover {
            background: var(--teal-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow:
                0 8px 20px rgba(41, 73, 71, 0.16);
        }

        .hero-button-secondary {
            background: white;
            color: var(--teal);
            border: 1px solid var(--border);
        }

        .hero-button-secondary:hover {
            background: #f7faf9;
            color: var(--teal);
            transform: translateY(-2px);
        }

        /* --------------------------------------------------
           HERO DECORATION
        -------------------------------------------------- */

        .hero-visual {
            position: relative;
            min-height: 390px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visual-circle-large {
            position: absolute;
            width: 310px;
            height: 310px;
            border-radius: 50%;
            background: #e4f0ef;
        }

        .visual-circle-small {
            position: absolute;
            width: 110px;
            height: 110px;
            right: 10px;
            top: 20px;
            border-radius: 50%;
            background: #fbf2d7;
        }

        .visual-circle-bottom {
            position: absolute;
            width: 80px;
            height: 80px;
            left: 25px;
            bottom: 30px;
            border-radius: 50%;
            background: rgba(214, 165, 29, 0.15);
        }

        .visual-icon-main {
            position: relative;
            z-index: 3;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: white;
            color: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 78px;
            box-shadow:
                0 20px 50px rgba(41, 73, 71, 0.12);
        }

        .visual-floating {
            position: absolute;
            z-index: 4;
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow:
                0 12px 30px rgba(41, 73, 71, 0.12);
        }

        .visual-floating-one {
            top: 80px;
            left: 45px;
            background: white;
            color: var(--teal);
        }

        .visual-floating-two {
            right: 45px;
            bottom: 75px;
            background: var(--gold);
            color: white;
        }

        .visual-floating-three {
            right: 95px;
            top: 65px;
            background: var(--teal);
            color: white;
        }

        /* --------------------------------------------------
           SECTION
        -------------------------------------------------- */

        .section {
            padding: 85px 0;
        }

        .section-container {
            width: min(1120px, calc(100% - 40px));
            margin: auto;
        }

        .section-heading {
            max-width: 650px;
            margin: 0 auto 45px;
            text-align: center;
        }

        .section-label {
            color: var(--gold);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .section-title {
            color: var(--text);
            font-size: clamp(28px, 4vw, 38px);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-text {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* --------------------------------------------------
           FEATURES
        -------------------------------------------------- */

        .feature-grid {
            display: grid;
            grid-template-columns:
                repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .feature-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 25px;
            min-height: 205px;
            transition: 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow:
                0 12px 30px rgba(41, 73, 71, 0.08);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #e8f2f0;
            color: var(--teal);
            font-size: 21px;
            margin-bottom: 18px;
        }

        .feature-card:nth-child(2) .feature-icon {
            background: #fbf2d7;
            color: #b68b13;
        }

        .feature-card:nth-child(3) .feature-icon {
            background: #e5f3ea;
            color: #43835a;
        }

        .feature-title {
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .feature-description {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* --------------------------------------------------
           HOW IT WORKS
        -------------------------------------------------- */

        .how-section {
            background: var(--light);
        }

        .steps-grid {
            display: grid;
            grid-template-columns:
                repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .step-card {
            position: relative;
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 26px;
        }

        .step-number {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: var(--teal);
            color: white;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .step-title {
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .step-text {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* --------------------------------------------------
           ABOUT
        -------------------------------------------------- */

        .about-section {
            padding-bottom: 95px;
        }

        .about-card {
            position: relative;
            overflow: hidden;
            background: var(--teal);
            border-radius: 24px;
            padding: 42px;
            color: white;
        }

        .about-card::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: -80px;
            top: -110px;
            border-radius: 50%;
            background: rgba(214, 165, 29, 0.20);
        }

        .about-card::after {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            left: 42%;
            bottom: -115px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .about-content {
            position: relative;
            z-index: 2;
            max-width: 760px;
        }

        .about-label {
            color: var(--gold-light);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .about-title {
            font-size: 29px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .about-text {
            color: rgba(255, 255, 255, 0.76);
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 0;
        }

        /* --------------------------------------------------
           FOOTER
        -------------------------------------------------- */

        footer {
            border-top: 1px solid var(--border);
            padding: 25px 0;
            background: white;
        }

        .footer-container {
            width: min(1120px, calc(100% - 40px));
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-brand {
            color: var(--teal);
            font-size: 13px;
            font-weight: 700;
        }

        .footer-text {
            color: var(--muted);
            font-size: 11px;
            margin: 0;
        }

        /* --------------------------------------------------
           AUTH MODAL
        -------------------------------------------------- */

        .auth-overlay {
            position: fixed;
            inset: 0;
            z-index: 5000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            background: rgba(20, 42, 40, 0.46);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition:
                opacity 0.25s ease,
                visibility 0.25s ease;
        }

        .auth-overlay.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .auth-modal {
            position: relative;
            width: 100%;
            max-width: 440px;
            max-height: calc(100vh - 50px);
            overflow-y: auto;
            background: white;
            border: 1px solid rgba(255, 255, 255, 0.65);
            border-radius: 24px;
            padding: 34px 36px 30px;
            box-shadow:
                0 30px 80px rgba(24, 52, 50, 0.28);
            transform: translateY(15px) scale(0.98);
            transition:
                transform 0.25s ease;
            scrollbar-width: thin;
        }

        .auth-overlay.show .auth-modal {
            transform: translateY(0) scale(1);
        }

        .auth-modal.register-modal {
            max-width: 470px;
        }

        .auth-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 50%;
            background: #f3f7f6;
            color: var(--muted);
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .auth-close:hover {
            background: #e7efed;
            color: var(--teal);
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .auth-brand-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e4f0ef;
            color: var(--teal);
            font-size: 20px;
        }

        .auth-brand-text {
            color: var(--teal);
            font-size: 14px;
            font-weight: 700;
        }

        .auth-brand-subtitle {
            color: var(--muted);
            font-size: 10px;
            margin-top: 2px;
        }

        .auth-title {
            color: var(--text);
            font-size: 27px;
            font-weight: 700;
            margin: 0 0 6px;
        }

        .auth-description {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin: 0 0 23px;
        }

        .auth-form-group {
            margin-bottom: 17px;
        }

        .auth-form-label {
            display: block;
            color: var(--teal);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .auth-form-control {
            display: block;
            width: 100%;
            height: 44px;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 0 14px;
            background: #fbfdfd;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: 0.2s ease;
        }

        .auth-form-control:focus {
            border-color: var(--teal);
            background: white;
            box-shadow:
                0 0 0 3px rgba(54, 92, 90, 0.10);
        }

        select.auth-form-control {
            cursor: pointer;
        }

        .auth-password-wrapper {
            position: relative;
        }

        .auth-password-wrapper .auth-form-control {
            padding-right: 45px;
        }

        .auth-password-toggle {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--muted);
            padding: 0;
            cursor: pointer;
            font-size: 16px;
        }

        .auth-password-toggle:hover {
            color: var(--teal);
        }

        .auth-forgot {
            text-align: right;
            margin-top: -4px;
            margin-bottom: 18px;
        }

        .auth-forgot button {
            border: none;
            padding: 0;
            background: transparent;
            color: var(--teal);
            font-size: 11px;
            cursor: pointer;
        }

        .auth-forgot button:hover {
            color: var(--gold);
        }

        .auth-submit {
            width: 100%;
            height: 44px;
            border: none;
            border-radius: 11px;
            background: var(--teal);
            color: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .auth-submit:hover {
            background: var(--teal-dark);
            transform: translateY(-1px);
        }

        .auth-submit:disabled {
            opacity: 0.85;
            cursor: not-allowed;
            transform: none;
        }

        .auth-switch {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin: 19px 0 0;
        }

        .auth-switch button {
            border: none;
            background: transparent;
            color: var(--teal);
            font-weight: 700;
            font-size: 12px;
            padding: 0;
            cursor: pointer;
        }

        .auth-switch button:hover {
            color: var(--gold);
        }

        .auth-alert {
            border: none;
            border-radius: 11px;
            font-size: 11px;
            line-height: 1.5;
            margin-bottom: 18px;
            padding: 10px 12px;
        }

        .auth-alert ul {
            margin: 0;
            padding-left: 17px;
        }

        .auth-alert-success {
            background: #e8f5ec;
            color: #36734b;
        }

        .auth-alert-danger {
            background: #fbe9e9;
            color: #9a4545;
        }

        .auth-role-note {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 9px 11px;
            margin-top: -5px;
            margin-bottom: 16px;
            border-radius: 10px;
            background: #fbf5df;
            color: #856817;
            font-size: 10px;
            line-height: 1.5;
        }

        .auth-role-note i {
            margin-top: 1px;
            font-size: 12px;
        }

        .auth-loading {
            position: fixed;
            inset: 0;
            z-index: 6000;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(41, 73, 71, 0.30);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: 0.2s ease;
        }

        .auth-loading.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .auth-loading-card {
            width: 185px;
            padding: 25px 20px;
            border-radius: 18px;
            background: white;
            text-align: center;
            box-shadow:
                0 20px 50px rgba(41, 73, 71, 0.20);
        }

        .auth-loading-spinner {
            width: 37px;
            height: 37px;
            margin: 0 auto 13px;
            border: 4px solid #e4efed;
            border-top-color: var(--teal);
            border-radius: 50%;
            animation: authLoadingSpin 0.8s linear infinite;
        }

        .auth-loading-title {
            color: var(--teal);
            font-size: 13px;
            font-weight: 700;
        }

        .auth-loading-text {
            color: var(--muted);
            font-size: 10px;
            margin-top: 4px;
        }

        .auth-button-spinner {
            display: inline-block;
            width: 13px;
            height: 13px;
            margin-right: 7px;
            vertical-align: -2px;
            border: 2px solid rgba(255, 255, 255, 0.40);
            border-top-color: white;
            border-radius: 50%;
            animation: authLoadingSpin 0.7s linear infinite;
        }

        @keyframes authLoadingSpin {
            to {
                transform: rotate(360deg);
            }
        }

        /* --------------------------------------------------
           RESPONSIVE
        -------------------------------------------------- */

        @media (max-width: 992px) {

            .nav-links {
                gap: 18px;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 65px 0;
            }

            .hero-content {
                max-width: 720px;
            }

            .hero-visual {
                min-height: 300px;
            }

            .feature-grid,
            .steps-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {

            .navbar-container {
                width: min(100% - 30px, 1120px);
                min-height: 68px;
            }

            .nav-links {
                gap: 12px;
            }

            .hero {
                min-height: auto;
            }

            .hero-container {
                width: min(100% - 30px, 1120px);
                padding: 55px 0;
            }

            .hero-title {
                font-size: 42px;
                letter-spacing: -1.5px;
            }

            .hero-text {
                font-size: 14px;
                line-height: 1.7;
            }

            .hero-visual {
                min-height: 270px;
            }

            .visual-circle-large {
                width: 230px;
                height: 230px;
            }

            .visual-icon-main {
                width: 125px;
                height: 125px;
                font-size: 56px;
            }

            .visual-floating {
                width: 48px;
                height: 48px;
                font-size: 19px;
            }

            .visual-floating-one {
                left: 20px;
                top: 60px;
            }

            .visual-floating-two {
                right: 20px;
                bottom: 45px;
            }

            .visual-floating-three {
                right: 45px;
                top: 40px;
            }

            .section {
                padding: 65px 0;
            }

            .feature-grid,
            .steps-grid {
                grid-template-columns: 1fr;
            }

            .about-card {
                padding: 30px 25px;
            }

            .footer-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .auth-overlay {
                padding: 15px;
            }

            .auth-modal,
            .auth-modal.register-modal {
                max-width: 100%;
                max-height: calc(100vh - 30px);
                border-radius: 20px;
                padding: 30px 25px 25px;
            }
        }

        @media (max-width: 480px) {

            .brand {
                font-size: 13px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-actions {
                flex-direction: column;
            }

            .hero-button {
                width: 100%;
            }

            .hero-visual {
                min-height: 235px;
            }

            .visual-circle-large {
                width: 195px;
                height: 195px;
            }

            .visual-circle-small {
                width: 75px;
                height: 75px;
            }

            .visual-circle-bottom {
                width: 55px;
                height: 55px;
            }

            .visual-icon-main {
                width: 105px;
                height: 105px;
                font-size: 45px;
            }

            .visual-floating-one {
                left: 15px;
            }

            .visual-floating-two {
                right: 10px;
            }

            .visual-floating-three {
                right: 30px;
            }

            .about-title {
                font-size: 25px;
            }

            .auth-modal,
            .auth-modal.register-modal {
                padding: 27px 20px 22px;
            }

            .auth-title {
                font-size: 24px;
            }
        }


        /* --------------------------------------------------
           SMALL MODERN ANIMATIONS
        -------------------------------------------------- */

        /* Initial page entrance */
        @keyframes lfPageFade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        body {
            animation: lfPageFade 0.45s ease-out both;
        }


        /* Navbar entrance */
        @keyframes lfNavbarDown {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .landing-navbar {
            animation: lfNavbarDown 0.55s ease-out both;
        }


        /* Hero content entrance */
        @keyframes lfHeroLeft {
            from {
                opacity: 0;
                transform: translateX(-18px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-content {
            animation: lfHeroLeft 0.7s ease-out 0.12s both;
        }


        /* Hero visual entrance */
        @keyframes lfHeroVisual {
            from {
                opacity: 0;
                transform: translateX(18px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        .hero-visual {
            animation: lfHeroVisual 0.75s ease-out 0.2s both;
        }


        /* Gentle floating animation for the hero decoration */
        @keyframes lfFloat {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .visual-icon-main {
            animation: lfFloat 3.5s ease-in-out infinite;
        }

        .visual-floating-one {
            animation: lfFloat 3s ease-in-out 0.2s infinite;
        }

        .visual-floating-two {
            animation: lfFloat 3.4s ease-in-out 0.5s infinite;
        }

        .visual-floating-three {
            animation: lfFloat 3.2s ease-in-out 0.8s infinite;
        }


        /* Soft movement for the decorative circles */
        @keyframes lfCircleFloat {
            0% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-5px) scale(1.015);
            }

            100% {
                transform: translateY(0) scale(1);
            }
        }

        .visual-circle-large {
            animation: lfCircleFloat 5s ease-in-out infinite;
        }

        .visual-circle-small {
            animation: lfCircleFloat 4s ease-in-out 0.5s infinite;
        }

        .visual-circle-bottom {
            animation: lfCircleFloat 4.5s ease-in-out 1s infinite;
        }


        /* Scroll reveal */
        .lf-reveal {
            opacity: 0;
            transform: translateY(22px);
            transition:
                opacity 0.65s ease,
                transform 0.65s ease;
        }

        .lf-reveal.lf-visible {
            opacity: 1;
            transform: translateY(0);
        }


        /* Stagger feature cards */
        .feature-card.lf-reveal:nth-child(2) {
            transition-delay: 0.08s;
        }

        .feature-card.lf-reveal:nth-child(3) {
            transition-delay: 0.16s;
        }


        /* Stagger process cards */
        .step-card.lf-reveal:nth-child(2) {
            transition-delay: 0.08s;
        }

        .step-card.lf-reveal:nth-child(3) {
            transition-delay: 0.16s;
        }


        /* Slightly stronger hover for the cards */
        .feature-card,
        .step-card {
            will-change: transform;
        }

        .feature-card:hover,
        .step-card:hover {
            transform: translateY(-5px);
        }


        /* About card entrance */
        .about-card.lf-reveal {
            transform: translateY(25px) scale(0.99);
        }

        .about-card.lf-reveal.lf-visible {
            transform: translateY(0) scale(1);
        }



        /* --------------------------------------------------
           RESPONSIVE IMPROVEMENTS
        -------------------------------------------------- */

        .mobile-menu-button {
            display: none;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: white;
            color: var(--teal);
            font-size: 21px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .mobile-menu-button:hover {
            background: #f3f8f7;
        }

        @media (max-width: 1100px) {
            .navbar-container,
            .hero-container,
            .section-container,
            .footer-container {
                width: min(100% - 36px, 1040px);
            }

            .hero-container {
                gap: 45px;
            }
        }

        @media (max-width: 992px) {
            .navbar-container {
                min-height: 70px;
            }

            .nav-links {
                gap: 18px;
            }

            .hero-container {
                grid-template-columns: minmax(0, 1fr) minmax(280px, 0.75fr);
                gap: 35px;
                padding: 65px 0;
            }

            .hero-title {
                font-size: clamp(40px, 5vw, 56px);
            }

            .hero-visual {
                min-height: 330px;
            }

            .visual-circle-large {
                width: 270px;
                height: 270px;
            }

            .visual-icon-main {
                width: 145px;
                height: 145px;
                font-size: 66px;
            }

            .feature-grid,
            .steps-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 820px) {
            .mobile-menu-button {
                display: inline-flex;
            }

            .nav-links {
                position: absolute;
                top: calc(100% + 1px);
                left: 0;
                right: 0;
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                padding: 10px;
                background: rgba(255, 255, 255, 0.98);
                border: 1px solid var(--border);
                border-top: none;
                border-radius: 0 0 16px 16px;
                box-shadow: 0 15px 30px rgba(41, 73, 71, 0.10);
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transform: translateY(-8px);
                transition: opacity .2s ease, transform .2s ease, visibility .2s ease;
            }

            .nav-links.mobile-open {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                transform: translateY(0);
            }

            .nav-link-item,
            .nav-login,
            .nav-register {
                width: 100%;
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                padding: 10px 13px;
                border-radius: 10px;
                font-size: 13px;
            }

            .nav-link-item:hover,
            .nav-login:hover {
                background: #f3f8f7;
            }

            .nav-register {
                justify-content: center;
                margin-top: 5px;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 15px;
                padding: 55px 0 45px;
            }

            .hero-content {
                max-width: 760px;
                text-align: center;
                margin: auto;
            }

            .hero-label {
                justify-content: center;
            }

            .hero-text {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-actions {
                justify-content: center;
            }

            .hero-visual {
                min-height: 280px;
                max-width: 500px;
                width: 100%;
                margin: auto;
            }

            .section {
                padding: 70px 0;
            }

            .section-heading {
                margin-bottom: 35px;
            }

            .about-section {
                padding-bottom: 75px;
            }
        }

        @media (max-width: 600px) {
            .navbar-container,
            .hero-container,
            .section-container,
            .footer-container {
                width: calc(100% - 28px);
            }

            .brand {
                min-width: 0;
                font-size: 13px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
                flex: 0 0 36px;
            }

            .hero-title {
                font-size: clamp(34px, 10vw, 44px);
                line-height: 1.08;
                letter-spacing: -1.2px;
            }

            .hero-text {
                font-size: 14px;
                line-height: 1.75;
            }

            .hero-actions {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                max-width: 390px;
                margin: 0 auto;
            }

            .hero-button {
                width: 100%;
                min-height: 46px;
            }

            .hero-visual {
                min-height: 245px;
            }

            .visual-circle-large {
                width: 205px;
                height: 205px;
            }

            .visual-circle-small {
                width: 78px;
                height: 78px;
                right: 5%;
                top: 10px;
            }

            .visual-circle-bottom {
                width: 58px;
                height: 58px;
                left: 7%;
                bottom: 15px;
            }

            .visual-icon-main {
                width: 112px;
                height: 112px;
                font-size: 48px;
            }

            .visual-floating {
                width: 47px;
                height: 47px;
                border-radius: 14px;
                font-size: 19px;
            }

            .visual-floating-one {
                left: 6%;
                top: 48px;
            }

            .visual-floating-two {
                right: 5%;
                bottom: 32px;
            }

            .visual-floating-three {
                right: 17%;
                top: 34px;
            }

            .section {
                padding: 58px 0;
            }

            .section-title {
                font-size: clamp(27px, 8vw, 34px);
            }

            .section-text {
                font-size: 13px;
            }

            .feature-grid,
            .steps-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .feature-card,
            .step-card {
                min-height: 0;
                padding: 22px;
            }

            .about-card {
                padding: 30px 22px;
                border-radius: 20px;
            }

            .about-title {
                font-size: clamp(24px, 7vw, 29px);
                line-height: 1.2;
            }

            .about-text {
                font-size: 12px;
                line-height: 1.75;
            }

            .footer-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 8px;
            }

            .auth-overlay {
                padding: 10px;
                align-items: flex-start;
                padding-top: 18px;
            }

            .auth-modal,
            .auth-modal.register-modal {
                width: 100%;
                max-width: 100%;
                max-height: calc(100vh - 36px);
                border-radius: 18px;
                padding: 27px 20px 22px;
            }
        }

        @media (max-width: 380px) {
            .navbar-container {
                width: calc(100% - 20px);
            }

            .brand {
                font-size: 12px;
                gap: 7px;
            }

            .brand-icon {
                width: 34px;
                height: 34px;
                flex-basis: 34px;
                font-size: 17px;
            }

            .mobile-menu-button {
                width: 38px;
                height: 38px;
                font-size: 19px;
            }

            .hero-title {
                font-size: 32px;
            }

            .hero-text {
                font-size: 13px;
            }

            .hero-visual {
                min-height: 220px;
            }

            .visual-circle-large {
                width: 180px;
                height: 180px;
            }

            .visual-icon-main {
                width: 98px;
                height: 98px;
                font-size: 42px;
            }

            .visual-floating {
                width: 43px;
                height: 43px;
                font-size: 17px;
            }

            .visual-floating-one {
                left: 3%;
                top: 45px;
            }

            .visual-floating-two {
                right: 2%;
                bottom: 27px;
            }

            .visual-floating-three {
                right: 12%;
                top: 29px;
            }

            .about-card {
                padding: 26px 18px;
            }

            .auth-modal,
            .auth-modal.register-modal {
                padding-left: 17px;
                padding-right: 17px;
            }
        }


        /* Respect reduced-motion accessibility setting */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }

            .lf-reveal {
                opacity: 1 !important;
                transform: none !important;
            }
        }

    </style>

</head>

<body>

<!-- NAVBAR -->

<nav class="landing-navbar">

    <div class="navbar-container">

        <a
            href="{{ url('/lost-found') }}"
            class="brand"
        >

            <div class="brand-icon">
                <i class="bi bi-search"></i>
            </div>

            Lost & Found

        </a>

        <div class="nav-links">

            <a href="#features" class="nav-link-item" onclick="closeMobileMenu()">
                Features
            </a>

            <a href="#how-it-works" class="nav-link-item" onclick="closeMobileMenu()">
                How It Works
            </a>

            <a href="#about" class="nav-link-item" onclick="closeMobileMenu()">
                About
            </a>

            <button
                type="button"
                class="nav-login"
                onclick="closeMobileMenu(); openAuthModal('login')"
            >
                Login
            </button>

            <button
                type="button"
                class="nav-register"
                onclick="closeMobileMenu(); openAuthModal('register')"
            >
                Create Account
            </button>

        </div>

        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Open navigation menu"
            aria-expanded="false"
            onclick="toggleMobileMenu()"
        >
            <i class="bi bi-list"></i>
        </button>

    </div>

</nav>


<!-- HERO -->

<section class="hero">

    <div class="hero-container">

        <div class="hero-content">

            <div class="hero-label">

                <i class="bi bi-stars"></i>

                MLG College of Learning, Inc.

            </div>

            <h1 class="hero-title">

                A simpler way to

                <span>
                    manage lost and found items.
                </span>

            </h1>

            <p class="hero-text">

                The MLG Lost & Found Management System provides
                a centralized platform for reporting lost and found
                items, managing claims, and helping members of the
                school community recover their belongings.

            </p>

            <div class="hero-actions">

                <button
                    type="button"
                    class="hero-button hero-button-primary"
                    onclick="openAuthModal('login')"
                >

                    <i class="bi bi-box-arrow-in-right"></i>

                    Login

                </button>

                <button
                    type="button"
                    class="hero-button hero-button-secondary"
                    onclick="openAuthModal('register')"
                >

                    <i class="bi bi-person-plus"></i>

                    Create Account

                </button>

            </div>

        </div>


        <!-- SIMPLE DECORATIVE DESIGN -->

        <div class="hero-visual">

            <div class="visual-circle-large"></div>

            <div class="visual-circle-small"></div>

            <div class="visual-circle-bottom"></div>

            <div class="visual-icon-main">

                <i class="bi bi-box-seam"></i>

            </div>

            <div class="visual-floating visual-floating-one">

                <i class="bi bi-search"></i>

            </div>

            <div class="visual-floating visual-floating-two">

                <i class="bi bi-check-lg"></i>

            </div>

            <div class="visual-floating visual-floating-three">

                <i class="bi bi-hand-index-thumb"></i>

            </div>

        </div>

    </div>

</section>


<!-- FEATURES -->

<section
    class="section"
    id="features"
>

    <div class="section-container">

        <div class="section-heading">

            <div class="section-label">
                Features
            </div>

            <h2 class="section-title">
                Everything in one place
            </h2>

            <p class="section-text">

                The system keeps lost and found activities
                organized and easier to manage.

            </p>

        </div>

        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-search"></i>
                </div>

                <div class="feature-title">
                    Report Lost Items
                </div>

                <p class="feature-description">

                    Submit information about lost belongings
                    so they can be recorded and tracked.

                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="feature-title">
                    Report Found Items
                </div>

                <p class="feature-description">

                    Record found belongings and provide
                    useful information for possible owners.

                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>

                <div class="feature-title">
                    Manage Claims
                </div>

                <p class="feature-description">

                    Submit and manage claims through an
                    organized verification process.

                </p>

            </div>

        </div>

    </div>

</section>


<!-- HOW IT WORKS -->

<section
    class="section how-section"
    id="how-it-works"
>

    <div class="section-container">

        <div class="section-heading">

            <div class="section-label">
                How It Works
            </div>

            <h2 class="section-title">
                A simple process
            </h2>

            <p class="section-text">

                Lost and found reports can be handled through
                a clear and organized process.

            </p>

        </div>

        <div class="steps-grid">

            <div class="step-card">

                <div class="step-number">
                    01
                </div>

                <div class="step-title">
                    Report
                </div>

                <p class="step-text">

                    Report a lost or found item with the
                    necessary information.

                </p>

            </div>


            <div class="step-card">

                <div class="step-number">
                    02
                </div>

                <div class="step-title">
                    Review
                </div>

                <p class="step-text">

                    Reports and claims can be reviewed
                    and verified by authorized users.

                </p>

            </div>


            <div class="step-card">

                <div class="step-number">
                    03
                </div>

                <div class="step-title">
                    Recover
                </div>

                <p class="step-text">

                    Approved claims help connect belongings
                    with their rightful owners.

                </p>

            </div>

        </div>

    </div>

</section>


<!-- ABOUT -->

<section
    class="section about-section"
    id="about"
>

    <div class="section-container">

        <div class="about-card">

            <div class="about-content">

                <div class="about-label">
                    About the System
                </div>

                <h2 class="about-title">

                    Helping the school community
                    manage lost and found belongings.

                </h2>

                <p class="about-text">

                    The MLG Lost & Found Management System
                    is designed to provide a centralized and
                    organized way to report lost and found items,
                    manage claims, and support the recovery process
                    within MLG College of Learning, Inc.

                </p>

            </div>

        </div>

    </div>

</section>


<!-- FOOTER -->

<footer>

    <div class="footer-container">

        <div class="footer-brand">
            MLG Lost & Found
        </div>

        <p class="footer-text">

            © {{ date('Y') }}
            MLG College of Learning, Inc.
            All rights reserved.

        </p>

    </div>

</footer>


<!-- ==================================================
     LOGIN MODAL
================================================== -->

<div
    class="auth-overlay"
    id="loginModal"
    onclick="closeAuthFromBackground(event)"
>

    <div
        class="auth-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="loginModalTitle"
        onclick="event.stopPropagation()"
    >

        <button
            type="button"
            class="auth-close"
            onclick="closeAuthModal()"
            aria-label="Close login"
        >

            <i class="bi bi-x-lg"></i>

        </button>


        <div class="auth-brand">

            <div class="auth-brand-icon">

                <i class="bi bi-search"></i>

            </div>

            <div>

                <div class="auth-brand-text">
                    MLG Lost & Found
                </div>

                <div class="auth-brand-subtitle">
                    MLG College of Learning, Inc.
                </div>

            </div>

        </div>


        <h1
            class="auth-title"
            id="loginModalTitle"
        >
            Welcome Back
        </h1>

        <p class="auth-description">
            Sign in to access your Lost & Found account.
        </p>


        @if($errors->any() && session('auth_form') === 'login')

            <div class="auth-alert auth-alert-danger">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        @if(session('success') && session('auth_form') === 'login')

            <div class="auth-alert auth-alert-success">

                <i class="bi bi-check-circle me-1"></i>

                {{ session('success') }}

            </div>

        @endif


        <form
            action="{{ url('/login') }}"
            method="POST"
            id="loginForm"
        >

            @csrf

            <div class="auth-form-group">

                <label class="auth-form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="auth-form-control"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="auth-form-group">

                <label class="auth-form-label">
                    Password
                </label>

                <div class="auth-password-wrapper">

                    <input
                        type="password"
                        name="password"
                        id="loginPassword"
                        class="auth-form-control"
                        placeholder="Enter your password"
                        required
                    >

                    <button
                        type="button"
                        class="auth-password-toggle"
                        onclick="togglePassword(
                            'loginPassword',
                            'loginPasswordIcon'
                        )"
                    >

                        <i
                            class="bi bi-eye"
                            id="loginPasswordIcon"
                        ></i>

                    </button>

                </div>

            </div>


            <div class="auth-forgot">

                <button
                    type="button"
                    onclick="alert('Password recovery will be available soon.')"
                >
                    Forgot password?
                </button>

            </div>


            <button
                type="submit"
                class="auth-submit"
                id="loginSubmitButton"
            >

                <i class="bi bi-box-arrow-in-right me-1"></i>

                Login

            </button>

        </form>


        <div class="auth-switch">

            Don't have an account?

            <button
                type="button"
                onclick="switchAuthModal('register')"
            >
                Create an account
            </button>

        </div>

    </div>

</div>


<!-- ==================================================
     REGISTER MODAL
================================================== -->

<div
    class="auth-overlay"
    id="registerModal"
    onclick="closeAuthFromBackground(event)"
>

    <div
        class="auth-modal register-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="registerModalTitle"
        onclick="event.stopPropagation()"
    >

        <button
            type="button"
            class="auth-close"
            onclick="closeAuthModal()"
            aria-label="Close registration"
        >

            <i class="bi bi-x-lg"></i>

        </button>


        <div class="auth-brand">

            <div class="auth-brand-icon">

                <i class="bi bi-person-plus"></i>

            </div>

            <div>

                <div class="auth-brand-text">
                    MLG Lost & Found
                </div>

                <div class="auth-brand-subtitle">
                    MLG College of Learning, Inc.
                </div>

            </div>

        </div>


        <h1
            class="auth-title"
            id="registerModalTitle"
        >
            Create Account
        </h1>

        <p class="auth-description">
            Register to access the MLG Lost & Found System.
        </p>


        @if($errors->any() && session('auth_form') === 'register')

            <div class="auth-alert auth-alert-danger">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        @if(session('success') && session('auth_form') === 'register')

            <div class="auth-alert auth-alert-success">

                <i class="bi bi-check-circle me-1"></i>

                {{ session('success') }}

            </div>

        @endif


        <form
            action="{{ route('register') }}"
            method="POST"
            id="registerForm"
        >

            @csrf


            <div class="auth-form-group">

                <label class="auth-form-label">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="auth-form-control"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                >

            </div>


            <div class="auth-form-group">

                <label class="auth-form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="auth-form-control"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="auth-form-group">

                <label class="auth-form-label">
                    Account Type
                </label>

                <select
                    name="role"
                    class="auth-form-control"
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


            <div class="auth-role-note">

                <i class="bi bi-info-circle"></i>

                <span>

                    Faculty accounts require administrator approval
                    before faculty features can be accessed.

                </span>

            </div>


            <div class="auth-form-group">

                <label class="auth-form-label">
                    Password
                </label>

                <div class="auth-password-wrapper">

                    <input
                        type="password"
                        name="password"
                        id="registerPassword"
                        class="auth-form-control"
                        placeholder="Enter your password"
                        required
                    >

                    <button
                        type="button"
                        class="auth-password-toggle"
                        onclick="togglePassword(
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


            <div class="auth-form-group">

                <label class="auth-form-label">
                    Confirm Password
                </label>

                <div class="auth-password-wrapper">

                    <input
                        type="password"
                        name="password_confirmation"
                        id="registerPasswordConfirmation"
                        class="auth-form-control"
                        placeholder="Confirm your password"
                        required
                    >

                    <button
                        type="button"
                        class="auth-password-toggle"
                        onclick="togglePassword(
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
                class="auth-submit"
                id="registerSubmitButton"
            >

                <i class="bi bi-person-plus me-1"></i>

                Create Account

            </button>

        </form>


        <div class="auth-switch">

            Already have an account?

            <button
                type="button"
                onclick="switchAuthModal('login')"
            >
                Login
            </button>

        </div>

    </div>

</div>


<!-- ==================================================
     LOADING SCREEN
================================================== -->

<div
    class="auth-loading"
    id="authLoading"
>

    <div class="auth-loading-card">

        <div class="auth-loading-spinner"></div>

        <div
            class="auth-loading-title"
            id="authLoadingTitle"
        >
            Please wait...
        </div>

        <div class="auth-loading-text">
            Processing your request
        </div>

    </div>

</div>


<script>

    function openAuthModal(type) {

        const loginModal =
            document.getElementById('loginModal');

        const registerModal =
            document.getElementById('registerModal');

        if (!loginModal || !registerModal) {
            return;
        }

        loginModal.classList.remove('show');

        registerModal.classList.remove('show');

        if (type === 'login') {
            loginModal.classList.add('show');
        }

        if (type === 'register') {
            registerModal.classList.add('show');
        }

        document.body.classList.add('modal-open');
    }


    function closeAuthModal() {

        const loginModal =
            document.getElementById('loginModal');

        const registerModal =
            document.getElementById('registerModal');

        if (loginModal) {
            loginModal.classList.remove('show');
        }

        if (registerModal) {
            registerModal.classList.remove('show');
        }

        document.body.classList.remove('modal-open');
    }


    function switchAuthModal(type) {
        openAuthModal(type);
    }


    function closeAuthFromBackground(event) {

        if (
            event.target &&
            event.target.classList.contains('auth-overlay')
        ) {
            closeAuthModal();
        }
    }


    function togglePassword(inputId, iconId) {

        const password =
            document.getElementById(inputId);

        const icon =
            document.getElementById(iconId);

        if (!password || !icon) {
            return;
        }

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


    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {
                closeAuthModal();
            }

        }
    );



    /* --------------------------------------------------
       MOBILE NAVIGATION
    -------------------------------------------------- */

    function toggleMobileMenu() {

        const menu = document.querySelector('.nav-links');
        const button = document.getElementById('mobileMenuButton');

        if (!menu || !button) {
            return;
        }

        const isOpen = menu.classList.toggle('mobile-open');

        button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        button.setAttribute(
            'aria-label',
            isOpen ? 'Close navigation menu' : 'Open navigation menu'
        );

        const icon = button.querySelector('i');

        if (icon) {
            icon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
        }
    }


    function closeMobileMenu() {

        const menu = document.querySelector('.nav-links');
        const button = document.getElementById('mobileMenuButton');

        if (!menu || !button) {
            return;
        }

        menu.classList.remove('mobile-open');

        button.setAttribute('aria-expanded', 'false');
        button.setAttribute('aria-label', 'Open navigation menu');

        const icon = button.querySelector('i');

        if (icon) {
            icon.className = 'bi bi-list';
        }
    }


    document.addEventListener('click', function (event) {

        const menu = document.querySelector('.nav-links');
        const button = document.getElementById('mobileMenuButton');

        if (!menu || !button) {
            return;
        }

        if (
            menu.classList.contains('mobile-open') &&
            !menu.contains(event.target) &&
            !button.contains(event.target)
        ) {
            closeMobileMenu();
        }
    });


    window.addEventListener('resize', function () {

        if (window.innerWidth > 820) {
            closeMobileMenu();
        }
    });


    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const hasLoginErrors =
                {{ $errors->any() && session('auth_form') === 'login' ? 'true' : 'false' }};

            const hasRegisterErrors =
                {{ $errors->any() && session('auth_form') === 'register' ? 'true' : 'false' }};

            const loginSuccess =
                {{ session('success') && session('auth_form') === 'login' ? 'true' : 'false' }};

            const registerSuccess =
                {{ session('success') && session('auth_form') === 'register' ? 'true' : 'false' }};


            if (hasLoginErrors || loginSuccess) {

                openAuthModal('login');

            } else if (hasRegisterErrors || registerSuccess) {

                openAuthModal('register');

            }


            const loginForm =
                document.getElementById('loginForm');

            const registerForm =
                document.getElementById('registerForm');

            const loadingScreen =
                document.getElementById('authLoading');

            const loadingTitle =
                document.getElementById('authLoadingTitle');

            const loginButton =
                document.getElementById('loginSubmitButton');

            const registerButton =
                document.getElementById('registerSubmitButton');


            if (
                loginForm &&
                loadingScreen &&
                loadingTitle &&
                loginButton
            ) {

                loginForm.addEventListener(
                    'submit',
                    function () {

                        loadingTitle.textContent =
                            'Logging in...';

                        loadingScreen.classList.add('show');

                        loginButton.disabled = true;

                        loginButton.innerHTML =
                            '<span class="auth-button-spinner"></span> Logging in...';

                    }
                );

            }


            if (
                registerForm &&
                loadingScreen &&
                loadingTitle &&
                registerButton
            ) {

                registerForm.addEventListener(
                    'submit',
                    function () {

                        loadingTitle.textContent =
                            'Creating account...';

                        loadingScreen.classList.add('show');

                        registerButton.disabled = true;

                        registerButton.innerHTML =
                            '<span class="auth-button-spinner"></span> Creating account...';

                    }
                );

            }

        }
    );


        /* --------------------------------------------------
           SMALL SCROLL ANIMATIONS
        -------------------------------------------------- */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const revealElements = document.querySelectorAll(
                    '.section-heading, .feature-card, .step-card, .about-card'
                );

                if (!revealElements.length) {
                    return;
                }

                revealElements.forEach(function (element) {
                    element.classList.add('lf-reveal');
                });


                /* Show elements when they enter the viewport */
                if ('IntersectionObserver' in window) {

                    const revealObserver =
                        new IntersectionObserver(
                            function (entries, observer) {

                                entries.forEach(function (entry) {

                                    if (entry.isIntersecting) {

                                        entry.target.classList.add(
                                            'lf-visible'
                                        );

                                        observer.unobserve(
                                            entry.target
                                        );
                                    }

                                });

                            },
                            {
                                threshold: 0.12,
                                rootMargin: '0px 0px -35px 0px'
                            }
                        );


                    revealElements.forEach(function (element) {
                        revealObserver.observe(element);
                    });

                } else {

                    /* Fallback for older browsers */
                    revealElements.forEach(function (element) {
                        element.classList.add('lf-visible');
                    });

                }

            }
        );

</script>

</body>

</html>