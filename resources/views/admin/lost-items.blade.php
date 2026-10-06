@extends('layouts.app')

@section('title', 'Manage Lost Items')
@section('page-title', 'Manage Lost Items')

@section('content')

<style>

.admin-lost-page {
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

.admin-page-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.admin-print-button {
    border: none;
    background: var(--admin-teal);
    color: white;
    border-radius: 11px;
    padding: 10px 15px;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-print-button:hover {
    background: var(--admin-teal-dark);
    color: white;
}

.admin-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #eef5f3;
    color: var(--admin-teal);
    border: 1px solid #dce9e6;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
}

.admin-alert {
    border: 1px solid #cfe7d6;
    background: #edf8f0;
    color: #3f7950;
    border-radius: 12px;
    font-size: 13px;
}

.admin-table-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-table-body {
    padding: 22px;
}

.admin-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}

.admin-section-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.admin-section-icon {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}

.admin-section-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-section-description {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.admin-search-wrapper {
    width: 280px;
    max-width: 100%;
}

.admin-search-wrapper .input-group-text {
    background: white;
    border-color: var(--admin-border);
    color: var(--admin-muted);
}

.admin-search-wrapper .form-control {
    border-color: var(--admin-border);
    color: var(--admin-text);
    font-size: 12px;
}

.admin-search-wrapper .form-control:focus {
    border-color: #aac6c2;
    box-shadow: 0 0 0 0.15rem rgba(54, 92, 90, 0.08);
}

.admin-report-count {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 15px;
}

.admin-table-wrapper {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    margin-bottom: 0;
}

.admin-table thead th {
    background: #f4f8f7;
    color: var(--admin-text);
    border-bottom: 1px solid var(--admin-border);
    font-size: 12px;
    font-weight: 700;
    padding: 14px 15px;
    white-space: nowrap;
}

.admin-table tbody td {
    color: var(--admin-text);
    border-bottom: 1px solid #edf2f1;
    font-size: 13px;
    padding: 14px 15px;
    vertical-align: middle;
}

.admin-table tbody tr:last-child td {
    border-bottom: none;
}

.admin-table tbody tr:hover {
    background: #fafcfc;
}

.admin-item-wrapper {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 180px;
}

.admin-item-image,
.admin-no-image {
    width: 46px;
    height: 46px;
    border-radius: 11px;
    flex-shrink: 0;
}

.admin-item-image {
    object-fit: cover;
    border: 1px solid #e5eceb;
}

.admin-no-image {
    background: #f1f5f4;
    color: #9aabaa;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.admin-primary-text {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
}

.admin-secondary-text {
    color: var(--admin-muted);
    font-size: 11px;
    margin-top: 3px;
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

.admin-status-default {
    background: #eef2f1;
    color: #64716f;
}

.admin-action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
}

.admin-action-button {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    transition: 0.2s ease;
}

.admin-view-button {
    color: var(--admin-teal);
    background: #eef5f3;
    border: 1px solid #dce9e6;
}

.admin-view-button:hover {
    background: var(--admin-teal);
    color: white;
    border-color: var(--admin-teal);
}

.admin-delete-button {
    color: #bd5555;
    background: #fff0f0;
    border: 1px solid #f3dcdc;
}

.admin-delete-button:hover {
    background: #bd5555;
    color: white;
    border-color: #bd5555;
}

.admin-empty-state {
    text-align: center;
    padding: 60px 20px !important;
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
    margin-bottom: 0;
}

.admin-print-header,
.admin-print-footer {
    display: none;
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-page-actions {
        width: 100%;
    }

    .admin-count-badge,
    .admin-print-button {
        flex: 1;
        justify-content: center;
        text-align: center;
    }

    .admin-table-body {
        padding: 16px;
    }

    .admin-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-search-wrapper {
        width: 100%;
    }

    .admin-table {
        min-width: 950px;
    }

}

@media print {

    @page {
        size: A4 landscape;
        margin: 15mm;
    }

    body {
        background: white !important;
    }

    body * {
        visibility: hidden;
    }

    #printArea,
    #printArea * {
        visibility: visible;
    }

    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
        background: white !important;
        border: none !important;
        box-shadow: none !important;
    }

    .no-print {
        display: none !important;
    }

    .admin-print-header {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }

    .admin-print-header h4 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .admin-print-header h5 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .admin-print-header h6 {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .admin-print-header p {
        font-size: 10px;
        margin-bottom: 0;
    }

    .admin-table-card {
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    .admin-table-body {
        padding: 0 !important;
    }

    .admin-table-wrapper {
        overflow: visible !important;
    }

    .admin-table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .admin-table thead th {
        background: white !important;
        color: #000 !important;
        border: 1px solid #000 !important;
        padding: 8px !important;
        font-size: 10px !important;
    }

    .admin-table tbody td {
        color: #000 !important;
        border: 1px solid #000 !important;
        padding: 8px !important;
        font-size: 10px !important;
    }

    .admin-table tbody tr {
        page-break-inside: avoid;
    }

    .admin-item-image,
    .admin-no-image {
        display: none !important;
    }

    .admin-primary-text,
    .admin-secondary-text,
    .admin-report-count {
        color: #000 !important;
    }

    .admin-status {
        background: transparent !important;
        color: #000 !important;
        border: none !important;
        padding: 0 !important;
        font-size: 10px !important;
        font-weight: normal !important;
    }

    .admin-print-footer {
        display: block !important;
        margin-top: 15px;
        color: #000 !important;
        font-size: 10px;
    }

}

</style>


<div class="admin-lost-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-search me-1"></i>
                Lost Item Management
            </div>

            <h1 class="admin-page-title">
                Manage Lost Items
            </h1>

            <p class="admin-page-description">
                View and manage all lost item reports submitted by students and faculty.
            </p>

        </div>


        <div class="admin-page-actions no-print">

            <div class="admin-count-badge">
                <i class="bi bi-file-earmark-text"></i>
                {{ $lostItems->count() }}
                {{ $lostItems->count() === 1 ? 'Report' : 'Reports' }}
            </div>

            <button
                type="button"
                class="admin-print-button"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Lost Items
            </button>

        </div>

    </div>


    @if (session('success'))

        <div
            class="alert admin-alert alert-dismissible fade show no-print mb-4"
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


    <div class="admin-table-card" id="printArea">

        <div class="admin-print-header">

            <h4>
                MLG COLLEGE OF LEARNING, INC.
            </h4>

            <h5>
                Web-Based Lost and Found Management System
            </h5>

            <h6>
                LOST ITEMS REPORT
            </h6>

            <p>
                Generated on: {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="admin-table-body">

            <div class="admin-section-header no-print">

                <div class="admin-section-info">

                    <div class="admin-section-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>

                        <h5 class="admin-section-title">
                            Lost Item Reports
                        </h5>

                        <p class="admin-section-description">
                            Review and manage submitted lost item reports.
                        </p>

                    </div>

                </div>


                <div class="admin-search-wrapper">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            id="lostItemSearch"
                            class="form-control"
                            placeholder="Search lost items..."
                            autocomplete="off"
                        >

                    </div>

                </div>

            </div>


            <div class="admin-report-count d-print-none">
                {{ $lostItems->count() }}
                {{ $lostItems->count() === 1 ? 'lost item report' : 'lost item reports' }}
            </div>


            <div class="admin-table-wrapper">

                <table
                    class="table admin-table align-middle"
                    id="lostItemsTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Item
                            </th>

                            <th>
                                Reported By
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Location
                            </th>

                            <th>
                                Lost Date
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center no-print">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($lostItems as $item)

                            <tr>

                                <td>

                                    <div class="admin-item-wrapper">

                                        @if ($item->image)

                                            <img
                                                src="{{ asset('storage/' . $item->image) }}"
                                                alt="{{ $item->item_name }}"
                                                class="admin-item-image"
                                            >

                                        @else

                                            <div class="admin-no-image">
                                                <i class="bi bi-image"></i>
                                            </div>

                                        @endif


                                        <div>

                                            <div class="admin-primary-text">
                                                {{ $item->item_name }}
                                            </div>

                                            <div class="admin-secondary-text">
                                                Report #{{ $item->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <div class="admin-primary-text">
                                        {{ $item->user->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="admin-primary-text">
                                        {{ $item->custom_category ?? $item->category->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="admin-primary-text">
                                        {{ $item->custom_location ?? $item->location->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="admin-primary-text">
                                        {{ \Carbon\Carbon::parse($item->lost_date)->format('F d, Y') }}
                                    </div>

                                </td>


                                <td>

                                    @if ($item->status === 'reported')

                                        <span class="admin-status admin-status-reported">
                                            Reported
                                        </span>

                                    @elseif ($item->status === 'resolved')

                                        <span class="admin-status admin-status-resolved">
                                            Resolved
                                        </span>

                                    @elseif ($item->status === 'claimed')

                                        <span class="admin-status admin-status-claimed">
                                            Claimed
                                        </span>

                                    @else

                                        <span class="admin-status admin-status-default">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>

                                    @endif

                                </td>


                                <td class="text-center no-print">

                                    <div class="admin-action-group">

                                        <a
                                            href="{{ route('admin.lost-item-details', $item->id) }}"
                                            class="admin-action-button admin-view-button"
                                            title="View details"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        <form
                                            action="{{ route('admin.lost-item-delete', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this lost item report?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="admin-action-button admin-delete-button"
                                                title="Delete"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="admin-empty-state"
                                >

                                    <div class="admin-empty-icon">
                                        <i class="bi bi-search"></i>
                                    </div>

                                    <div class="admin-empty-title">
                                        No Lost Item Reports Found
                                    </div>

                                    <p class="admin-empty-text">
                                        There are currently no lost item reports in the system.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="admin-print-footer">

                <p class="mb-1">
                    Total Lost Item Reports: {{ $lostItems->count() }}
                </p>

                <p class="mb-0">
                    Report generated by: {{ auth()->user()->name }}
                </p>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('lostItemSearch');
    const table = document.getElementById('lostItemsTable');

    if (!searchInput || !table) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const search = this.value.toLowerCase().trim();

        table.querySelectorAll('tbody tr').forEach(function (row) {

            const text = row.innerText.toLowerCase();

            row.style.display =
                text.includes(search) ? '' : 'none';

        });

    });

});

</script>

@endsection