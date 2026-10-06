@extends('layouts.app')

@section('title', 'My Reports')

@section('content')

<style>

.student-my-reports-page {
    --report-teal: #365c5a;
    --report-teal-dark: #294947;
    --report-gold: #d6a51d;
    --report-border: #e4eceb;
    --report-text: #263b3a;
    --report-muted: #7b8d8b;
    --report-light: #eef5f3;
}


/* PAGE HEADER */

.student-my-reports-page .page-heading {
    margin-bottom: 24px;
}

.student-my-reports-page .page-label {
    color: var(--report-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-my-reports-page .page-heading h1 {
    color: var(--report-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-my-reports-page .page-heading p {
    color: var(--report-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* MAIN CARD */

.my-reports-card {
    background: #ffffff;
    border: 1px solid var(--report-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    padding: 24px;
}


/* TYPE SWITCHER */

.report-type-switcher {
    display: flex;
    gap: 9px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--report-border);
}

.report-type-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 39px;
    padding: 0 17px;
    border-radius: 10px;
    border: 1px solid var(--report-border);
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s ease;
}

.report-type-button.active {
    background: var(--report-teal);
    border-color: var(--report-teal);
    color: #ffffff;
}

.report-type-button:not(.active) {
    background: #ffffff;
    color: var(--report-teal);
}

.report-type-button:not(.active):hover {
    background: var(--report-light);
    border-color: #cbdedb;
}


/* SECTION HEADER */

.my-reports-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 20px;
}

.my-reports-section-heading {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.my-reports-section-icon {
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

.my-reports-section-title {
    color: var(--report-text);
    font-size: 17px;
    font-weight: 700;
    margin: 1px 0 4px;
}

.my-reports-section-text {
    color: var(--report-muted);
    font-size: 12px;
    margin: 0;
}


/* CREATE BUTTON */

.my-reports-create-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 39px;
    padding: 0 15px;
    border-radius: 10px;
    background: var(--report-teal);
    color: #ffffff;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
    transition: 0.2s ease;
}

.my-reports-create-button:hover {
    background: var(--report-teal-dark);
    color: #ffffff;
}


/* TABLE */

.my-reports-table-wrapper {
    overflow-x: auto;
    border: 1px solid var(--report-border);
    border-radius: 14px;
}

.my-reports-table {
    width: 100%;
    min-width: 850px;
    margin: 0;
}

.my-reports-table thead th {
    background: #f4f8f7;
    color: var(--report-text);
    border-bottom: 1px solid var(--report-border);
    font-size: 11px;
    font-weight: 700;
    padding: 14px 15px;
    white-space: nowrap;
}

.my-reports-table tbody td {
    color: #526260;
    border-bottom: 1px solid #edf2f1;
    font-size: 12px;
    padding: 15px;
    vertical-align: middle;
}

.my-reports-table tbody tr:last-child td {
    border-bottom: none;
}

.my-reports-table tbody tr:hover {
    background: #fafcfc;
}


/* ITEM */

.my-report-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.my-report-item-icon {
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

.my-report-item-name {
    color: var(--report-text);
    font-size: 13px;
    font-weight: 700;
}


/* STATUS */

.my-report-status {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.status-reported {
    background: #fff6dc;
    color: #967414;
}

.status-awaiting {
    background: #fff6dc;
    color: #967414;
}

.status-received {
    background: #e8f0f7;
    color: #4d718d;
}

.status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.status-claimed {
    background: #e8eef8;
    color: #506d9a;
}

.status-resolved {
    background: #e5f3ea;
    color: #43835a;
}

.status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.status-default {
    background: #eef2f1;
    color: #64716f;
}


/* VIEW BUTTON */

.my-report-view-button {
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

.my-report-view-button:hover {
    background: var(--report-teal);
    border-color: var(--report-teal);
    color: #ffffff;
}


/* EMPTY STATE */

.my-reports-empty {
    text-align: center;
    padding: 55px 20px;
    border: 1px dashed #d9e5e3;
    border-radius: 15px;
    background: #fbfdfc;
}

.my-reports-empty-icon {
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

.my-reports-empty h5 {
    color: var(--report-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 7px;
}

.my-reports-empty p {
    color: var(--report-muted);
    font-size: 12px;
    margin-bottom: 20px;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-my-reports-page .page-heading h1 {
        font-size: 26px;
    }

    .my-reports-card {
        padding: 17px;
    }

    .my-reports-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .my-reports-create-button {
        width: 100%;
    }

    .report-type-switcher {
        width: 100%;
    }

    .report-type-button {
        flex: 1;
    }

    .my-reports-table {
        min-width: 800px;
    }

}

</style>


<div class="student-my-reports-page">

    {{-- PAGE HEADER --}}

    <div class="page-heading">

        <div class="page-label">
            Lost & Found
        </div>

        <h1>
            My Reports
        </h1>

        <p>
            View the lost and found items you have reported.
        </p>

    </div>


    {{-- MAIN CARD --}}

    <div class="my-reports-card">

        {{-- REPORT TYPE BUTTONS --}}

        <div class="report-type-switcher">

            <button
                type="button"
                class="report-type-button active"
                id="lostBtn"
                onclick="showReports('lost')"
            >

                <i class="bi bi-search"></i>

                Lost

            </button>


            <button
                type="button"
                class="report-type-button"
                id="foundBtn"
                onclick="showReports('found')"
            >

                <i class="bi bi-box-seam"></i>

                Found

            </button>

        </div>


        {{-- LOST REPORTS --}}

        <div id="lostReports">

            <div class="my-reports-section-header">

                <div class="my-reports-section-heading">

                    <div class="my-reports-section-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>

                        <h5 class="my-reports-section-title">
                            My Lost Item Reports
                        </h5>

                        <p class="my-reports-section-text">
                            Here are the items you reported as lost.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ url('/student/report-lost') }}"
                    class="my-reports-create-button"
                >

                    <i class="bi bi-plus-circle"></i>

                    Report Lost Item

                </a>

            </div>


            @if($lostItems->count() > 0)

                <div class="my-reports-table-wrapper">

                    <table class="table align-middle my-reports-table">

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
                                    Date Lost
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

                            @foreach($lostItems as $item)

                                <tr>

                                    <td>

                                        <div class="my-report-item">

                                            <div class="my-report-item-icon">
                                                <i class="bi bi-search"></i>
                                            </div>

                                            <div class="my-report-item-name">
                                                {{ $item->item_name }}
                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        @if($item->category)

                                            {{ $item->category->name }}

                                        @elseif($item->custom_category)

                                            {{ $item->custom_category }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        @if($item->location)

                                            {{ $item->location->name }}

                                        @elseif($item->custom_location)

                                            {{ $item->custom_location }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $item->lost_date
                                        )->format('M d, Y') }}

                                    </td>


                                    <td>

                                        @if($item->status === 'reported')

                                            <span class="my-report-status status-reported">
                                                Reported
                                            </span>

                                        @elseif($item->status === 'claimed')

                                            <span class="my-report-status status-claimed">
                                                Claimed
                                            </span>

                                        @elseif($item->status === 'resolved')

                                            <span class="my-report-status status-resolved">
                                                Resolved
                                            </span>

                                        @else

                                            <span class="my-report-status status-default">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route(
                                                'student.report-details',
                                                $item->id
                                            ) }}"
                                            class="my-report-view-button"
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

                <div class="my-reports-empty">

                    <div class="my-reports-empty-icon">

                        <i class="bi bi-file-earmark-x"></i>

                    </div>

                    <h5>
                        No Lost Reports Yet
                    </h5>

                    <p>
                        You haven't reported any lost items yet.
                    </p>

                    <a
                        href="{{ url('/student/report-lost') }}"
                        class="my-reports-create-button"
                    >

                        <i class="bi bi-plus-circle"></i>

                        Report Lost Item

                    </a>

                </div>

            @endif

        </div>


        {{-- FOUND REPORTS --}}

        <div id="foundReports" style="display: none;">

            <div class="my-reports-section-header">

                <div class="my-reports-section-heading">

                    <div class="my-reports-section-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>

                        <h5 class="my-reports-section-title">
                            My Found Item Reports
                        </h5>

                        <p class="my-reports-section-text">
                            Here are the items you reported as found.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ url('/student/report-found') }}"
                    class="my-reports-create-button"
                >

                    <i class="bi bi-plus-circle"></i>

                    Report Found Item

                </a>

            </div>


            @if($foundItems->count() > 0)

                <div class="my-reports-table-wrapper">

                    <table class="table align-middle my-reports-table">

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

                                    <td>

                                        <div class="my-report-item">

                                            <div class="my-report-item-icon">
                                                <i class="bi bi-box-seam"></i>
                                            </div>

                                            <div class="my-report-item-name">
                                                {{ $item->item_name }}
                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        @if($item->category)

                                            {{ $item->category->name }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        @if($item->location)

                                            {{ $item->location->name }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $item->found_date
                                        )->format('M d, Y') }}

                                    </td>


                                    <td>

                                        @if($item->status === 'awaiting_surrender')

                                            <span class="my-report-status status-awaiting">
                                                Awaiting Surrender
                                            </span>

                                        @elseif($item->status === 'received')

                                            <span class="my-report-status status-received">
                                                Received
                                            </span>

                                        @elseif($item->status === 'approved')

                                            <span class="my-report-status status-approved">
                                                Approved
                                            </span>

                                        @elseif($item->status === 'claimed')

                                            <span class="my-report-status status-claimed">
                                                Claimed
                                            </span>

                                        @elseif($item->status === 'rejected')

                                            <span class="my-report-status status-rejected">
                                                Rejected
                                            </span>

                                        @else

                                            <span class="my-report-status status-default">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route(
                                                'student.found-report-details',
                                                $item->id
                                            ) }}"
                                            class="my-report-view-button"
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

                <div class="my-reports-empty">

                    <div class="my-reports-empty-icon">

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <h5>
                        No Found Reports Yet
                    </h5>

                    <p>
                        You haven't reported any found items yet.
                    </p>

                    <a
                        href="{{ url('/student/report-found') }}"
                        class="my-reports-create-button"
                    >

                        <i class="bi bi-plus-circle"></i>

                        Report Found Item

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>


<script>

function showReports(type)
{
    const lostReports = document.getElementById('lostReports');
    const foundReports = document.getElementById('foundReports');

    const lostBtn = document.getElementById('lostBtn');
    const foundBtn = document.getElementById('foundBtn');

    if (type === 'lost') {

        lostReports.style.display = 'block';
        foundReports.style.display = 'none';

        lostBtn.classList.add('active');
        foundBtn.classList.remove('active');

    } else {

        lostReports.style.display = 'none';
        foundReports.style.display = 'block';

        foundBtn.classList.add('active');
        lostBtn.classList.remove('active');

    }
}

</script>

@endsection