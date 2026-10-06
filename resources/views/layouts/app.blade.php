<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Lost & Found')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --primary: #f28b72;
            --primary-dark: #e9795d;
            --background: #f5f7fa;
            --card: #ffffff;
            --text: #202733;
            --muted: #7d8795;
            --border: #e7eaee;
            --sidebar-text: #667180;
            --sidebar-hover: #fff4f0;
            --sidebar-active: #fff0eb;
            --success: #62b99b;
            --warning: #f3b85f;
            --blue: #7199e8;
            --purple: #806acb;
            --sidebar-width: 250px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid var(--border);
            padding: 24px 16px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 4px 8px 24px;
            margin-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        .logo-container {
            width: 46px;
            height: 46px;
            min-width: 46px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .brand-title {
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand-subtitle {
            color: var(--muted);
            font-size: 9px;
            line-height: 1.4;
            margin-top: 4px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 8px;
        }

        .nav-link {
            width: 100%;
            min-height: 44px;
            color: var(--sidebar-text) !important;
            padding: 11px 13px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 17px;
            color: #8b95a3;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--primary-dark) !important;
        }

        .nav-link:hover i {
            color: var(--primary);
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: var(--primary-dark) !important;
            font-weight: 600;
        }

        .nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 9px;
            bottom: 9px;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: var(--primary);
        }

        .nav-link.active i {
            color: var(--primary);
        }

        .notification-badge {
            margin-left: auto;
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            border-radius: 20px;
            background: var(--primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 700;
        }

        .logout-form {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .logout-button {
            border: none !important;
            background: transparent !important;
            text-align: left;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #fff0ed !important;
            color: #d96f55 !important;
        }

        .logout-button:hover i {
            color: #d96f55 !important;
        }

        .sidebar-bottom {
            padding: 14px 10px 0;
        }

        .sidebar-bottom p {
            margin: 0;
            color: #a0a8b3;
            font-size: 9px;
            line-height: 1.6;
        }

        /* MAIN */

        .main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* TOPBAR */

        .topbar {
            height: 72px;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mobile-menu {
            width: 40px;
            height: 40px;
            display: none;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            background: #ffffff;
            border-radius: 10px;
            color: var(--text);
            font-size: 20px;
            cursor: pointer;
        }

        .topbar-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .topbar-subtitle {
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* NOTIFICATION BUTTON */

        .notification-wrapper {
            position: relative;
        }

        .notification-btn {
            width: 39px;
            height: 39px;
            border: 1px solid var(--border);
            background: #ffffff;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: #667180;
            transition: 0.2s;
            cursor: pointer;
        }

        .notification-btn:hover,
        .notification-btn.active {
            color: var(--primary-dark);
            border-color: #f4c7bb;
            background: #fff8f6;
        }

        .notification-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--primary);
            border: 2px solid #ffffff;
            border-radius: 50%;
            top: 5px;
            right: 5px;
        }

        /* FLOATING NOTIFICATION PANEL */

        .notification-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 370px;
            max-width: calc(100vw - 28px);
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 18px 45px rgba(31, 41, 55, 0.14);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.98);
            transform-origin: top right;
            transition: all 0.2s ease;
            z-index: 2000;
        }

        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .notification-dropdown-header {
            padding: 17px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .notification-dropdown-title {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .notification-dropdown-title-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #fff0ec;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-dropdown-title h6 {
            margin: 0;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .notification-dropdown-title span {
            display: block;
            color: var(--muted);
            font-size: 9px;
            margin-top: 2px;
        }

        .notification-unread-count {
            min-width: 22px;
            height: 22px;
            padding: 0 6px;
            border-radius: 20px;
            background: #fff0ec;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 700;
        }

        .notification-list {
            max-height: 380px;
            overflow-y: auto;
        }

        .floating-notification-item {
            display: flex;
            gap: 11px;
            padding: 14px 17px;
            border-bottom: 1px solid #f0f2f5;
            color: var(--text);
            transition: background 0.2s ease;
        }

        .floating-notification-item:hover {
            background: #fffaf8;
        }

        .floating-notification-item:last-child {
            border-bottom: none;
        }

        .floating-notification-item.unread {
            background: #fff8f6;
        }

        .floating-notification-icon {
            width: 37px;
            height: 37px;
            min-width: 37px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff0ec;
            color: var(--primary);
        }

        .floating-notification-icon.success {
            background: #e8f6f0;
            color: var(--success);
        }

        .floating-notification-icon.warning {
            background: #fff3dc;
            color: var(--warning);
        }

        .floating-notification-icon.blue {
            background: #edf3ff;
            color: var(--blue);
        }

        .floating-notification-icon.purple {
            background: #f1edff;
            color: var(--purple);
        }

        .floating-notification-content {
            min-width: 0;
            flex: 1;
        }

        .floating-notification-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 3px;
            line-height: 1.4;
        }

        .floating-notification-message {
            font-size: 10px;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .floating-notification-time {
            font-size: 8px;
            color: #a0a8b3;
        }

        .floating-notification-unread {
            width: 7px;
            height: 7px;
            min-width: 7px;
            border-radius: 50%;
            background: var(--primary);
            margin-top: 5px;
        }

        .notification-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .notification-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 15px;
            background: #fff0ec;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .notification-empty h6 {
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .notification-empty p {
            color: var(--muted);
            font-size: 10px;
            margin: 0;
        }

        .notification-dropdown-footer {
            padding: 11px 15px;
            border-top: 1px solid var(--border);
            background: #fafbfc;
        }

        .notification-view-all {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 12px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 10px;
            font-weight: 600;
            transition: 0.2s;
        }

        .notification-view-all:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* FLOATING LOGOUT CONFIRMATION */

        .logout-confirmation {
            position: fixed;
            inset: 0;
            background: rgba(32, 40, 51, 0.18);
            backdrop-filter: blur(3px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .logout-confirmation.show {
            opacity: 1;
            visibility: visible;
        }

        .logout-confirmation-card {
            width: 340px;
            max-width: calc(100vw - 30px);
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px 25px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(31, 41, 55, 0.18);
            transform: translateY(8px) scale(0.97);
            transition: all 0.2s ease;
        }

        .logout-confirmation.show .logout-confirmation-card {
            transform: translateY(0) scale(1);
        }

        .logout-confirmation-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 15px;
            border-radius: 16px;
            background: #fff0ec;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .logout-confirmation-card h5 {
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .logout-confirmation-card p {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .logout-confirmation-actions {
            display: flex;
            gap: 9px;
        }

        .logout-cancel-button,
        .logout-confirm-button {
            flex: 1;
            border: none;
            border-radius: 11px;
            padding: 10px 14px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-cancel-button {
            background: #f5f7fa;
            color: #667180;
            border: 1px solid var(--border);
        }

        .logout-cancel-button:hover {
            background: #eef1f4;
            color: var(--text);
        }

        .logout-confirm-button {
            background: var(--primary);
            color: #ffffff;
        }

        .logout-confirm-button:hover {
            background: var(--primary-dark);
        }

        .logout-confirm-button i {
            margin-right: 5px;
        }

        /* PROFILE */

        .profile {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-left: 4px;
            padding-left: 13px;
            border-left: 1px solid var(--border);
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: #fff0eb;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }

        .profile-info strong {
            display: block;
            color: var(--text);
            font-size: 11px;
            font-weight: 600;
        }

        .profile-info span {
            display: block;
            color: var(--muted);
            font-size: 9px;
            margin-top: 2px;
        }

        /* CONTENT */

        .content {
            padding: 35px;
        }

        .page-heading {
            margin-bottom: 28px;
        }

        .page-label {
            color: #8490a0;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .page-heading h1 {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
        }

        /* MODERN CARD */

        .modern-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(31, 41, 55, 0.04);
            transition: 0.2s;
        }

        .modern-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(31, 41, 55, 0.07);
        }

        /* STAT CARD */

        .stat-card {
            padding: 21px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-icon.orange {
            background: #fff0ec;
            color: var(--primary);
        }

        .stat-icon.green {
            background: #e9f7f1;
            color: var(--success);
        }

        .stat-icon.blue {
            background: #edf3ff;
            color: var(--blue);
        }

        .stat-icon.yellow {
            background: #fff5df;
            color: var(--warning);
        }

        .stat-title {
            margin-top: 18px;
            font-size: 12px;
            color: var(--muted);
        }

        .stat-number {
            font-size: 27px;
            font-weight: 700;
            margin-top: 3px;
        }

        .stat-footer {
            margin-top: 12px;
            font-size: 10px;
            color: var(--success);
        }

        /* SECTION */

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .section-header h5 {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .section-header p {
            font-size: 11px;
            color: var(--muted);
            margin: 4px 0 0;
        }

        .view-link {
            color: var(--blue);
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
        }

        /* ACTION CARDS */

        .action-card {
            padding: 20px;
            height: 100%;
            text-decoration: none;
            display: block;
        }

        .action-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 17px;
        }

        .action-card h6 {
            font-size: 12px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .action-card p {
            font-size: 10px;
            color: var(--muted);
            margin-bottom: 13px;
        }

        .action-arrow {
            font-size: 15px;
            color: var(--text);
        }

        .action-lost {
            background: #fff7f5;
            border-color: #f8ded8;
        }

        .action-lost .action-icon {
            background: var(--primary);
            color: white;
        }

        .action-found {
            background: #f1faf7;
            border-color: #dcefe8;
        }

        .action-found .action-icon {
            background: var(--success);
            color: white;
        }

        .action-claims {
            background: #f2f6ff;
            border-color: #dfe8fb;
        }

        .action-claims .action-icon {
            background: var(--blue);
            color: white;
        }

        .action-reports {
            background: #f6f3ff;
            border-color: #e8e2fb;
        }

        .action-reports .action-icon {
            background: #806acb;
            color: white;
        }

        /* TABLE */

        .table-card {
            padding: 22px;
        }

        .modern-table {
            margin: 0;
        }

        .modern-table thead th {
            border-bottom: 1px solid var(--border);
            color: #929baa;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-weight: 600;
            padding: 11px 8px;
        }

        .modern-table tbody td {
            border-bottom: 1px solid #f0f2f5;
            padding: 13px 8px;
            font-size: 11px;
            vertical-align: middle;
        }

        .modern-table tbody tr:last-child td {
            border-bottom: none;
        }

        .item-name {
            font-weight: 600;
        }

        .item-category {
            display: block;
            color: var(--muted);
            font-size: 9px;
            margin-top: 2px;
        }

        /* STATUS */

        .status {
            display: inline-flex;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
        }

        .status-lost {
            background: #fff0ec;
            color: #dd765c;
        }

        .status-found {
            background: #e8f6f0;
            color: #4da483;
        }

        .status-pending {
            background: #fff3dc;
            color: #d49638;
        }

        .status-review {
            background: #e9f0ff;
            color: #6085d3;
        }

        .status-resolved {
            background: #e8f6f0;
            color: #4da483;
        }

        /* MATCH CARDS */

        .match-card {
            padding: 22px;
        }

        .match-item {
            position: relative;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 13px;
            display: flex;
            gap: 13px;
            align-items: center;
            background: #ffffff;
            transition: 0.2s ease;
        }

        .match-item:hover {
            border-color: #f4c7bb;
            background: #fffaf8;
            transform: translateY(-1px);
            box-shadow: 0 7px 18px rgba(31, 41, 55, 0.06);
        }

        .match-image {
            width: 62px;
            height: 62px;
            border-radius: 11px;
            background: #f4f6f8;
            border: 1px solid #edf0f3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9aa3af;
            font-size: 20px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .match-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
        }

        .match-info {
            flex: 1;
            min-width: 0;
        }

        .match-info h6 {
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--text);
        }

        .match-info p {
            font-size: 9px;
            color: var(--muted);
            margin: 0 0 3px;
            line-height: 1.4;
        }

        .match-score {
            background: #fff0ec;
            color: #dd765c;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        .match-score.high {
            background: #e8f6f0;
            color: #4da483;
        }

        .match-score.medium {
            background: #fff3dc;
            color: #d49638;
        }

        .match-score.low {
            background: #edf3ff;
            color: #6085d3;
        }

        /* DASHBOARD NOTIFICATION CARDS */

        .notification-card {
            padding: 22px;
        }

        .notification-item {
            display: flex;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #f0f2f5;
        }

        .notification-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .notification-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-icon.orange {
            background: #fff0ec;
            color: var(--primary);
        }

        .notification-icon.green {
            background: #e8f6f0;
            color: var(--success);
        }

        .notification-icon.yellow {
            background: #fff3dc;
            color: var(--warning);
        }

        .notification-item h6 {
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .notification-item p {
            font-size: 9px;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .notification-time {
            font-size: 8px;
            color: #a0a8b3;
        }

        /* WELCOME */

        .welcome-banner {
            min-height: 150px;
            border-radius: 15px;
            background:
                linear-gradient(
                    90deg,
                    rgba(32, 40, 51, 0.96),
                    rgba(32, 40, 51, 0.60)
                ),
                url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            padding: 27px;
            color: white;
            display: flex;
            align-items: center;
        }

        .welcome-banner small {
            font-size: 8px;
            letter-spacing: 2px;
        }

        .welcome-banner h3 {
            font-family: Georgia, serif;
            font-size: 24px;
            margin: 7px 0;
            max-width: 350px;
        }

        .welcome-banner p {
            color: #d5dae0;
            font-size: 10px;
            margin-bottom: 15px;
        }

        .primary-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 9px 17px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .primary-btn:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* RESPONSIVE */

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.25s ease;
                box-shadow: 8px 0 30px rgba(0, 0, 0, 0.08);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .mobile-menu {
                display: flex;
            }

            .topbar {
                padding: 0 20px;
            }
        }

        @media (max-width: 767px) {
            .content {
                padding: 22px 16px;
            }

            .topbar {
                height: 65px;
            }

            .profile-info {
                display: none;
            }

            .profile {
                padding-left: 8px;
            }

            .topbar-title {
                display: none;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .welcome-banner h3 {
                font-size: 20px;
            }

            .notification-dropdown {
                position: fixed;
                top: 65px;
                right: 12px;
                width: calc(100vw - 24px);
                max-width: none;
                transform-origin: top right;
            }
        }

        @media (max-width: 575px) {
            .content {
                padding: 18px 12px;
            }

            .topbar {
                padding: 0 14px;
            }

            .stat-card {
                padding: 17px;
            }

            .table-card,
            .match-card,
            .notification-card {
                padding: 17px;
            }

            .notification-dropdown {
                top: 62px;
                right: 8px;
                width: calc(100vw - 16px);
            }

            .match-item {
                padding: 11px;
            }

            .match-image {
                width: 55px;
                height: 55px;
            }

            .match-score {
                padding: 5px 7px;
                font-size: 8px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <div class="brand">

            <div class="logo-container">
                <img
                    src="{{ asset('images/logo/download (15).jpeg') }}"
                    alt="Lost and Found Logo"
                >
            </div>

            <div>
                <div class="brand-title">
                    Lost & Found
                </div>

                <div class="brand-subtitle">
                    MLG College of Learning, Inc.
                </div>
            </div>

        </div>

        <nav class="nav-menu">

            @if(auth()->user()->role === 'student')

                <a
                    href="{{ route('student.dashboard') }}"
                    class="nav-link {{ request()->is('student/dashboard') ? 'active' : '' }}"
                >
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>

                <a
                    href="{{ route('student.my-reports') }}"
                    class="nav-link {{ request()->is('student/my-reports*') ? 'active' : '' }}"
                >
                    <i class="bi bi-file-earmark-text"></i>
                    My Reports
                </a>

                <a
                    href="{{ route('student.my-claims') }}"
                    class="nav-link {{ request()->is('student/my-claims*') ? 'active' : '' }}"
                >
                    <i class="bi bi-clipboard-check"></i>
                    My Claims
                </a>

                <a
                    href="{{ route('notifications') }}"
                    class="nav-link {{ request()->is('notifications*') ? 'active' : '' }}"
                >
                    <i class="bi bi-bell"></i>
                    Notifications

                    @php
                        $unreadNotifications = \App\Models\Notification::where(
                            'user_id',
                            auth()->id()
                        )
                        ->where('is_read', false)
                        ->count();
                    @endphp

                    @if($unreadNotifications > 0)
                        <span class="notification-badge">
                            {{ $unreadNotifications }}
                        </span>
                    @endif
                </a>

                <a
                    href="{{ route('profile') }}"
                    class="nav-link {{ request()->is('profile') ? 'active' : '' }}"
                >
                    <i class="bi bi-person"></i>
                    Profile
                </a>

            @elseif(auth()->user()->role === 'faculty')

                <a
                    href="{{ route('faculty.dashboard') }}"
                    class="nav-link {{ request()->is('faculty/dashboard') ? 'active' : '' }}"
                >
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>

                <a
                    href="{{ route('faculty.browse-found-items') }}"
                    class="nav-link {{ request()->is('faculty/found-items/browse*') ? 'active' : '' }}"
                >
                    <i class="bi bi-box-seam"></i>
                    Browse Found Items
                </a>

                <a
                    href="{{ route('faculty.report-lost') }}"
                    class="nav-link {{ request()->is('faculty/report-lost') ? 'active' : '' }}"
                >
                    <i class="bi bi-search"></i>
                    Report Lost Item
                </a>

                <a
                    href="{{ route('faculty.report-found') }}"
                    class="nav-link {{ request()->is('faculty/report-found') ? 'active' : '' }}"
                >
                    <i class="bi bi-box-seam"></i>
                    Report Found Item
                </a>

                <a
                    href="{{ route('faculty.my-reports') }}"
                    class="nav-link {{ request()->is('faculty/my-reports*') ? 'active' : '' }}"
                >
                    <i class="bi bi-file-earmark-text"></i>
                    My Reports
                </a>

                <a
                    href="{{ route('notifications') }}"
                    class="nav-link {{ request()->is('notifications*') ? 'active' : '' }}"
                >
                    <i class="bi bi-bell"></i>
                    Notifications

                    @php
                        $unreadNotifications = \App\Models\Notification::where(
                            'user_id',
                            auth()->id()
                        )
                        ->where('is_read', false)
                        ->count();
                    @endphp

                    @if($unreadNotifications > 0)
                        <span class="notification-badge">
                            {{ $unreadNotifications }}
                        </span>
                    @endif
                </a>

                <a
                    href="{{ route('profile') }}"
                    class="nav-link {{ request()->is('profile') ? 'active' : '' }}"
                >
                    <i class="bi bi-person"></i>
                    Profile
                </a>

            @elseif(auth()->user()->role === 'admin')

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                >
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.report-found') }}"
                    class="nav-link {{ request()->is('admin/report-found') ? 'active' : '' }}"
                >
                    <i class="bi bi-box-seam"></i>
                    Report Found Item
                </a>

                <a
                    href="{{ route('admin.report-lost') }}"
                    class="nav-link {{ request()->is('admin/report-lost') ? 'active' : '' }}"
                >
                    <i class="bi bi-search"></i>
                    Report Lost Item
                </a>

                <a
                    href="{{ route('admin.my-reports') }}"
                    class="nav-link {{ request()->is('admin/my-reports*') ? 'active' : '' }}"
                >
                    <i class="bi bi-file-earmark-text"></i>
                    My Reports
                </a>

                <a
                    href="{{ route('notifications') }}"
                    class="nav-link {{ request()->is('notifications*') ? 'active' : '' }}"
                >
                    <i class="bi bi-bell"></i>
                    Notifications

                    @php
                        $unreadNotifications = \App\Models\Notification::where(
                            'user_id',
                            auth()->id()
                        )
                        ->where('is_read', false)
                        ->count();
                    @endphp

                    @if($unreadNotifications > 0)
                        <span class="notification-badge">
                            {{ $unreadNotifications }}
                        </span>
                    @endif
                </a>

                <a
                    href="{{ route('profile') }}"
                    class="nav-link {{ request()->is('profile') ? 'active' : '' }}"
                >
                    <i class="bi bi-person"></i>
                    Profile
                </a>

            @endif

        </nav>

        <div class="logout-form">

            <button
                type="button"
                class="nav-link logout-button"
                id="logoutButton"
            >
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>

        </div>

        <div class="sidebar-bottom">

            <p>
                "Sometimes, the smallest items
                have the biggest stories."
            </p>

        </div>

    </aside>

    <main class="main">

        <header class="topbar">

            <div class="topbar-left">

                <button
                    class="mobile-menu"
                    id="menuButton"
                    type="button"
                >
                    <i class="bi bi-list"></i>
                </button>

                <div>

                    <div class="topbar-title">
                        Lost and Found
                    </div>

                    <div class="topbar-subtitle">
                        MLG College of Learning, Inc.
                    </div>

                </div>

            </div>

            <div class="topbar-right">

                <div class="notification-wrapper">

                    <button
                        type="button"
                        class="notification-btn"
                        id="notificationButton"
                        title="Notifications"
                    >

                        <i class="bi bi-bell"></i>

                        @php
                            $unreadNotifications = \App\Models\Notification::where(
                                'user_id',
                                auth()->id()
                            )
                            ->where('is_read', false)
                            ->count();

                            $latestNotifications = \App\Models\Notification::where(
                                'user_id',
                                auth()->id()
                            )
                            ->latest()
                            ->take(5)
                            ->get();
                        @endphp

                        @if($unreadNotifications > 0)
                            <span class="notification-dot"></span>
                        @endif

                    </button>

                    <div
                        class="notification-dropdown"
                        id="notificationDropdown"
                    >

                        <div class="notification-dropdown-header">

                            <div class="notification-dropdown-title">

                                <div class="notification-dropdown-title-icon">
                                    <i class="bi bi-bell"></i>
                                </div>

                                <div>

                                    <h6>
                                        Notifications
                                    </h6>

                                    <span>
                                        Your latest system updates
                                    </span>

                                </div>

                            </div>

                            @if($unreadNotifications > 0)

                                <div class="notification-unread-count">
                                    {{ $unreadNotifications }}
                                </div>

                            @endif

                        </div>

                        <div class="notification-list">

                            @forelse($latestNotifications as $notification)

                                <a
                                    href="{{ route('notifications') }}"
                                    class="floating-notification-item {{ !$notification->is_read ? 'unread' : '' }}"
                                >

                                    <div
                                        class="floating-notification-icon
                                        @if($notification->type === 'success')
                                            success
                                        @elseif($notification->type === 'warning')
                                            warning
                                        @elseif($notification->type === 'claim')
                                            blue
                                        @elseif($notification->type === 'compensation')
                                            purple
                                        @endif"
                                    >

                                        @if($notification->type === 'success')

                                            <i class="bi bi-check-circle"></i>

                                        @elseif($notification->type === 'warning')

                                            <i class="bi bi-exclamation-circle"></i>

                                        @elseif($notification->type === 'claim')

                                            <i class="bi bi-clipboard-check"></i>

                                        @elseif($notification->type === 'compensation')

                                            <i class="bi bi-cash-stack"></i>

                                        @else

                                            <i class="bi bi-bell"></i>

                                        @endif

                                    </div>

                                    <div class="floating-notification-content">

                                        <div class="floating-notification-title">
                                            {{ $notification->title }}
                                        </div>

                                        <div class="floating-notification-message">
                                            {{ \Illuminate\Support\Str::limit(
                                                $notification->message,
                                                90
                                            ) }}
                                        </div>

                                        <div class="floating-notification-time">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>

                                    </div>

                                    @if(!$notification->is_read)

                                        <div class="floating-notification-unread"></div>

                                    @endif

                                </a>

                            @empty

                                <div class="notification-empty">

                                    <div class="notification-empty-icon">
                                        <i class="bi bi-bell-slash"></i>
                                    </div>

                                    <h6>
                                        No Notifications
                                    </h6>

                                    <p>
                                        You don't have any notifications yet.
                                    </p>

                                </div>

                            @endforelse

                        </div>

                        <div class="notification-dropdown-footer">

                            <a
                                href="{{ route('notifications') }}"
                                class="notification-view-all"
                            >
                                View All Notifications
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>

                @if(auth()->user()->role === 'admin')

                    <a
                        href="{{ route('admin.logs') }}"
                        class="notification-btn"
                        title="Activity Logs"
                    >
                        <i class="bi bi-clock-history"></i>
                    </a>

                @endif

                <div class="profile">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>

                    <div class="profile-info">

                        <strong>
                            {{ auth()->user()->name }}
                        </strong>

                        <span>
                            {{ ucfirst(auth()->user()->role) }}
                        </span>

                    </div>

                </div>

            </div>

        </header>

        <section class="content">

            @if(session('success'))

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >

                    <i class="bi bi-check-circle me-2"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif

            @yield('content')

        </section>

    </main>

    <div
        class="logout-confirmation"
        id="logoutConfirmation"
    >

        <div class="logout-confirmation-card">

            <div class="logout-confirmation-icon">
                <i class="bi bi-box-arrow-right"></i>
            </div>

            <h5>
                Are you sure you want to logout?
            </h5>

            <p>
                You will need to log in again to access your account.
            </p>

            <div class="logout-confirmation-actions">

                <button
                    type="button"
                    class="logout-cancel-button"
                    id="logoutCancel"
                >
                    Cancel
                </button>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    style="flex: 1;"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-confirm-button w-100"
                    >
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* LOGOUT CONFIRMATION */

            const logoutButton =
                document.getElementById('logoutButton');

            const logoutConfirmation =
                document.getElementById('logoutConfirmation');

            const logoutCancel =
                document.getElementById('logoutCancel');

            if (
                logoutButton &&
                logoutConfirmation &&
                logoutCancel
            ) {

                logoutButton.addEventListener(
                    'click',
                    function () {
                        logoutConfirmation.classList.add('show');
                    }
                );

                logoutCancel.addEventListener(
                    'click',
                    function () {
                        logoutConfirmation.classList.remove('show');
                    }
                );

                logoutConfirmation.addEventListener(
                    'click',
                    function (event) {

                        if (
                            event.target === logoutConfirmation
                        ) {
                            logoutConfirmation.classList.remove('show');
                        }

                    }
                );

                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (event.key === 'Escape') {
                            logoutConfirmation.classList.remove('show');
                        }

                    }
                );
            }

            /* MOBILE SIDEBAR */

            const menuButton =
                document.getElementById('menuButton');

            const sidebar =
                document.getElementById('sidebar');

            if (menuButton && sidebar) {

                menuButton.addEventListener(
                    'click',
                    function () {
                        sidebar.classList.toggle('show');
                    }
                );

                document.addEventListener(
                    'click',
                    function (event) {

                        if (
                            window.innerWidth <= 991 &&
                            sidebar.classList.contains('show') &&
                            !sidebar.contains(event.target) &&
                            !menuButton.contains(event.target)
                        ) {
                            sidebar.classList.remove('show');
                        }

                    }
                );

                window.addEventListener(
                    'resize',
                    function () {

                        if (window.innerWidth > 991) {
                            sidebar.classList.remove('show');
                        }

                    }
                );
            }

            /* FLOATING NOTIFICATIONS */

            const notificationButton =
                document.getElementById('notificationButton');

            const notificationDropdown =
                document.getElementById('notificationDropdown');

            if (
                notificationButton &&
                notificationDropdown
            ) {

                notificationButton.addEventListener(
                    'click',
                    function (event) {

                        event.stopPropagation();

                        notificationDropdown.classList.toggle('show');

                        notificationButton.classList.toggle('active');

                    }
                );

                notificationDropdown.addEventListener(
                    'click',
                    function (event) {
                        event.stopPropagation();
                    }
                );

                document.addEventListener(
                    'click',
                    function () {

                        notificationDropdown.classList.remove('show');

                        notificationButton.classList.remove('active');

                    }
                );
            }

        });
    </script>

    @stack('scripts')

</body>

</html>