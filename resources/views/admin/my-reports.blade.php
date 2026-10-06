@extends('layouts.app')

@section('title', 'My Reports')
@section('page-title', 'My Reports')

@section('content')

<style>

.admin-my-reports-page {
    --admin-teal: #365c5a;
    --admin-teal-dark: #294947;
    --admin-gold: #d6a51d;
    --admin-border: #e4eceb;
    --admin-text: #263b3a;
    --admin-muted: #7b8d8b;
}

.admin-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.admin-page-label {
    color: var(--admin-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.admin-page-title {
    color: var(--admin-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.admin-page-description {
    color: var(--admin-muted);
    font-size: 14px;
    margin-bottom: 0;
}

.admin-alert {
    border-radius: 12px;
    font-size: 13px;
    border-width: 1px;
}

.admin-success-alert {
    background: #edf8f0;
    border-color: #cfe7d6;
    color: #3f7950;
}

.admin-error-alert {
    background: #fff0f0;
    border-color: #f0d1d1;
    color: #a94d4d;
}

.admin-report-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-report-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 22px;
    border-bottom: 1px solid var(--admin-border);
}

.admin-report-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.admin-report-icon {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 19px;
}

.admin-report-icon-lost {
    background: #eef5f3;
    color: var(--admin-teal);
}

.admin-report-icon-found {
    background: #f8f1dc;
    color: #a47c0e;
}

.admin-report-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-report-description {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.admin-report-count {
    min-width: 34px;
    height: 34px;
    padding: 0 10px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.admin-report-count-lost {
    background: #e7f0ee;
    color: var(--admin-teal);
}

.admin-report-count-found {
    background: #fbf2d7;
    color: #967414;
}

.admin-table-wrapper {
    overflow-x: auto;
}

.admin-report-table {
    width: 100%;
    margin-bottom: 0;
}

.admin-report-table thead th {
    background: #f4f8f7;
    color: var(--admin-text);
    border-bottom: 1px solid var(--admin-border);
    font-size: 12px;
    font-weight: 700;
    padding: 14px 18px;
    white-space: nowrap;
}

.admin-report-table tbody td {
    color: var(--admin-text);
    border-bottom: 1px solid #edf2f1;
    font-size: 13px;
    padding: 15px 18px;
    vertical-align: middle;
}

.admin-report-table tbody tr:last-child td {
    border-bottom: none;
}

.admin-report-table tbody tr:hover {
    background: #fafcfc;
}

.admin-item-name {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
}

.admin-item-category,
.admin-item-location {
    color: var(--admin-muted);
    font-size: 12px;
}

.admin-date {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 500;
}

.admin-status {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.admin-status-reported {
    background: #fbf2d7;
    color: #967414;
}

.admin-status-resolved {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status-claimed {
    background: #e7effa;
    color: #416fa5;
}

.admin-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status-received {
    background: #e6f3f7;
    color: #34798a;
}

.admin-status-awaiting {
    background: #fbf2d7;
    color: #967414;
}

.admin-status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.admin-status-default {
    background: #eef2f1;
    color: #64716f;
}

.admin-empty-state {
    text-align: center;
    padding: 55px 20px !important;
}

.admin-empty-icon {
    width: 62px;
    height: 62px;
    border-radius: 17px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 27px;
}

.admin-empty-title {
    color: var(--admin-text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 6px;
}

.admin-empty-text {
    color: var(--admin-muted);
    font-size: 13px;
    margin-bottom: 18px;
}

.admin-report-button {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    border-radius: 10px;
    padding: 10px 15px;
    color: white;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.admin-report-button-lost {
    background: var(--admin-teal);
}

.admin-report-button-lost:hover {
    background: var(--admin-teal-dark);
    color: white;
}

.admin-report-button-found {
    background: #a47c0e;
}

.admin-report-button-found:hover {
    background: #88670b;
    color: white;
}

@media (max-width: 768px) {

    .admin-page-title {
        font-size: 26px;
    }

    .admin-report-header {
        align-items: flex-start;
    }

    .admin-report-header-left {
        align-items: flex-start;
    }

    .admin-report-table {
        min-width: 720px;
    }

    .admin-report-table thead th,
    .admin-report-table tbody td {
        padding: 12px 14px;
    }

}

</style>


<div class="admin-my-reports-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-folder2-open me-1"></i>
                Lost & Found
            </div>

            <h1 class="admin-page-title">
                My Reports
            </h1>

            <p class="admin-page-description">
                View the lost and found items you personally reported.
            </p>

        </div>

    </div>


    @if(session('success'))

        <div class="alert admin-alert admin-success-alert alert-dismissible fade show mb-4" role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert admin-alert admin-error-alert alert-dismissible fade show mb-4" role="alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="row g-4">


        <div class="col-12">

            <div class="admin-report-card">

                <div class="admin-report-header">

                    <div class="admin-report-header-left">

                        <div class="admin-report-icon admin-report-icon-lost">
                            <i class="bi bi-search"></i>
                        </div>

                        <div>

                            <h5 class="admin-report-title">
                                My Lost Reports
                            </h5>

                            <p class="admin-report-description">
                                Lost items you have personally reported.
                            </p>

                        </div>

                    </div>


                    <span class="admin-report-count admin-report-count-lost">
                        {{ $lostItems->count() }}
                    </span>

                </div>


                @if($lostItems->count() > 0)

                    <div class="admin-table-wrapper">

                        <table class="table admin-report-table align-middle">

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

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($lostItems as $item)

                                    <tr>

                                        <td>

                                            <div class="admin-item-name">
                                                {{ $item->item_name }}
                                            </div>

                                        </td>


                                        <td>

                                            <div class="admin-item-category">
                                                {{ $item->custom_category ?? $item->category->name ?? 'N/A' }}
                                            </div>

                                        </td>


                                        <td>

                                            <div class="admin-item-location">
                                                {{ $item->custom_location ?? $item->location->name ?? 'N/A' }}
                                            </div>

                                        </td>


                                        <td>

                                            <div class="admin-date">
                                                {{ \Carbon\Carbon::parse($item->lost_date)->format('M d, Y') }}
                                            </div>

                                        </td>


                                        <td>

                                            @if($item->status === 'resolved')

                                                <span class="admin-status admin-status-resolved">
                                                    Resolved
                                                </span>

                                            @elseif($item->status === 'reported')

                                                <span class="admin-status admin-status-reported">
                                                    Reported
                                                </span>

                                            @elseif($item->status === 'claimed')

                                                <span class="admin-status admin-status-claimed">
                                                    Claimed
                                                </span>

                                            @else

                                                <span class="admin-status admin-status-default">
                                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="admin-empty-state">

                        <div class="admin-empty-icon">
                            <i class="bi bi-search"></i>
                        </div>

                        <div class="admin-empty-title">
                            No Lost Reports Yet
                        </div>

                        <p class="admin-empty-text">
                            You have not reported any lost items.
                        </p>

                        <a
                            href="{{ route('admin.report-lost') }}"
                            class="admin-report-button admin-report-button-lost"
                        >
                            <i class="bi bi-plus-circle"></i>
                            Report Lost Item
                        </a>

                    </div>

                @endif

            </div>

        </div>


        <div class="col-12">

            <div class="admin-report-card">

                <div class="admin-report-header">

                    <div class="admin-report-header-left">

                        <div class="admin-report-icon admin-report-icon-found">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <div>

                            <h5 class="admin-report-title">
                                My Found Reports
                            </h5>

                            <p class="admin-report-description">
                                Found items you have personally reported.
                            </p>

                        </div>

                    </div>


                    <span class="admin-report-count admin-report-count-found">
                        {{ $foundItems->count() }}
                    </span>

                </div>


                @if($foundItems->count() > 0)

                    <div class="admin-table-wrapper">

                        <table class="table admin-report-table align-middle">

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

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($foundItems as $item)

                                    <tr>

                                        <td>

                                            <div class="admin-item-name">
                                                {{ $item->item_name }}
                                            </div>

                                        </td>


                                        <td>

                                            <div class="admin-item-category">
                                                {{ $item->custom_category ?? $item->category->name ?? 'N/A' }}
                                            </div>

                                        </td>


                                        <td>

                                            <div class="admin-item-location">
                                                {{ $item->custom_location ?? $item->location->name ?? 'N/A' }}
                                            </div>

                                        </td>


                                        <td>

                                            <div class="admin-date">
                                                {{ \Carbon\Carbon::parse($item->found_date)->format('M d, Y') }}
                                            </div>

                                        </td>


                                        <td>

                                            @if($item->status === 'claimed')

                                                <span class="admin-status admin-status-claimed">
                                                    Claimed
                                                </span>

                                            @elseif($item->status === 'approved')

                                                <span class="admin-status admin-status-approved">
                                                    Approved
                                                </span>

                                            @elseif($item->status === 'received')

                                                <span class="admin-status admin-status-received">
                                                    Received
                                                </span>

                                            @elseif($item->status === 'awaiting_surrender')

                                                <span class="admin-status admin-status-awaiting">
                                                    Awaiting Surrender
                                                </span>

                                            @elseif($item->status === 'rejected')

                                                <span class="admin-status admin-status-rejected">
                                                    Rejected
                                                </span>

                                            @else

                                                <span class="admin-status admin-status-default">
                                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="admin-empty-state">

                        <div class="admin-empty-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <div class="admin-empty-title">
                            No Found Reports Yet
                        </div>

                        <p class="admin-empty-text">
                            You have not reported any found items.
                        </p>

                        <a
                            href="{{ route('admin.report-found') }}"
                            class="admin-report-button admin-report-button-found"
                        >
                            <i class="bi bi-plus-circle"></i>
                            Report Found Item
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection