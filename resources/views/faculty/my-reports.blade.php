@extends('layouts.app')

@section('title', 'My Reports')
@section('page-title', 'My Reports')

@section('content')

<style>

.faculty-reports-page {
    --teal: #365c5a;
    --teal-dark: #294947;
    --gold: #d6a51d;
    --border: #e4eceb;
    --text: #263b3a;
    --muted: #7b8d8b;
}

.faculty-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.faculty-page-label {
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.faculty-page-title {
    color: var(--text);
    font-size: 30px;
    font-weight: 700;
    margin: 0 0 6px;
}

.faculty-page-description {
    color: var(--muted);
    font-size: 14px;
    margin: 0;
}

.faculty-reports-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.faculty-report-switcher {
    display: flex;
    gap: 8px;
    padding: 20px 22px;
    border-bottom: 1px solid var(--border);
    background: #ffffff;
}

.faculty-switch-button {
    border: 1px solid #cbdedb;
    background: #ffffff;
    color: var(--teal);
    border-radius: 10px;
    padding: 9px 16px;
    font-size: 12px;
    font-weight: 700;
    transition: 0.2s ease;
}

.faculty-switch-button:hover {
    background: #eef5f3;
    color: var(--teal-dark);
}

.faculty-switch-button.active {
    background: var(--teal);
    border-color: var(--teal);
    color: #ffffff;
}

.faculty-report-section {
    padding: 24px 22px;
}

.faculty-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}

.faculty-section-heading {
    display: flex;
    align-items: center;
    gap: 12px;
}

.faculty-section-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.faculty-section-title {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    margin: 0 0 4px;
}

.faculty-section-description {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

.faculty-report-button {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    background: var(--teal);
    color: #ffffff;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
    white-space: nowrap;
}

.faculty-report-button:hover {
    background: var(--teal-dark);
    color: #ffffff;
}

.faculty-table-wrapper {
    overflow-x: auto;
    border: 1px solid var(--border);
    border-radius: 15px;
}

.faculty-table {
    width: 100%;
    min-width: 850px;
    margin: 0;
    border-collapse: collapse;
}

.faculty-table thead th {
    background: #f4f8f7;
    color: var(--text);
    border-bottom: 1px solid var(--border);
    padding: 13px 14px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-table tbody td {
    color: var(--text);
    border-bottom: 1px solid #edf2f1;
    padding: 14px;
    font-size: 12px;
    vertical-align: middle;
}

.faculty-table tbody tr:last-child td {
    border-bottom: none;
}

.faculty-table tbody tr:hover {
    background: #fafcfc;
}

.faculty-item-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
}

.faculty-item-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.faculty-item-name {
    color: var(--text);
    font-size: 12px;
    font-weight: 700;
}

.faculty-report-number {
    color: var(--muted);
    font-size: 10px;
    margin-top: 2px;
}

.faculty-primary-text {
    color: var(--text);
    font-size: 12px;
    font-weight: 600;
}

.faculty-date {
    color: var(--text);
    font-size: 11px;
    white-space: nowrap;
}

.faculty-status {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-status-reported {
    background: #fbf2d7;
    color: #967414;
}

.faculty-status-resolved {
    background: #e5f3ea;
    color: #43835a;
}

.faculty-status-claimed {
    background: #e8eef8;
    color: #42628f;
}

.faculty-status-awaiting {
    background: #fbf2d7;
    color: #967414;
}

.faculty-status-received {
    background: #dff3f8;
    color: #267080;
}

.faculty-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.faculty-status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.faculty-status-default {
    background: #eef2f1;
    color: #64716f;
}

.faculty-view-button {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border: 1px solid #cbdedb;
    background: #eef5f3;
    color: var(--teal);
    border-radius: 9px;
    padding: 7px 10px;
    font-size: 10px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.2s ease;
    white-space: nowrap;
}

.faculty-view-button:hover {
    background: var(--teal);
    border-color: var(--teal);
    color: #ffffff;
}

.faculty-empty-state {
    text-align: center;
    padding: 55px 20px;
    border: 1px solid var(--border);
    border-radius: 15px;
    background: #ffffff;
}

.faculty-empty-icon {
    width: 62px;
    height: 62px;
    margin: 0 auto 15px;
    border-radius: 17px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 27px;
}

.faculty-empty-title {
    color: var(--text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 6px;
}

.faculty-empty-text {
    color: var(--muted);
    font-size: 12px;
    margin-bottom: 18px;
}

@media (max-width: 768px) {

    .faculty-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .faculty-page-title {
        font-size: 26px;
    }

    .faculty-report-switcher {
        padding: 15px;
    }

    .faculty-switch-button {
        flex: 1;
    }

    .faculty-report-section {
        padding: 18px 15px;
    }

    .faculty-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .faculty-report-button {
        width: 100%;
        justify-content: center;
    }

    .faculty-table {
        min-width: 850px;
    }

}

</style>


<div class="faculty-reports-page">

    <div class="faculty-page-header">

        <div>

            <div class="faculty-page-label">
                <i class="bi bi-file-earmark-text me-1"></i>
                Lost & Found
            </div>

            <h1 class="faculty-page-title">
                My Reports
            </h1>

            <p class="faculty-page-description">
                View the lost and found items you have reported.
            </p>

        </div>

    </div>


    <div class="faculty-reports-card">

        <div class="faculty-report-switcher">

            <button
                type="button"
                class="faculty-switch-button active"
                id="lostBtn"
                onclick="showReports('lost')"
            >
                <i class="bi bi-search me-1"></i>
                Lost
            </button>

            <button
                type="button"
                class="faculty-switch-button"
                id="foundBtn"
                onclick="showReports('found')"
            >
                <i class="bi bi-box-seam me-1"></i>
                Found
            </button>

        </div>


        <div id="lostReports" class="faculty-report-section">

            <div class="faculty-section-header">

                <div class="faculty-section-heading">

                    <div class="faculty-section-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>

                        <h5 class="faculty-section-title">
                            My Lost Item Reports
                        </h5>

                        <p class="faculty-section-description">
                            Here are the items you reported as lost.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('faculty.report-lost') }}"
                    class="faculty-report-button"
                >
                    <i class="bi bi-plus-circle"></i>
                    Report Lost Item
                </a>

            </div>


            @if($lostItems->count() > 0)

                <div class="faculty-table-wrapper">

                    <table class="faculty-table">

                        <thead>

                            <tr>

                                <th>Item</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Date Lost</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($lostItems as $item)

                                <tr>

                                    <td>

                                        <div class="faculty-item-wrapper">

                                            <div class="faculty-item-icon">
                                                <i class="bi bi-search"></i>
                                            </div>

                                            <div>

                                                <div class="faculty-item-name">
                                                    {{ $item->item_name }}
                                                </div>

                                                <div class="faculty-report-number">
                                                    Report #{{ $item->id }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <span class="faculty-primary-text">

                                            @if($item->category)

                                                {{ $item->category->name }}

                                            @elseif($item->custom_category)

                                                {{ $item->custom_category }}

                                            @else

                                                —

                                            @endif

                                        </span>

                                    </td>


                                    <td>

                                        <span class="faculty-primary-text">

                                            @if($item->location)

                                                {{ $item->location->name }}

                                            @elseif($item->custom_location)

                                                {{ $item->custom_location }}

                                            @else

                                                —

                                            @endif

                                        </span>

                                    </td>


                                    <td>

                                        <span class="faculty-date">

                                            {{ \Carbon\Carbon::parse(
                                                $item->lost_date
                                            )->format('M d, Y') }}

                                        </span>

                                    </td>


                                    <td>

                                        @if($item->status === 'resolved')

                                            <span class="faculty-status faculty-status-resolved">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Resolved
                                            </span>

                                        @elseif($item->status === 'reported')

                                            <span class="faculty-status faculty-status-reported">
                                                <i class="bi bi-clock me-1"></i>
                                                Reported
                                            </span>

                                        @elseif($item->status === 'claimed')

                                            <span class="faculty-status faculty-status-claimed">
                                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                                Claimed
                                            </span>

                                        @else

                                            <span class="faculty-status faculty-status-default">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('student.report-details', $item->id) }}"
                                            class="faculty-view-button"
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

                <div class="faculty-empty-state">

                    <div class="faculty-empty-icon">
                        <i class="bi bi-file-earmark-x"></i>
                    </div>

                    <h5 class="faculty-empty-title">
                        No Lost Reports Yet
                    </h5>

                    <p class="faculty-empty-text">
                        You haven't reported any lost items yet.
                    </p>

                    <a
                        href="{{ route('faculty.report-lost') }}"
                        class="faculty-report-button"
                    >
                        <i class="bi bi-plus-circle"></i>
                        Report Lost Item
                    </a>

                </div>

            @endif

        </div>


        <div
            id="foundReports"
            class="faculty-report-section"
            style="display: none;"
        >

            <div class="faculty-section-header">

                <div class="faculty-section-heading">

                    <div class="faculty-section-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>

                        <h5 class="faculty-section-title">
                            My Found Item Reports
                        </h5>

                        <p class="faculty-section-description">
                            Here are the items you reported as found.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('faculty.report-found') }}"
                    class="faculty-report-button"
                >
                    <i class="bi bi-plus-circle"></i>
                    Report Found Item
                </a>

            </div>


            @if($foundItems->count() > 0)

                <div class="faculty-table-wrapper">

                    <table class="faculty-table">

                        <thead>

                            <tr>

                                <th>Item</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Date Found</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($foundItems as $item)

                                <tr>

                                    <td>

                                        <div class="faculty-item-wrapper">

                                            <div class="faculty-item-icon">
                                                <i class="bi bi-box-seam"></i>
                                            </div>

                                            <div>

                                                <div class="faculty-item-name">
                                                    {{ $item->item_name }}
                                                </div>

                                                <div class="faculty-report-number">
                                                    Report #{{ $item->id }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <span class="faculty-primary-text">
                                            {{ $item->category->name ?? '—' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="faculty-primary-text">
                                            {{ $item->location->name ?? '—' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="faculty-date">

                                            {{ \Carbon\Carbon::parse(
                                                $item->found_date
                                            )->format('M d, Y') }}

                                        </span>

                                    </td>


                                    <td>

                                        @if($item->status === 'awaiting_surrender')

                                            <span class="faculty-status faculty-status-awaiting">
                                                <i class="bi bi-hourglass-split me-1"></i>
                                                Awaiting Surrender
                                            </span>

                                        @elseif($item->status === 'received')

                                            <span class="faculty-status faculty-status-received">
                                                <i class="bi bi-box-arrow-in-down me-1"></i>
                                                Received
                                            </span>

                                        @elseif($item->status === 'approved')

                                            <span class="faculty-status faculty-status-approved">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Approved
                                            </span>

                                        @elseif($item->status === 'rejected')

                                            <span class="faculty-status faculty-status-rejected">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Rejected
                                            </span>

                                        @elseif($item->status === 'claimed')

                                            <span class="faculty-status faculty-status-claimed">
                                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                                Claimed
                                            </span>

                                        @else

                                            <span class="faculty-status faculty-status-default">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('student.found-report-details', $item->id) }}"
                                            class="faculty-view-button"
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

                <div class="faculty-empty-state">

                    <div class="faculty-empty-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <h5 class="faculty-empty-title">
                        No Found Reports Yet
                    </h5>

                    <p class="faculty-empty-text">
                        You haven't reported any found items yet.
                    </p>

                    <a
                        href="{{ route('faculty.report-found') }}"
                        class="faculty-report-button"
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

function showReports(type) {

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