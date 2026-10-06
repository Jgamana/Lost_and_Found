@extends('layouts.app')

@section('title', 'Manage Found Items')
@section('page-title', 'Manage Found Items')

@section('content')

<style>

.admin-found-page {
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

.admin-count-badge {
    background: #eef5f3;
    color: var(--admin-teal);
    border: 1px solid #dce9e6;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
}

.admin-print-button {
    border: none;
    border-radius: 11px;
    padding: 11px 16px;
    background: var(--admin-teal);
    color: white;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-print-button:hover {
    background: var(--admin-teal-dark);
    color: white;
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

.admin-search-wrapper {
    margin-bottom: 20px;
}

.admin-search-wrapper .input-group {
    border: 1px solid var(--admin-border);
    border-radius: 12px;
    overflow: hidden;
    background: white;
}

.admin-search-wrapper .input-group-text {
    border: none;
    color: var(--admin-muted);
    padding-left: 15px;
    padding-right: 7px;
}

.admin-search-wrapper .form-control {
    border: none;
    box-shadow: none;
    font-size: 13px;
    padding: 12px 14px 12px 7px;
    color: var(--admin-text);
}

.admin-search-wrapper .form-control:focus {
    box-shadow: none;
}

.admin-report-count {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 14px;
}

.admin-table {
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
    padding: 15px;
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
    gap: 12px;
}

.admin-item-image {
    width: 52px;
    height: 52px;
    border-radius: 11px;
    object-fit: cover;
    background: #f1f5f4;
    border: 1px solid #e6eeec;
    flex-shrink: 0;
}

.admin-no-image {
    width: 52px;
    height: 52px;
    border-radius: 11px;
    background: #f1f5f4;
    color: #a1b0ae;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
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
    padding: 7px 11px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
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
    background: #e5f1f5;
    color: #39778a;
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

.admin-action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    flex-wrap: wrap;
}

.admin-action-button {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: white;
    font-size: 14px;
    transition: 0.2s ease;
}

.admin-view-button {
    border: 1px solid #cbdedb;
    color: var(--admin-teal);
}

.admin-view-button:hover {
    background: var(--admin-teal);
    color: white;
    border-color: var(--admin-teal);
}

.admin-receive-button {
    border: 1px solid #c9e1e7;
    color: #39778a;
}

.admin-receive-button:hover {
    background: #39778a;
    color: white;
    border-color: #39778a;
}

.admin-approve-button {
    border: 1px solid #cfe4d5;
    color: #43835a;
}

.admin-approve-button:hover {
    background: #43835a;
    color: white;
    border-color: #43835a;
}

.admin-reject-button,
.admin-delete-button {
    border: 1px solid #e6cccc;
    color: #bd5555;
}

.admin-reject-button:hover,
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

.print-header {
    display: none;
}

.print-footer {
    display: none;
}

@media (max-width: 992px) {

    .table-responsive {
        overflow-x: auto;
    }

    .admin-table {
        min-width: 950px;
    }

}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-actions {
        width: 100%;
        justify-content: space-between;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-table-body {
        padding: 16px;
    }

    .admin-table thead th {
        font-size: 11px;
    }

    .admin-table tbody td {
        font-size: 12px;
        padding: 12px;
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
    }

    .no-print {
        display: none !important;
    }

    .print-header {
        display: block;
        text-align: center;
        margin-bottom: 25px;
    }

    .print-header h1 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .print-header h2 {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .print-header h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .print-header p {
        font-size: 11px;
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

    .admin-search-wrapper,
    .admin-report-count {
        display: none !important;
    }

    .table-responsive {
        overflow: visible !important;
    }

    .admin-table {
        width: 100% !important;
        min-width: 0 !important;
        border-collapse: collapse !important;
        font-size: 11px;
    }

    .admin-table thead th,
    .admin-table tbody td {
        border: 1px solid #000 !important;
        padding: 8px !important;
    }

    .admin-table thead th {
        background: #f2f2f2 !important;
        color: #000 !important;
        font-weight: 700;
    }

    .admin-table tbody td {
        color: #000 !important;
    }

    .admin-item-wrapper {
        gap: 0 !important;
    }

    .admin-item-image,
    .admin-no-image {
        display: none !important;
    }

    .admin-primary-text,
    .admin-secondary-text {
        color: #000 !important;
    }

    .admin-status {
        background: none !important;
        color: #000 !important;
        padding: 0 !important;
        font-weight: 600;
    }

    .admin-action-group {
        display: none !important;
    }

    .print-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #000;
        font-size: 11px;
    }

}

</style>


<div class="admin-found-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-box-seam me-1"></i>
                Found Item Management
            </div>

            <h1 class="admin-page-title">
                Manage Found Items
            </h1>

            <p class="admin-page-description">
                View, receive, verify, and manage found item reports.
            </p>

        </div>


        <div class="admin-page-actions no-print">

            <span class="admin-count-badge">

                <i class="bi bi-box-seam me-1"></i>

                {{ $foundItems->count() }}

                {{ $foundItems->count() === 1 ? 'Item' : 'Items' }}

            </span>


            <button
                type="button"
                class="admin-print-button"
                onclick="window.print()"
            >

                <i class="bi bi-printer me-1"></i>

                Print Found Items

            </button>

        </div>

    </div>


    <div
        class="admin-table-card"
        id="printArea"
    >

        <div class="admin-table-body">


            <div class="print-header">

                <h1>
                    MLG COLLEGE OF LEARNING, INC.
                </h1>

                <h2>
                    Web-Based Lost and Found Management System
                </h2>

                <h3>
                    FOUND ITEMS REPORT
                </h3>

                <p>
                    Generated on:
                    {{ now()->format('F d, Y h:i A') }}
                </p>

            </div>


            <div class="admin-search-wrapper no-print">

                <div class="input-group">

                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        id="foundItemSearch"
                        class="form-control"
                        placeholder="Search found items..."
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="admin-report-count no-print">

                {{ $foundItems->count() }}

                {{ $foundItems->count() === 1 ? 'found item report' : 'found item reports' }}

            </div>


            <div class="table-responsive">

                <table
                    class="table admin-table align-middle"
                    id="foundItemsTable"
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
                                Found Date
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

                        @forelse($foundItems as $item)

                            <tr>

                                <td>

                                    <div class="admin-item-wrapper">

                                        @if($item->image)

                                            <img
                                                src="{{ asset('storage/' . $item->image) }}"
                                                alt="{{ $item->item_name }}"
                                                class="admin-item-image no-print"
                                            >

                                        @else

                                            <div class="admin-no-image no-print">

                                                <i class="bi bi-image"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <div class="admin-primary-text">
                                                {{ $item->item_name }}
                                            </div>

                                            <div class="admin-secondary-text">
                                                #{{ $item->id }}
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
                                        {{ $item->category->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="admin-primary-text">
                                        {{ $item->location->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="admin-primary-text">

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
                                            Available
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


                                <td class="no-print">

                                    <div class="admin-action-group">


                                        <a
                                            href="{{ route('admin.found-item-details', $item->id) }}"
                                            class="admin-action-button admin-view-button"
                                            title="View Details"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        @if($item->status === 'awaiting_surrender')

                                            <form
                                                action="{{ route('admin.found-item-receive', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Confirm that you have physically received this found item?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="admin-action-button admin-receive-button"
                                                    title="Receive Item"
                                                >

                                                    <i class="bi bi-box-arrow-in-down"></i>

                                                </button>

                                            </form>

                                        @endif


                                        @if($item->status === 'received')

                                            <form
                                                action="{{ route('admin.found-item-approve', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Approve this found item and make it available for claims?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="admin-action-button admin-approve-button"
                                                    title="Approve Item"
                                                >

                                                    <i class="bi bi-check-circle"></i>

                                                </button>

                                            </form>


                                            <form
                                                action="{{ route('admin.found-item-reject', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Reject this found item?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="admin-action-button admin-reject-button"
                                                    title="Reject Item"
                                                >

                                                    <i class="bi bi-x-circle"></i>

                                                </button>

                                            </form>

                                        @endif


                                        <form
                                            action="{{ route('admin.found-item-delete', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this found item report?');"
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

                                        <i class="bi bi-inbox"></i>

                                    </div>

                                    <div class="admin-empty-title">
                                        No Found Item Reports
                                    </div>

                                    <p class="admin-empty-text">
                                        There are currently no found item reports available.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="print-footer">

                <div>

                    <strong>
                        Total Found Item Reports:
                    </strong>

                    {{ $foundItems->count() }}

                </div>


                <div>

                    <strong>
                        Report Generated By:
                    </strong>

                    {{ auth()->user()->name }}

                </div>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('foundItemSearch');
    const table = document.getElementById('foundItemsTable');

    if (!searchInput || !table) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const search = this.value.toLowerCase().trim();

        table.querySelectorAll('tbody tr').forEach(function (row) {

            const text = row.innerText.toLowerCase();

            row.style.display =
                text.includes(search)
                    ? ''
                    : 'none';

        });

    });

});

</script>

@endsection