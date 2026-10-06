@extends('layouts.app')

@section('title', 'Faculty Dashboard')
@section('page-title', 'Faculty Dashboard')

@section('content')

<style>

.faculty-dashboard {
    --faculty-teal: #365c5a;
    --faculty-teal-dark: #294947;
    --faculty-gold: #d6a51d;
    --faculty-border: #e4eceb;
    --faculty-text: #263b3a;
    --faculty-muted: #7b8d8b;
}

.faculty-hero {
    position: relative;
    overflow: hidden;
    background: var(--faculty-teal);
    border-radius: 24px;
    padding: 32px;
    color: white;
    margin-bottom: 24px;
}

.faculty-hero::before {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    right: -75px;
    top: -110px;
    border-radius: 50%;
    background: rgba(214,165,29,0.22);
}

.faculty-hero::after {
    content: "";
    position: absolute;
    width: 190px;
    height: 190px;
    right: 150px;
    bottom: -135px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
}

.faculty-hero-content {
    position: relative;
    z-index: 2;
}

.faculty-hero-label {
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

.faculty-hero-title {
    font-size: clamp(26px,4vw,38px);
    font-weight: 700;
    line-height: 1.15;
    margin-bottom: 10px;
}

.faculty-hero-text {
    max-width: 650px;
    color: rgba(255,255,255,0.76);
    margin-bottom: 22px;
}

.faculty-hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.faculty-hero-button {
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

.faculty-hero-button-primary {
    background: var(--faculty-gold);
    color: white;
}

.faculty-hero-button-primary:hover {
    background: #bd9015;
    color: white;
    transform: translateY(-1px);
}

.faculty-hero-button-light {
    background: rgba(255,255,255,0.12);
    color: white;
    border: 1px solid rgba(255,255,255,0.15);
}

.faculty-hero-button-light:hover {
    background: rgba(255,255,255,0.18);
    color: white;
}

.faculty-stat-grid {
    display: grid;
    grid-template-columns: repeat(4,minmax(0,1fr));
    gap: 18px;
    margin-bottom: 24px;
}

.faculty-stat-card {
    background: white;
    border: 1px solid var(--faculty-border);
    border-radius: 18px;
    padding: 21px;
    min-height: 135px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    transition: 0.2s ease;
}

.faculty-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(41,73,71,0.08);
}

.faculty-stat-label {
    color: var(--faculty-muted);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 7px;
}

.faculty-stat-number {
    color: var(--faculty-text);
    font-size: 29px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 8px;
}

.faculty-stat-description {
    color: var(--faculty-muted);
    font-size: 12px;
}

.faculty-stat-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.faculty-stat-icon.blue {
    background: #e8f0f7;
    color: #4d6f8c;
}

.faculty-stat-icon.teal {
    background: #e4f0ef;
    color: var(--faculty-teal);
}

.faculty-stat-icon.gold {
    background: #fbf2d7;
    color: #b68b13;
}

.faculty-stat-icon.green {
    background: #e5f3ea;
    color: #43835a;
}

.faculty-section-card {
    background: white;
    border: 1px solid var(--faculty-border);
    border-radius: 20px;
    padding: 22px;
    height: 100%;
}

.faculty-section-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}

.faculty-section-heading h5 {
    color: var(--faculty-text);
    font-weight: 700;
    margin-bottom: 4px;
}

.faculty-section-heading p {
    color: var(--faculty-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.faculty-services-grid {
    display: grid;
    grid-template-columns: repeat(4,minmax(0,1fr));
    gap: 12px;
}

.faculty-service-item {
    position: relative;
    display: flex;
    flex-direction: column;
    min-height: 125px;
    padding: 17px;
    background: #f7faf9;
    border: 1px solid var(--faculty-border);
    border-radius: 16px;
    color: var(--faculty-text);
    text-decoration: none;
    transition: 0.2s ease;
}

.faculty-service-item:hover {
    background: var(--faculty-teal);
    border-color: var(--faculty-teal);
    color: white;
    transform: translateY(-2px);
}

.faculty-service-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 11px;
    color: var(--faculty-teal);
    font-size: 18px;
    margin-bottom: 14px;
}

.faculty-service-item:hover .faculty-service-icon {
    background: rgba(255,255,255,0.15);
    color: white;
}

.faculty-service-title {
    font-size: 13px;
    font-weight: 700;
}

.faculty-service-description {
    color: var(--faculty-muted);
    font-size: 11px;
    margin-top: 3px;
}

.faculty-service-item:hover .faculty-service-description {
    color: rgba(255,255,255,0.72);
}

.faculty-service-arrow {
    position: absolute;
    right: 14px;
    bottom: 14px;
    font-size: 12px;
    opacity: 0.45;
}

.faculty-table {
    margin-bottom: 0;
}

.faculty-table thead th {
    color: var(--faculty-muted);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 700;
    border-bottom: 1px solid var(--faculty-border);
    padding: 12px 10px;
    white-space: nowrap;
}

.faculty-table tbody td {
    border-bottom: 1px solid #eef2f1;
    padding: 13px 10px;
    font-size: 13px;
    color: var(--faculty-text);
}

.faculty-table tbody tr:last-child td {
    border-bottom: 0;
}

.faculty-item-name {
    font-weight: 700;
    color: var(--faculty-text);
}

.faculty-item-meta {
    color: var(--faculty-muted);
    font-size: 11px;
    margin-top: 2px;
}

.faculty-claim-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 0;
}

.faculty-claim-item + .faculty-claim-item {
    border-top: 1px solid #edf1f0;
}

.faculty-claim-icon {
    width: 41px;
    height: 41px;
    min-width: 41px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fbf2d7;
    color: #b68b13;
    border-radius: 11px;
}

.faculty-claim-title {
    color: var(--faculty-text);
    font-size: 13px;
    font-weight: 700;
}

.faculty-claim-description {
    color: var(--faculty-muted);
    font-size: 11px;
    line-height: 1.5;
}

.faculty-empty {
    text-align: center;
    padding: 35px 20px;
}

.faculty-empty-icon {
    width: 55px;
    height: 55px;
    margin: 0 auto 12px;
    border-radius: 16px;
    background: #eef4f3;
    color: var(--faculty-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
}

.faculty-empty h6 {
    color: var(--faculty-text);
    font-weight: 700;
}

.faculty-empty p {
    color: var(--faculty-muted);
    font-size: 12px;
}

@media (max-width: 1400px) {

    .faculty-services-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }

}

@media (max-width: 1200px) {

    .faculty-stat-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }

}

@media (max-width: 768px) {

    .faculty-hero {
        padding: 24px;
        border-radius: 19px;
    }

    .faculty-hero-title {
        font-size: 27px;
    }

    .faculty-stat-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
        gap: 12px;
    }

    .faculty-stat-card {
        min-height: 120px;
        padding: 17px;
    }

    .faculty-stat-number {
        font-size: 25px;
    }

    .faculty-section-card {
        padding: 17px;
        border-radius: 17px;
    }

    .faculty-services-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }

}

@media (max-width: 576px) {

    .faculty-hero {
        padding: 21px;
    }

    .faculty-hero-actions {
        flex-direction: column;
    }

    .faculty-hero-button {
        justify-content: center;
        width: 100%;
    }

    .faculty-stat-grid {
        grid-template-columns: 1fr;
    }

    .faculty-services-grid {
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .faculty-service-item {
        min-height: 110px;
        padding: 13px;
    }

    .faculty-service-title {
        font-size: 12px;
    }

    .faculty-section-heading {
        flex-direction: column;
        align-items: flex-start;
    }

}

</style>


<div class="faculty-dashboard">


    <div class="faculty-hero">

        <div class="faculty-hero-content">

            <div class="faculty-hero-label">

                <i class="bi bi-person-badge"></i>

                Faculty Portal

            </div>


            <h1 class="faculty-hero-title">

                Welcome, {{ auth()->user()->name }}!

            </h1>


            <p class="faculty-hero-text">

                Manage lost and found reports, review claims,
                verify found items, and monitor item records.

            </p>


            <div class="faculty-hero-actions">

                <a
                    href="{{ route('faculty.browse-found-items') }}"
                    class="faculty-hero-button faculty-hero-button-light"
                >

                    <i class="bi bi-grid"></i>

                    Browse Found Items

                </a>

            </div>

        </div>

    </div>


    <div class="faculty-stat-grid">


        <div class="faculty-stat-card">

            <div>

                <div class="faculty-stat-label">
                    Lost Items
                </div>

                <div class="faculty-stat-number">
                    {{ $lostItems }}
                </div>

                <div class="faculty-stat-description">
                    Total lost item reports
                </div>

            </div>


            <div class="faculty-stat-icon blue">
                <i class="bi bi-search"></i>
            </div>

        </div>


        <div class="faculty-stat-card">

            <div>

                <div class="faculty-stat-label">
                    Found Items
                </div>

                <div class="faculty-stat-number">
                    {{ $foundItems }}
                </div>

                <div class="faculty-stat-description">
                    Total found item reports
                </div>

            </div>


            <div class="faculty-stat-icon teal">
                <i class="bi bi-box-seam"></i>
            </div>

        </div>


        <div class="faculty-stat-card">

            <div>

                <div class="faculty-stat-label">
                    Pending Claims
                </div>

                <div class="faculty-stat-number">
                    {{ $pendingClaims }}
                </div>

                <div class="faculty-stat-description">
                    Claims awaiting review
                </div>

            </div>


            <div class="faculty-stat-icon gold">
                <i class="bi bi-clipboard-check"></i>
            </div>

        </div>


        <div class="faculty-stat-card">

            <div>

                <div class="faculty-stat-label">
                    Resolved Claims
                </div>

                <div class="faculty-stat-number">
                    {{ $resolvedClaims }}
                </div>

                <div class="faculty-stat-description">
                    Approved or rejected claims
                </div>

            </div>


            <div class="faculty-stat-icon green">
                <i class="bi bi-check-circle"></i>
            </div>

        </div>


    </div>


    <div class="faculty-section-card mb-4">

        <div class="faculty-section-heading">

            <div>

                <h5>
                    Faculty Services
                </h5>

                <p>
                    Quickly access your main Lost and Found management services.
                </p>

            </div>

        </div>


        <div class="faculty-services-grid">


            <a
                href="{{ route('faculty.lost-items') }}"
                class="faculty-service-item"
            >

                <div class="faculty-service-icon">
                    <i class="bi bi-search"></i>
                </div>

                <div class="faculty-service-title">
                    Browse Lost Items
                </div>

                <div class="faculty-service-description">
                    View reported lost items.
                </div>

                <i class="bi bi-arrow-up-right faculty-service-arrow"></i>

            </a>


            <a
                href="{{ route('faculty.browse-found-items') }}"
                class="faculty-service-item"
            >

                <div class="faculty-service-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="faculty-service-title">
                    Browse Found Items
                </div>

                <div class="faculty-service-description">
                    Browse available found items.
                </div>

                <i class="bi bi-arrow-up-right faculty-service-arrow"></i>

            </a>


            <a
                href="{{ route('faculty.found-items') }}"
                class="faculty-service-item"
            >

                <div class="faculty-service-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>

                <div class="faculty-service-title">
                    Verify Found Items
                </div>

                <div class="faculty-service-description">
                    Review submitted found items.
                </div>

                <i class="bi bi-arrow-up-right faculty-service-arrow"></i>

            </a>


            <a
                href="{{ route('faculty.claims') }}"
                class="faculty-service-item"
            >

                <div class="faculty-service-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <div class="faculty-service-title">
                    Review Claims
                </div>

                <div class="faculty-service-description">
                    Review and process claims.
                </div>

                <i class="bi bi-arrow-up-right faculty-service-arrow"></i>

            </a>


        </div>

    </div>


    <div class="row g-4">


        <div class="col-12 col-xl-7">


            <div class="faculty-section-card">

                <div class="faculty-section-heading">

                    <div>

                        <h5>
                            Recent Reports
                        </h5>

                        <p>
                            Recently submitted lost and found reports.
                        </p>

                    </div>


                    <a
                        href="{{ route('faculty.lost-items') }}"
                        class="btn btn-sm btn-outline-secondary"
                    >
                        View Reports
                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table faculty-table align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Item
                                </th>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Reported By
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($recentReports as $report)

                                <tr>

                                    <td>

                                        <div class="faculty-item-name">
                                            {{ $report['item_name'] }}
                                        </div>

                                    </td>


                                    <td>

                                        @if ($report['type'] === 'Lost')

                                            <span class="badge bg-danger">
                                                Lost
                                            </span>

                                        @else

                                            <span class="badge bg-success">
                                                Found
                                            </span>

                                        @endif

                                    </td>


                                    <td>
                                        {{ $report['reported_by'] }}
                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $report['date']
                                        )->format('M d, Y') }}

                                    </td>


                                    <td>

                                        @if ($report['status'] === 'reported')

                                            <span class="badge bg-warning text-dark">
                                                Reported
                                            </span>

                                        @elseif ($report['status'] === 'awaiting_surrender')

                                            <span class="badge bg-warning text-dark">
                                                Awaiting Surrender
                                            </span>

                                        @elseif ($report['status'] === 'received')

                                            <span class="badge bg-info">
                                                Received
                                            </span>

                                        @elseif ($report['status'] === 'approved')

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        @elseif ($report['status'] === 'claimed')

                                            <span class="badge bg-primary">
                                                Claimed
                                            </span>

                                        @elseif ($report['status'] === 'rejected')

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        @elseif ($report['status'] === 'resolved')

                                            <span class="badge bg-success">
                                                Resolved
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($report['status']) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="text-center"
                                    >

                                        <div class="faculty-empty">

                                            <div class="faculty-empty-icon">

                                                <i class="bi bi-file-earmark-text"></i>

                                            </div>

                                            <h6>
                                                No Recent Reports
                                            </h6>

                                            <p class="mb-0">
                                                Recently submitted reports will appear here.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


        </div>


        <div class="col-12 col-xl-5">


            <div class="faculty-section-card">

                <div class="faculty-section-heading">

                    <div>

                        <h5>
                            Pending Claims
                        </h5>

                        <p>
                            Claims that require faculty review.
                        </p>

                    </div>


                    <a
                        href="{{ route('faculty.claims') }}"
                        class="btn btn-sm btn-outline-secondary"
                    >
                        View All
                    </a>

                </div>


                @forelse ($pendingClaimsList as $claim)

                    <div class="faculty-claim-item">

                        <div class="faculty-claim-icon">

                            <i class="bi bi-clipboard-check"></i>

                        </div>


                        <div class="flex-grow-1">

                            <div class="faculty-claim-title">

                                {{ $claim->foundItem->item_name ?? 'Unknown Item' }}

                            </div>


                            <div class="faculty-claim-description">

                                Submitted by
                                {{ $claim->claimant->name ?? 'Unknown User' }}

                            </div>


                            <div class="faculty-claim-description">

                                {{ $claim->created_at->diffForHumans() }}

                            </div>

                        </div>


                        <a
                            href="{{ route('faculty.claims') }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Review
                        </a>

                    </div>

                @empty

                    <div class="faculty-empty">

                        <div class="faculty-empty-icon">

                            <i class="bi bi-check-circle"></i>

                        </div>

                        <h6>
                            No Pending Claims
                        </h6>

                        <p class="mb-0">
                            There are currently no claims waiting for review.
                        </p>

                    </div>

                @endforelse

            </div>


        </div>


    </div>


</div>

@endsection