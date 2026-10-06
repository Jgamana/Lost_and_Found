@extends('layouts.app')

@section('title', 'My Found Reports')

@section('content')

<style>

.student-found-reports-page {
    --report-teal: #365c5a;
    --report-teal-dark: #294947;
    --report-gold: #d6a51d;
    --report-border: #e4eceb;
    --report-text: #263b3a;
    --report-muted: #7b8d8b;
    --report-light: #eef5f3;
}


/* PAGE HEADER */

.student-found-reports-page .page-heading {
    margin-bottom: 24px;
}

.student-found-reports-page .page-label {
    color: var(--report-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-found-reports-page .page-heading h1 {
    color: var(--report-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-found-reports-page .page-heading p {
    color: var(--report-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* SUCCESS ALERT */

.found-report-alert {
    display: flex;
    align-items: center;
    gap: 9px;
    background: #edf8f0;
    border: 1px solid #cfe5d5;
    color: #43835a;
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 12px;
    margin-bottom: 20px;
}

.found-report-alert i {
    font-size: 15px;
}


/* MAIN CARD */

.found-reports-card {
    background: #ffffff;
    border: 1px solid var(--report-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.found-reports-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding: 22px 24px;
    border-bottom: 1px solid var(--report-border);
}

.found-reports-header-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    background: var(--report-light);
    color: var(--report-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.found-reports-title {
    color: var(--report-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.found-reports-description {
    color: var(--report-muted);
    font-size: 12px;
    margin-bottom: 0;
}


/* TABLE */

.found-reports-table-wrapper {
    overflow-x: auto;
}

.found-reports-table {
    width: 100%;
    min-width: 850px;
    margin: 0;
}

.found-reports-table thead th {
    background: #f4f8f7;
    color: var(--report-text);
    border-bottom: 1px solid var(--report-border);
    font-size: 11px;
    font-weight: 700;
    padding: 14px 16px;
    white-space: nowrap;
}

.found-reports-table tbody td {
    color: #526260;
    border-bottom: 1px solid #edf2f1;
    font-size: 12px;
    padding: 15px 16px;
    vertical-align: middle;
}

.found-reports-table tbody tr:last-child td {
    border-bottom: none;
}

.found-reports-table tbody tr:hover {
    background: #fafcfc;
}


/* ITEM */

.found-report-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.found-report-item-icon {
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    background: var(--report-light);
    color: var(--report-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.found-report-item-name {
    color: var(--report-text);
    font-size: 13px;
    font-weight: 700;
}


/* STATUS */

.found-report-status {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.found-status-awaiting {
    background: #fff6dc;
    color: #967414;
}

.found-status-received {
    background: #e8f0f7;
    color: #4d718d;
}

.found-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.found-status-claimed {
    background: #e8eef8;
    color: #506d9a;
}

.found-status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.found-status-default {
    background: #eef2f1;
    color: #64716f;
}


/* VIEW BUTTON */

.found-report-view-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 34px;
    padding: 0 11px;
    border-radius: 9px;
    border: 1px solid #cbdedb;
    background: #eef5f3;
    color: var(--report-teal);
    text-decoration: none;
    font-size: 10px;
    font-weight: 700;
    transition: 0.2s ease;
}

.found-report-view-button:hover {
    background: var(--report-teal);
    border-color: var(--report-teal);
    color: #ffffff;
}


/* EMPTY STATE */

.found-reports-empty {
    text-align: center;
    padding: 60px 25px;
}

.found-reports-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: var(--report-light);
    color: var(--report-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.found-reports-empty h5 {
    color: var(--report-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 7px;
}

.found-reports-empty p {
    color: var(--report-muted);
    font-size: 12px;
    margin-bottom: 22px;
}

.found-report-create-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    min-height: 41px;
    padding: 0 16px;
    border-radius: 10px;
    background: var(--report-teal);
    color: #ffffff;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    transition: 0.2s ease;
}

.found-report-create-button:hover {
    background: var(--report-teal-dark);
    color: #ffffff;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-found-reports-page .page-heading h1 {
        font-size: 26px;
    }

    .found-reports-header {
        padding: 19px;
    }

    .found-reports-table {
        min-width: 800px;
    }

    .found-reports-empty {
        padding: 50px 20px;
    }

}

</style>


<div class="student-found-reports-page">


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="found-report-alert">

            <i class="bi bi-check-circle"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- PAGE HEADER --}}

    <div class="page-heading">

        <div class="page-label">
            Found Items
        </div>

        <h1>
            My Found Reports
        </h1>

        <p>
            View the items you have reported as found.
        </p>

    </div>


    {{-- REPORTS CARD --}}

    <div class="found-reports-card">

        <div class="found-reports-header">

            <div class="found-reports-header-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>

                <h5 class="found-reports-title">
                    Found Item Reports
                </h5>

                <p class="found-reports-description">
                    List of your submitted found item reports.
                </p>

            </div>

        </div>


        @if($foundItems->count() > 0)

            <div class="found-reports-table-wrapper">

                <table class="table align-middle found-reports-table">

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
                                Status
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($foundItems as $item)

                            <tr>

                                {{-- ITEM --}}

                                <td>

                                    <div class="found-report-item">

                                        <div class="found-report-item-icon">
                                            <i class="bi bi-box-seam"></i>
                                        </div>

                                        <div class="found-report-item-name">
                                            {{ $item->item_name }}
                                        </div>

                                    </div>

                                </td>


                                {{-- CATEGORY --}}

                                <td>
                                    {{ $item->category->name ?? 'N/A' }}
                                </td>


                                {{-- LOCATION --}}

                                <td>
                                    {{ $item->location->name ?? 'N/A' }}
                                </td>


                                {{-- DATE FOUND --}}

                                <td>

                                    {{ \Carbon\Carbon::parse(
                                        $item->found_date
                                    )->format('M d, Y') }}

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($item->status === 'awaiting_surrender')

                                        <span class="found-report-status found-status-awaiting">
                                            Awaiting Surrender
                                        </span>

                                    @elseif($item->status === 'received')

                                        <span class="found-report-status found-status-received">
                                            Received
                                        </span>

                                    @elseif($item->status === 'approved')

                                        <span class="found-report-status found-status-approved">
                                            Approved
                                        </span>

                                    @elseif($item->status === 'claimed')

                                        <span class="found-report-status found-status-claimed">
                                            Claimed
                                        </span>

                                    @elseif($item->status === 'rejected')

                                        <span class="found-report-status found-status-rejected">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="found-report-status found-status-default">
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}

                                <td>

                                    <a
                                        href="{{ route(
                                            'student.found-report-details',
                                            $item->id
                                        ) }}"
                                        class="found-report-view-button"
                                    >

                                        <i class="bi bi-eye"></i>

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @else

            {{-- EMPTY STATE --}}

            <div class="found-reports-empty">

                <div class="found-reports-empty-icon">

                    <i class="bi bi-box-seam"></i>

                </div>

                <h5>
                    No Found Reports Yet
                </h5>

                <p>
                    You have not reported any found items yet.
                </p>

                <a
                    href="{{ url('/student/report-found') }}"
                    class="found-report-create-button"
                >

                    <i class="bi bi-plus-circle"></i>

                    Report Found Item

                </a>

            </div>

        @endif

    </div>

</div>

@endsection