@extends('layouts.app')

@section('title', 'My Claims')

@section('content')

<style>

.student-claims-page {
    --claim-teal: #365c5a;
    --claim-teal-dark: #294947;
    --claim-gold: #d6a51d;
    --claim-border: #e4eceb;
    --claim-text: #263b3a;
    --claim-muted: #7b8d8b;
    --claim-light: #eef5f3;
}


/* PAGE HEADER */

.student-claims-page .page-heading {
    margin-bottom: 24px;
}

.student-claims-page .page-label {
    color: var(--claim-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-claims-page .page-heading h1 {
    color: var(--claim-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-claims-page .page-heading p {
    color: var(--claim-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* MAIN CARD */

.claims-main-card {
    background: #ffffff;
    border: 1px solid var(--claim-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.claims-card-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding: 22px 24px;
    border-bottom: 1px solid var(--claim-border);
}

.claims-header-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    background: var(--claim-light);
    color: var(--claim-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.claims-header-title {
    color: var(--claim-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.claims-header-text {
    color: var(--claim-muted);
    font-size: 12px;
    margin-bottom: 0;
}


/* TABLE */

.claims-table-wrapper {
    overflow-x: auto;
}

.claims-table {
    width: 100%;
    margin: 0;
    min-width: 950px;
}

.claims-table thead th {
    background: #f4f8f7;
    color: var(--claim-text);
    border-bottom: 1px solid var(--claim-border);
    font-size: 11px;
    font-weight: 700;
    padding: 14px 16px;
    white-space: nowrap;
}

.claims-table tbody td {
    color: #526260;
    border-bottom: 1px solid #edf2f1;
    font-size: 12px;
    padding: 15px 16px;
    vertical-align: middle;
}

.claims-table tbody tr:last-child td {
    border-bottom: none;
}

.claims-table tbody tr:hover {
    background: #fafcfc;
}


/* ITEM */

.claim-item-name {
    color: var(--claim-text);
    font-size: 13px;
    font-weight: 700;
    line-height: 1.35;
}


/* STATUS */

.claim-status {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.claim-status-pending {
    background: #fff6dc;
    color: #967414;
}

.claim-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.claim-status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.claim-status-default {
    background: #eef2f1;
    color: #64716f;
}


/* RELEASE SCHEDULE */

.release-schedule {
    min-width: 220px;
}

.release-detail {
    display: flex;
    align-items: flex-start;
    gap: 7px;
    margin-bottom: 6px;
    color: #526260;
    font-size: 11px;
    line-height: 1.4;
}

.release-detail:last-child {
    margin-bottom: 0;
}

.release-detail i {
    color: var(--claim-teal);
    font-size: 12px;
    margin-top: 1px;
}

.release-detail strong {
    color: var(--claim-text);
    font-weight: 700;
}

.release-waiting {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--claim-muted);
    font-size: 11px;
    font-weight: 500;
}

.release-cancelled {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #bd5555;
    font-size: 11px;
    font-weight: 700;
}


/* EMPTY STATE */

.claims-empty-state {
    text-align: center;
    padding: 60px 25px;
}

.claims-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: var(--claim-light);
    color: var(--claim-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.claims-empty-state h5 {
    color: var(--claim-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 7px;
}

.claims-empty-state p {
    color: var(--claim-muted);
    font-size: 12px;
    margin-bottom: 22px;
}

.claims-browse-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    min-height: 41px;
    padding: 0 16px;
    border-radius: 10px;
    background: var(--claim-teal);
    color: #ffffff;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    transition: 0.2s ease;
}

.claims-browse-button:hover {
    background: var(--claim-teal-dark);
    color: #ffffff;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-claims-page .page-heading h1 {
        font-size: 26px;
    }

    .claims-card-header {
        padding: 19px;
    }

    .claims-table {
        min-width: 900px;
    }

    .claims-empty-state {
        padding: 50px 20px;
    }

}

</style>


<div class="student-claims-page">

    <div class="page-heading">

        <div class="page-label">
            Claims
        </div>

        <h1>
            My Claims
        </h1>

        <p>
            View the found items you have submitted claims for.
        </p>

    </div>


    <div class="claims-main-card">

        <div class="claims-card-header">

            <div class="claims-header-icon">
                <i class="bi bi-clipboard-check"></i>
            </div>

            <div>

                <h5 class="claims-header-title">
                    My Submitted Claims
                </h5>

                <p class="claims-header-text">
                    Track the status of your claims and release schedule.
                </p>

            </div>

        </div>


        @if($claims->count() > 0)

            <div class="claims-table-wrapper">

                <table class="table align-middle claims-table">

                    <thead>

                        <tr>

                            <th>
                                Item
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Location
                            </th>

                            <th>
                                Date Found
                            </th>

                            <th>
                                Claim Status
                            </th>

                            <th>
                                Release Schedule
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($claims as $claim)

                            <tr>

                                {{-- ITEM --}}

                                <td>

                                    <div class="claim-item-name">
                                        {{ $claim->foundItem->item_name ?? 'N/A' }}
                                    </div>

                                </td>


                                {{-- CATEGORY --}}

                                <td>
                                    {{ $claim->foundItem->category->name ?? 'N/A' }}
                                </td>


                                {{-- LOCATION --}}

                                <td>
                                    {{ $claim->foundItem->location->name ?? 'N/A' }}
                                </td>


                                {{-- DATE FOUND --}}

                                <td>

                                    @if($claim->foundItem)

                                        {{ \Carbon\Carbon::parse(
                                            $claim->foundItem->found_date
                                        )->format('M d, Y') }}

                                    @else

                                        N/A

                                    @endif

                                </td>


                                {{-- CLAIM STATUS --}}

                                <td>

                                    @if($claim->status === 'pending')

                                        <span class="claim-status claim-status-pending">
                                            Pending
                                        </span>

                                    @elseif($claim->status === 'approved')

                                        <span class="claim-status claim-status-approved">
                                            Approved
                                        </span>

                                    @elseif($claim->status === 'rejected')

                                        <span class="claim-status claim-status-rejected">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="claim-status claim-status-default">
                                            {{ ucfirst($claim->status) }}
                                        </span>

                                    @endif

                                </td>


                                {{-- RELEASE SCHEDULE --}}

                                <td>

                                    @if($claim->status === 'rejected')

                                        @if(
                                            $claim->release_date ||
                                            $claim->release_time ||
                                            $claim->release_location
                                        )

                                            <span class="release-cancelled">

                                                <i class="bi bi-calendar-x"></i>

                                                Schedule Cancelled

                                            </span>

                                        @else

                                            <span class="release-cancelled">

                                                <i class="bi bi-x-circle"></i>

                                                Claim Cancelled

                                            </span>

                                        @endif


                                    @elseif(
                                        $claim->release_date &&
                                        $claim->release_time &&
                                        $claim->release_location
                                    )

                                        <div class="release-schedule">

                                            <div class="release-detail">

                                                <i class="bi bi-calendar-event"></i>

                                                <span>

                                                    <strong>
                                                        Date:
                                                    </strong>

                                                    {{ \Carbon\Carbon::parse(
                                                        $claim->release_date
                                                    )->format('M d, Y') }}

                                                </span>

                                            </div>


                                            <div class="release-detail">

                                                <i class="bi bi-clock"></i>

                                                <span>

                                                    <strong>
                                                        Time:
                                                    </strong>

                                                    {{ \Carbon\Carbon::parse(
                                                        $claim->release_time
                                                    )->format('h:i A') }}

                                                </span>

                                            </div>


                                            <div class="release-detail">

                                                <i class="bi bi-geo-alt"></i>

                                                <span>

                                                    <strong>
                                                        Location:
                                                    </strong>

                                                    {{ $claim->release_location }}

                                                </span>

                                            </div>

                                        </div>


                                    @else

                                        <span class="release-waiting">

                                            <i class="bi bi-hourglass-split"></i>

                                            Waiting for release schedule

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @else

            <div class="claims-empty-state">

                <div class="claims-empty-icon">

                    <i class="bi bi-clipboard-x"></i>

                </div>

                <h5>
                    No Claims Yet
                </h5>

                <p>
                    You have not submitted any claims for found items.
                </p>

                <a
                    href="{{ route('student.found-items') }}"
                    class="claims-browse-button"
                >

                    <i class="bi bi-box-seam"></i>

                    Browse Found Items

                </a>

            </div>

        @endif

    </div>

</div>

@endsection