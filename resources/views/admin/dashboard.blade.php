@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

<style>

.admin-dashboard {
    --admin-teal: #365c5a;
    --admin-teal-dark: #294947;
    --admin-gold: #d6a51d;
    --admin-border: #e4eceb;
    --admin-text: #263b3a;
    --admin-muted: #7b8d8b;
}

.admin-hero {
    position: relative;
    overflow: hidden;
    background: var(--admin-teal);
    border-radius: 24px;
    padding: 32px;
    color: white;
    margin-bottom: 24px;
}

.admin-hero::before {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    right: -75px;
    top: -110px;
    border-radius: 50%;
    background: rgba(214, 165, 29, 0.22);
}

.admin-hero::after {
    content: "";
    position: absolute;
    width: 190px;
    height: 190px;
    right: 150px;
    bottom: -135px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.07);
}

.admin-hero-content {
    position: relative;
    z-index: 2;
}

.admin-hero-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #e8d28a;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.admin-hero-title {
    font-size: clamp(26px, 4vw, 38px);
    font-weight: 700;
    line-height: 1.15;
    margin-bottom: 10px;
}

.admin-hero-text {
    max-width: 650px;
    color: rgba(255, 255, 255, 0.76);
    margin-bottom: 22px;
}

.admin-hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.admin-hero-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 17px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-hero-button-primary {
    background: var(--admin-gold);
    color: white;
}

.admin-hero-button-primary:hover {
    background: #bd9015;
    color: white;
    transform: translateY(-1px);
}

.admin-hero-button-light {
    background: rgba(255,255,255,0.12);
    color: white;
    border: 1px solid rgba(255,255,255,0.15);
}

.admin-hero-button-light:hover {
    background: rgba(255,255,255,0.18);
    color: white;
}

.admin-stat-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}

.admin-stat-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 18px;
    padding: 21px;
    min-height: 135px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    transition: 0.2s ease;
}

.admin-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(41,73,71,0.08);
}

.admin-stat-label {
    color: var(--admin-muted);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 7px;
}

.admin-stat-number {
    color: var(--admin-text);
    font-size: 29px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 8px;
}

.admin-stat-description {
    color: var(--admin-muted);
    font-size: 12px;
}

.admin-stat-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.admin-stat-icon.blue {
    background: #e8f0f7;
    color: #4d6f8c;
}

.admin-stat-icon.teal {
    background: #e4f0ef;
    color: var(--admin-teal);
}

.admin-stat-icon.gold {
    background: #fbf2d7;
    color: #b68b13;
}

.admin-stat-icon.green {
    background: #e5f3ea;
    color: #43835a;
}

.admin-section-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 22px;
    height: 100%;
}

.admin-section-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}

.admin-section-heading h5 {
    color: var(--admin-text);
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-section-heading p {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.admin-management-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.admin-management-item {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    min-height: 125px;
    padding: 17px;
    background: #f7faf9;
    border: 1px solid var(--admin-border);
    border-radius: 16px;
    color: var(--admin-text);
    text-decoration: none;
    transition: 0.2s ease;
}

.admin-management-item:hover {
    background: var(--admin-teal);
    border-color: var(--admin-teal);
    color: white;
    transform: translateY(-2px);
}

.admin-management-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 11px;
    color: var(--admin-teal);
    font-size: 18px;
    margin-bottom: 14px;
}

.admin-management-item:hover .admin-management-icon {
    background: rgba(255,255,255,0.15);
    color: white;
}

.admin-management-title {
    font-size: 13px;
    font-weight: 700;
}

.admin-management-description {
    color: var(--admin-muted);
    font-size: 11px;
    margin-top: 3px;
}

.admin-management-item:hover .admin-management-description {
    color: rgba(255,255,255,0.72);
}

.admin-management-arrow {
    position: absolute;
    right: 14px;
    bottom: 14px;
    font-size: 12px;
    opacity: 0.45;
}

.admin-overview-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid #edf1f0;
}

.admin-overview-item:last-child {
    border-bottom: 0;
}

.admin-overview-left {
    display: flex;
    align-items: center;
}

.admin-overview-icon {
    width: 38px;
    height: 38px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    background: #eef4f3;
    color: var(--admin-teal);
}

.admin-overview-label {
    color: var(--admin-text);
    font-size: 13px;
}

.admin-overview-number {
    color: var(--admin-text);
    font-weight: 700;
}

.admin-activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 0;
    border-bottom: 1px solid #edf1f0;
}

.admin-activity-item:last-child {
    border-bottom: 0;
}

.admin-activity-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 11px;
    background: #eef4f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-activity-message {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
}

.admin-activity-date {
    color: var(--admin-muted);
    font-size: 11px;
    margin-top: 3px;
}

.admin-empty {
    text-align: center;
    padding: 35px 20px;
}

.admin-empty-icon {
    width: 55px;
    height: 55px;
    margin: 0 auto 12px;
    border-radius: 16px;
    background: #eef4f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
}

.admin-empty h6 {
    color: var(--admin-text);
    font-weight: 700;
}

.admin-empty p {
    color: var(--admin-muted);
    font-size: 12px;
}

@media (max-width: 1200px) {
    .admin-stat-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 992px) {
    .admin-management-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 768px) {
    .admin-hero {
        padding: 24px;
        border-radius: 19px;
    }

    .admin-hero-title {
        font-size: 27px;
    }

    .admin-stat-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .admin-stat-card {
        min-height: 120px;
        padding: 17px;
    }

    .admin-stat-number {
        font-size: 25px;
    }

    .admin-section-card {
        padding: 17px;
        border-radius: 17px;
    }
}

@media (max-width: 576px) {
    .admin-hero {
        padding: 21px;
    }

    .admin-hero-actions {
        flex-direction: column;
    }

    .admin-hero-button {
        justify-content: center;
        width: 100%;
    }

    .admin-stat-grid {
        grid-template-columns: 1fr;
    }

    .admin-management-grid {
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .admin-management-item {
        min-height: 110px;
        padding: 13px;
    }

    .admin-management-title {
        font-size: 12px;
    }

    .admin-section-heading {
        flex-direction: column;
        align-items: flex-start;
    }
}

</style>


<div class="admin-dashboard">


    <div class="admin-hero">

        <div class="admin-hero-content">

            <div class="admin-hero-label">

                <i class="bi bi-shield-check"></i>

                Administrator Portal

            </div>


            <h1 class="admin-hero-title">

                Welcome, {{ auth()->user()->name }}!

            </h1>


            <p class="admin-hero-text">

                Monitor the Lost and Found system, manage users,
                review claims, verify reports, and oversee system operations.

            </p>


            <div class="admin-hero-actions">

                <a
                    href="{{ url('/admin/users') }}"
                    class="admin-hero-button admin-hero-button-primary"
                >

                    <i class="bi bi-people"></i>

                    Manage Users

                </a>


                <a
                    href="{{ url('/admin/claims') }}"
                    class="admin-hero-button admin-hero-button-light"
                >

                    <i class="bi bi-clipboard-check"></i>

                    Manage Claims

                </a>


                <a
                    href="{{ route('admin.reports') }}"
                    class="admin-hero-button admin-hero-button-light"
                >

                    <i class="bi bi-bar-chart"></i>

                    View Reports

                </a>

            </div>

        </div>

    </div>


    <div class="admin-stat-grid">


        <div class="admin-stat-card">

            <div>

                <div class="admin-stat-label">
                    Total Users
                </div>

                <div class="admin-stat-number">
                    {{ $totalUsers }}
                </div>

                <div class="admin-stat-description">
                    Registered system users
                </div>

            </div>

            <div class="admin-stat-icon blue">
                <i class="bi bi-people"></i>
            </div>

        </div>


        <div class="admin-stat-card">

            <div>

                <div class="admin-stat-label">
                    Lost Items
                </div>

                <div class="admin-stat-number">
                    {{ $totalLostItems }}
                </div>

                <div class="admin-stat-description">
                    Lost item reports
                </div>

            </div>

            <div class="admin-stat-icon teal">
                <i class="bi bi-search"></i>
            </div>

        </div>


        <div class="admin-stat-card">

            <div>

                <div class="admin-stat-label">
                    Found Items
                </div>

                <div class="admin-stat-number">
                    {{ $totalFoundItems }}
                </div>

                <div class="admin-stat-description">
                    Found item reports
                </div>

            </div>

            <div class="admin-stat-icon green">
                <i class="bi bi-box-seam"></i>
            </div>

        </div>


        <div class="admin-stat-card">

            <div>

                <div class="admin-stat-label">
                    Pending Claims
                </div>

                <div class="admin-stat-number">
                    {{ $pendingClaims }}
                </div>

                <div class="admin-stat-description">
                    Claims waiting for action
                </div>

            </div>

            <div class="admin-stat-icon gold">
                <i class="bi bi-clipboard-check"></i>
            </div>

        </div>


    </div>


    <div class="admin-section-card mb-4">

        <div class="admin-section-heading">

            <div>

                <h5>
                    Administration
                </h5>

                <p>
                    Manage the main components and operations of the system.
                </p>

            </div>

        </div>


        <div class="admin-management-grid">


            <a
                href="{{ url('/admin/users') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Manage Users
                    </div>

                    <div class="admin-management-description">
                        Manage student and faculty accounts.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ url('/admin/claims') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Manage Claims
                    </div>

                    <div class="admin-management-description">
                        Review and process item claims.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ url('/admin/lost-items') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-search"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Manage Lost Items
                    </div>

                    <div class="admin-management-description">
                        Review all lost item reports.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ url('/admin/found-items') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Manage Found Items
                    </div>

                    <div class="admin-management-description">
                        Review and verify found reports.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ url('/admin/faculty-requests') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Faculty Requests
                    </div>

                    <div class="admin-management-description">
                        Review faculty account requests.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ url('/admin/compensations') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Manage Compensation
                    </div>

                    <div class="admin-management-description">
                        Monitor compensation records.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ route('admin.reports') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-bar-chart"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Reports
                    </div>

                    <div class="admin-management-description">
                        View system statistics and reports.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


            <a
                href="{{ url('/admin/logs') }}"
                class="admin-management-item"
            >

                <div class="admin-management-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div>

                    <div class="admin-management-title">
                        Activity Logs
                    </div>

                    <div class="admin-management-description">
                        Monitor system activities.
                    </div>

                </div>

                <i class="bi bi-arrow-up-right admin-management-arrow"></i>

            </a>


        </div>

    </div>


    <div class="row g-4">


        <div class="col-12 col-xl-5">

            <div class="admin-section-card">

                <div class="admin-section-heading">

                    <div>

                        <h5>
                            System Overview
                        </h5>

                        <p>
                            Current system statistics.
                        </p>

                    </div>

                </div>


                <div class="admin-overview-item">

                    <div class="admin-overview-left">

                        <div class="admin-overview-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <span class="admin-overview-label">
                            Pending Claims
                        </span>

                    </div>

                    <strong class="admin-overview-number">
                        {{ $pendingClaims }}
                    </strong>

                </div>


                <div class="admin-overview-item">

                    <div class="admin-overview-left">

                        <div class="admin-overview-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <span class="admin-overview-label">
                            Resolved Items
                        </span>

                    </div>

                    <strong class="admin-overview-number">
                        {{ $resolvedItems }}
                    </strong>

                </div>


                <div class="admin-overview-item">

                    <div class="admin-overview-left">

                        <div class="admin-overview-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <span class="admin-overview-label">
                            Registered Users
                        </span>

                    </div>

                    <strong class="admin-overview-number">
                        {{ $totalUsers }}
                    </strong>

                </div>


                <div class="admin-overview-item">

                    <div class="admin-overview-left">

                        <div class="admin-overview-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                        <span class="admin-overview-label">
                            Total Claims
                        </span>

                    </div>

                    <strong class="admin-overview-number">
                        {{ $totalClaims ?? 0 }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-12 col-xl-7">

            <div class="admin-section-card">

                <div class="admin-section-heading">

                    <div>

                        <h5>
                            Recent Activity
                        </h5>

                        <p>
                            Latest activities recorded in the system.
                        </p>

                    </div>

                    <a
                        href="{{ url('/admin/logs') }}"
                        class="btn btn-sm btn-outline-secondary"
                    >
                        View All
                    </a>

                </div>


                @forelse($recentActivities as $activity)

                    <div class="admin-activity-item">

                        <div class="admin-activity-icon">

                            @if($activity['type'] === 'lost')

                                <i class="bi bi-search"></i>

                            @elseif($activity['type'] === 'found')

                                <i class="bi bi-box-seam"></i>

                            @else

                                <i class="bi bi-file-earmark-check"></i>

                            @endif

                        </div>


                        <div class="flex-grow-1">

                            <div class="admin-activity-message">
                                {{ $activity['message'] }}
                            </div>

                            <div class="admin-activity-date">

                                {{ $activity['date']->diffForHumans() }}

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="admin-empty">

                        <div class="admin-empty-icon">

                            <i class="bi bi-clock-history"></i>

                        </div>

                        <h6>
                            No Recent Activity
                        </h6>

                        <p class="mb-0">
                            System activities will appear here.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


    </div>


</div>

@endsection