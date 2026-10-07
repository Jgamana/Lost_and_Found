@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')

@section('content')

<style>

.dashboard-page {
    max-width: 1500px;
    margin: 0 auto;
}

.dashboard-hero {
    background: linear-gradient(135deg, #dceeed, #eef7f6);
    border-radius: 28px;
    padding: 32px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}

.dashboard-hero::after {
    content: '';
    position: absolute;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: rgba(213, 165, 35, 0.12);
    right: -70px;
    top: -80px;
}

.dashboard-hero-content {
    position: relative;
    z-index: 2;
}

.dashboard-label {
    color: #3f6664;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}

.dashboard-title {
    font-size: clamp(26px, 4vw, 38px);
    font-weight: 800;
    color: #294b4a;
    margin-bottom: 8px;
}

.dashboard-subtitle {
    color: #657b7a;
    margin: 0;
}

.dashboard-hero-button {
    background: #3f6664;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    padding: 11px 18px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all .2s ease;
}

.dashboard-hero-button:hover {
    background: #294b4a;
    color: #ffffff;
    transform: translateY(-2px);
}

.dashboard-card {
    background: #ffffff;
    border: 0;
    border-radius: 22px;
    box-shadow: 0 8px 30px rgba(41, 75, 74, 0.07);
    height: 100%;
}

.dashboard-card-body {
    padding: 24px;
}

.dashboard-stat {
    padding: 22px;
    min-height: 150px;
    position: relative;
    overflow: hidden;
}

.dashboard-stat::after {
    content: '';
    position: absolute;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    right: -30px;
    bottom: -35px;
    background: rgba(63, 102, 100, 0.06);
}

.dashboard-stat-label {
    color: #7b8d8c;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
}

.dashboard-stat-number {
    color: #294b4a;
    font-size: 32px;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 8px;
}

.dashboard-stat-note {
    color: #899796;
    font-size: 12px;
}

.dashboard-icon {
    width: 48px;
    height: 48px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.dashboard-icon.teal {
    background: #e0efed;
    color: #3f6664;
}

.dashboard-icon.yellow {
    background: #f8edc9;
    color: #b98c16;
}

.dashboard-icon.green {
    background: #e3f1e7;
    color: #4d8a61;
}

.dashboard-icon.red {
    background: #f8e2df;
    color: #bd655d;
}

.dashboard-section-title {
    color: #294b4a;
    font-weight: 800;
    margin-bottom: 4px;
}

.dashboard-section-text {
    color: #879695;
    font-size: 13px;
    margin-bottom: 0;
}

.dashboard-action {
    display: flex;
    align-items: center;
    gap: 14px;
    width: 100%;
    min-height: 82px;
    padding: 15px 18px;
    background: #f7faf9;
    border: 1px solid #edf2f1;
    border-radius: 17px;
    color: #294b4a;
    text-decoration: none;
    transition: all .2s ease;
}

.dashboard-action:hover {
    background: #eaf3f1;
    color: #294b4a;
    transform: translateY(-2px);
}

.dashboard-action-icon {
    width: 45px;
    height: 45px;
    min-width: 45px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #3f6664;
    color: white;
    font-size: 19px;
}

.dashboard-action-title {
    font-weight: 700;
    font-size: 14px;
}

.dashboard-action-text {
    color: #899796;
    font-size: 11px;
    margin-top: 2px;
}

.dashboard-table {
    margin-bottom: 0;
}

.dashboard-table thead th {
    color: #849291;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .5px;
    font-weight: 700;
    border-bottom: 1px solid #edf1f0;
    padding: 12px;
}

.dashboard-table tbody td {
    padding: 14px 12px;
    border-bottom: 1px solid #f0f3f2;
    color: #465857;
    font-size: 13px;
}

.dashboard-table tbody tr:last-child td {
    border-bottom: 0;
}

.dashboard-item {
    display: flex;
    gap: 13px;
    align-items: flex-start;
    padding: 12px 0;
}

.dashboard-item-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef5f4;
    color: #3f6664;
}

.dashboard-item-title {
    font-size: 13px;
    font-weight: 700;
    color: #344c4b;
}

.dashboard-item-text {
    font-size: 12px;
    color: #899796;
}

.dashboard-divider {
    border-color: #edf1f0;
    opacity: 1;
}

.dashboard-empty {
    text-align: center;
    padding: 35px 15px;
    color: #899796;
}

.dashboard-empty i {
    font-size: 36px;
    display: block;
    margin-bottom: 10px;
}

.dashboard-link {
    color: #3f6664;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
}

.dashboard-link:hover {
    color: #294b4a;
}

.dashboard-match-image {
    width: 100%;
    height: 210px;
    background: #f4f7f6;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-match-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.dashboard-match-dots {
    display: flex;
    justify-content: center;
    gap: 6px;
}

.dashboard-match-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #ccd8d6;
}

.dashboard-match-dot.active {
    background: #3f6664;
    width: 20px;
    border-radius: 10px;
}

@media (max-width: 768px) {

    .dashboard-hero {
        padding: 24px;
        border-radius: 22px;
    }

    .dashboard-card-body {
        padding: 18px;
    }

    .dashboard-stat {
        min-height: 135px;
    }

    .dashboard-stat-number {
        font-size: 27px;
    }

    .dashboard-table {
        min-width: 650px;
    }

}

</style>


@php

    $notifications = \App\Models\Notification::where(
        'user_id',
        auth()->id()
    )
    ->latest()
    ->take(3)
    ->get();

    $myClaims = \App\Models\Claim::where(
        'claimant_id',
        auth()->id()
    )->get();

    $pendingClaims = $myClaims->where(
        'status',
        'pending'
    )->count();

@endphp


<div class="dashboard-page">


    <div class="dashboard-hero">

        <div class="dashboard-hero-content">

            <div class="dashboard-label">
                Lost & Found Management System
            </div>

            <h1 class="dashboard-title">
                Welcome, {{ auth()->user()->name }}!
            </h1>

            <p class="dashboard-subtitle">
                Manage your lost and found reports, claims, and possible matches.
            </p>

            <div class="mt-4">

                <a
                    href="{{ route('student.found-items') }}"
                    class="dashboard-hero-button"
                >
                    <i class="bi bi-grid me-2"></i>
                    Browse Found Items
                </a>

            </div>

        </div>

    </div>


    <div class="row g-3 mb-4">


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card dashboard-stat">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="dashboard-stat-label">
                            Lost Items
                        </div>

                        <div class="dashboard-stat-number">
                            {{ $lostItems->count() }}
                        </div>

                        <div class="dashboard-stat-note">
                            {{ $lostItems->where('lost_date', '>=', now()->startOfMonth())->count() }}
                            this month
                        </div>

                    </div>

                    <div class="dashboard-icon red">
                        <i class="bi bi-search"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card dashboard-stat">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="dashboard-stat-label">
                            Found Items
                        </div>

                        <div class="dashboard-stat-number">
                            {{ $foundItems->count() }}
                        </div>

                        <div class="dashboard-stat-note">
                            {{ $foundItems->where('found_date', '>=', now()->startOfMonth())->count() }}
                            this month
                        </div>

                    </div>

                    <div class="dashboard-icon green">
                        <i class="bi bi-box-seam"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card dashboard-stat">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="dashboard-stat-label">
                            My Claims
                        </div>

                        <div class="dashboard-stat-number">
                            {{ $myClaims->count() }}
                        </div>

                        <div class="dashboard-stat-note">
                            {{ $pendingClaims }} pending
                        </div>

                    </div>

                    <div class="dashboard-icon yellow">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-sm-6 col-xl-3">

            <div class="dashboard-card dashboard-stat">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="dashboard-stat-label">
                            Resolved
                        </div>

                        <div class="dashboard-stat-number">
                            {{ $resolvedItems->count() }}
                        </div>

                        <div class="dashboard-stat-note">
                            {{ $resolvedItems->where('updated_at', '>=', now()->startOfMonth())->count() }}
                            this month
                        </div>

                    </div>

                    <div class="dashboard-icon green">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="dashboard-card dashboard-card-body mb-4">

        <div class="mb-4">

            <h5 class="dashboard-section-title">
                Student Services
            </h5>

            <p class="dashboard-section-text">
                Quickly access your lost and found activities.
            </p>

        </div>


        <div class="row g-3">


            <div class="col-12 col-sm-6 col-lg">

                <a
                    href="{{ url('/student/report-lost') }}"
                    class="dashboard-action"
                >

                    <div class="dashboard-action-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>

                        <div class="dashboard-action-title">
                            Report Lost
                        </div>

                        <div class="dashboard-action-text">
                            Report a missing item
                        </div>

                    </div>

                </a>

            </div>


            <div class="col-12 col-sm-6 col-lg">

                <a
                    href="{{ url('/student/report-found') }}"
                    class="dashboard-action"
                >

                    <div class="dashboard-action-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>

                        <div class="dashboard-action-title">
                            Report Found
                        </div>

                        <div class="dashboard-action-text">
                            Report an item you found
                        </div>

                    </div>

                </a>

            </div>


            <div class="col-12 col-sm-6 col-lg">

                <a
                    href="{{ route('student.found-items') }}"
                    class="dashboard-action"
                >

                    <div class="dashboard-action-icon">
                        <i class="bi bi-grid"></i>
                    </div>

                    <div>

                        <div class="dashboard-action-title">
                            Browse Found
                        </div>

                        <div class="dashboard-action-text">
                            Search found items
                        </div>

                    </div>

                </a>

            </div>


            <div class="col-12 col-sm-6 col-lg">

                <a
                    href="{{ route('student.my-claims') }}"
                    class="dashboard-action"
                >

                    <div class="dashboard-action-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div>

                        <div class="dashboard-action-title">
                            My Claims
                        </div>

                        <div class="dashboard-action-text">
                            Track your claims
                        </div>

                    </div>

                </a>

            </div>


            <div class="col-12 col-sm-6 col-lg">

                <a
                    href="{{ route('student.my-reports') }}"
                    class="dashboard-action"
                >

                    <div class="dashboard-action-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <div>

                        <div class="dashboard-action-title">
                            My Reports
                        </div>

                        <div class="dashboard-action-text">
                            View your reports
                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>


    <div class="row g-4">


        <div class="col-12 col-xl-7">


            <div class="dashboard-card dashboard-card-body mb-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="dashboard-section-title">
                            Recent Reports
                        </h5>

                        <p class="dashboard-section-text">
                            Your latest lost item reports.
                        </p>

                    </div>

                    <a
                        href="{{ route('student.my-reports') }}"
                        class="dashboard-link"
                    >
                        View All
                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table dashboard-table align-middle">

                        <thead>

                            <tr>

                                <th>Item</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($lostItems->take(5) as $item)

                            <tr>

                                <td>

                                    <strong>
                                        {{ $item->item_name }}
                                    </strong>

                                    <div class="text-muted small">

                                        @if($item->category)

                                            {{ $item->category->name }}

                                        @elseif($item->custom_category)

                                            {{ $item->custom_category }}

                                        @else

                                            N/A

                                        @endif

                                    </div>

                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        Lost
                                    </span>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->lost_date)->format('M d, Y') }}
                                </td>

                                <td>

                                    @if($item->status === 'reported')

                                        <span class="badge bg-warning text-dark">
                                            Reported
                                        </span>

                                    @elseif($item->status === 'claimed')

                                        <span class="badge bg-primary">
                                            Claimed
                                        </span>

                                    @elseif($item->status === 'resolved')

                                        <span class="badge bg-success">
                                            Resolved
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route('student.report-details', $item->id) }}"
                                        class="dashboard-link"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5">

                                    <div class="dashboard-empty">

                                        <i class="bi bi-file-earmark-text"></i>

                                        No reports yet.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            <div class="dashboard-card dashboard-card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="dashboard-section-title">
                            Possible Matches
                        </h5>

                        <p class="dashboard-section-text">
                            Possible found items matching your lost reports.
                        </p>

                    </div>

                </div>


                @if($matchData->count() > 0)

                    <div id="possibleMatchesCarousel">

                        @foreach($matchData as $index => $data)

                            <div
                                class="possible-match-slide"
                                style="{{ $index === 0 ? '' : 'display:none;' }}"
                            >

                                @php
                                    $matchedItem = $data['matchedItems']->first();
                                @endphp


                                @if($matchedItem && $matchedItem['foundItem']->image)

                                    <div class="dashboard-match-image mb-4">

                                        <img
                                            src="{{ asset('storage/' . $matchedItem['foundItem']->image) }}"
                                            alt="{{ $matchedItem['foundItem']->item_name }}"
                                        >

                                    </div>

                                @else

                                    <div class="dashboard-match-image mb-4">

                                        <i class="bi bi-image text-muted fs-1"></i>

                                    </div>

                                @endif


                                <div class="mb-3">

                                    <small class="text-muted">
                                        Your Lost Item
                                    </small>

                                    <h6 class="fw-bold mb-1">
                                        {{ $data['lostItem']->item_name }}
                                    </h6>

                                    <small class="text-muted">

                                        {{ $data['lostItem']->category->name ?? 'N/A' }}

                                        •

                                        {{ $data['lostItem']->location->name ?? 'N/A' }}

                                    </small>

                                </div>


                                @if($data['matchCount'] > 0)

                                    <div class="text-center">

                                        <h6 class="fw-bold mb-1">

                                            {{ $data['matchCount'] }}

                                            {{ $data['matchCount'] == 1 ? 'possible match' : 'possible matches' }}

                                            found

                                        </h6>


                                        @if($matchedItem)

                                            <p class="text-muted small mb-2">

                                                Possible found item:

                                                <strong>
                                                    {{ $matchedItem['foundItem']->item_name }}
                                                </strong>

                                            </p>

                                        @endif


                                        <a
                                            href="{{ route('student.report-matches', $data['lostItem']->id) }}"
                                            class="btn btn-sm"
                                            style="background:#3f6664;color:white;border-radius:10px;"
                                        >
                                            View Matches
                                            <i class="bi bi-arrow-right"></i>
                                        </a>

                                    </div>

                                @else

                                    <div class="text-center">

                                        <h6 class="fw-bold mb-1">
                                            No possible matches
                                        </h6>

                                        <p class="text-muted small mb-0">
                                            No matching found items were found yet.
                                        </p>

                                    </div>

                                @endif

                            </div>

                        @endforeach

                    </div>


                    @if($matchData->count() > 1)

                        <div class="dashboard-match-dots mt-3">

                            @foreach($matchData as $index => $data)

                                <span
                                    class="dashboard-match-dot {{ $index === 0 ? 'active' : '' }}"
                                ></span>

                            @endforeach

                        </div>

                    @endif

                @else

                    <div class="dashboard-empty">

                        <i class="bi bi-stars"></i>

                        <div class="fw-bold mb-1">
                            No Lost Reports Yet
                        </div>

                        <div class="small mb-3">
                            Report a lost item to see possible matches.
                        </div>

                        <a
                            href="{{ url('/student/report-lost') }}"
                            class="btn btn-sm"
                            style="background:#3f6664;color:white;border-radius:10px;"
                        >
                            Report Lost Item
                        </a>

                    </div>

                @endif

            </div>


        </div>


        <div class="col-12 col-xl-5">


            <div class="dashboard-card dashboard-card-body mb-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="dashboard-section-title">
                            My Claims
                        </h5>

                        <p class="dashboard-section-text">
                            Your recent claims and their status.
                        </p>

                    </div>

                    <a
                        href="{{ route('student.my-claims') }}"
                        class="dashboard-link"
                    >
                        View All
                    </a>

                </div>


                @forelse($myClaims->take(4) as $claim)

                    <div class="dashboard-item">

                        <div class="dashboard-item-icon">

                            <i class="bi bi-clipboard-check"></i>

                        </div>

                        <div class="flex-grow-1">

                            <div class="dashboard-item-title">
                                {{ $claim->foundItem->item_name ?? 'Unknown Item' }}
                            </div>

                            <div class="dashboard-item-text">

                                Claim status:

                                <strong>
                                    {{ ucfirst($claim->status) }}
                                </strong>

                            </div>

                            <small class="text-muted">
                                {{ $claim->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>

                    @if(!$loop->last)
                        <hr class="dashboard-divider">
                    @endif

                @empty

                    <div class="dashboard-empty">

                        <i class="bi bi-clipboard-check"></i>

                        No claims submitted yet.

                    </div>

                @endforelse

            </div>


            <div class="dashboard-card dashboard-card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="dashboard-section-title">
                            Notifications
                        </h5>

                        <p class="dashboard-section-text">
                            Your latest system notifications.
                        </p>

                    </div>

                    <a
                        href="{{ route('notifications') }}"
                        class="dashboard-link"
                    >
                        View All
                    </a>

                </div>


                @forelse($notifications as $notification)

                    <div class="dashboard-item">

                        <div class="dashboard-item-icon">

                            @if($notification->type === 'claim')

                                <i class="bi bi-clipboard-check"></i>

                            @else

                                <i class="bi bi-bell"></i>

                            @endif

                        </div>


                        <div class="flex-grow-1">

                            <div class="dashboard-item-title">

                                {{ $notification->title }}

                                @if(!$notification->is_read)

                                    <span class="badge bg-danger">
                                        New
                                    </span>

                                @endif

                            </div>


                            <div class="dashboard-item-text">

                                {{ $notification->message }}

                            </div>


                            <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>


                    @if(!$loop->last)
                        <hr class="dashboard-divider">
                    @endif

                @empty

                    <div class="dashboard-empty">

                        <i class="bi bi-bell-slash"></i>

                        No notifications yet.

                    </div>

                @endforelse

            </div>


        </div>

    </div>

</div>


@if($matchData->count() > 1)

<script>

document.addEventListener('DOMContentLoaded', function () {

    const slides = document.querySelectorAll(
        '#possibleMatchesCarousel .possible-match-slide'
    );

    const dots = document.querySelectorAll(
        '.dashboard-match-dot'
    );

    let currentSlide = 0;

    function showSlide(index) {

        slides.forEach(function (slide, i) {

            slide.style.display =
                i === index ? 'block' : 'none';

        });

        dots.forEach(function (dot, i) {

            dot.classList.toggle(
                'active',
                i === index
            );

        });

    }

    setInterval(function () {

        currentSlide++;

        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }

        showSlide(currentSlide);

    }, 4000);

});

</script>

@endif

@endsection