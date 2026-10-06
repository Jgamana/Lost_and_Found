@extends('layouts.app')

@section('title', 'Manage Claims')
@section('page-title', 'Manage Claims')

@section('content')

<style>

.admin-claims-page {
    --admin-teal: #365c5a;
    --admin-teal-dark: #294947;
    --admin-gold: #d6a51d;
    --admin-border: #e4eceb;
    --admin-text: #263b3a;
    --admin-muted: #7b8d8b;
}

.admin-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.admin-page-label {
    color: var(--admin-gold);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.admin-page-title {
    color: var(--admin-text);
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
}

.admin-page-description {
    color: var(--admin-muted);
    font-size: 13px;
    margin-bottom: 0;
}

.admin-header-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}

.admin-print-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    border: none;
    border-radius: 11px;
    padding: 10px 14px;
    background: var(--admin-teal);
    color: white;
    font-size: 11px;
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
    border-radius: 11px;
    padding: 10px 14px;
    background: #fbf2d7;
    color: #967414;
    font-size: 11px;
    font-weight: 700;
}

.admin-alert {
    border: 0;
    border-radius: 13px;
    font-size: 12px;
}

.admin-table-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 22px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.admin-search-wrapper {
    margin-bottom: 20px;
}

.admin-search {
    border: 1px solid var(--admin-border);
    border-radius: 11px;
    padding: 10px 13px;
    font-size: 12px;
}

.admin-search:focus {
    border-color: var(--admin-teal);
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.08);
}

.admin-search-icon {
    background: white;
    border: 1px solid var(--admin-border);
    border-right: 0;
    border-radius: 11px 0 0 11px;
    color: var(--admin-muted);
}

.admin-table {
    margin-bottom: 0;
}

.admin-table thead th {
    color: var(--admin-muted);
    background: #f7faf9;
    border-bottom: 1px solid var(--admin-border);
    padding: 13px 14px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.admin-table tbody td {
    color: var(--admin-text);
    border-bottom: 1px solid #edf1f0;
    padding: 15px 14px;
    font-size: 12px;
    vertical-align: middle;
}

.admin-table tbody tr:last-child td {
    border-bottom: 0;
}

.admin-table tbody tr {
    transition: 0.15s ease;
}

.admin-table tbody tr:hover {
    background: #fafcfb;
}

.admin-user-name {
    color: var(--admin-text);
    font-size: 12px;
    font-weight: 700;
}

.admin-secondary-text {
    color: var(--admin-muted);
    font-size: 10px;
    margin-top: 2px;
}

.admin-claim-number {
    display: inline-flex;
    align-items: center;
    padding: 4px 7px;
    background: #eef4f3;
    color: var(--admin-teal);
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
}

.admin-status {
    display: inline-flex;
    align-items: center;
    padding: 6px 9px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.admin-status.pending {
    background: #fbf2d7;
    color: #967414;
}

.admin-status.approved {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status.rejected {
    background: #fae8e8;
    color: #b34b4b;
}

.admin-status.default {
    background: #eef2f1;
    color: #64716f;
}

.admin-action-group {
    display: flex;
    justify-content: center;
    gap: 6px;
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

.admin-action-view {
    color: var(--admin-teal);
    border: 1px solid #cbdcda;
    background: #f5f9f8;
}

.admin-action-view:hover {
    background: var(--admin-teal);
    color: white;
}

.admin-action-delete {
    color: #bd5555;
    border: 1px solid #e7cccc;
    background: #fff8f8;
}

.admin-action-delete:hover {
    background: #bd5555;
    color: white;
}

.admin-empty {
    text-align: center;
    padding: 55px 20px !important;
}

.admin-empty-icon {
    width: 58px;
    height: 58px;
    margin: 0 auto 13px;
    border-radius: 17px;
    background: #eef4f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.admin-empty-title {
    color: var(--admin-text);
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-empty-text {
    color: var(--admin-muted);
    font-size: 11px;
    margin-bottom: 0;
}

.print-header,
.print-footer {
    display: none;
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-header-actions {
        width: 100%;
    }

    .admin-print-button,
    .admin-count-badge {
        flex: 1;
        justify-content: center;
    }

    .admin-page-title {
        font-size: 24px;
    }

    .admin-table-card {
        padding: 17px;
        border-radius: 17px;
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
        padding: 0 !important;
    }

    .table-responsive {
        overflow: visible !important;
    }

    .admin-table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 11px;
    }

    .admin-table th,
    .admin-table td {
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

    .admin-status,
    .admin-claim-number {
        background: none !important;
        color: #000 !important;
        padding: 0 !important;
        font-weight: 600;
    }

    .admin-secondary-text {
        color: #000 !important;
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


<div class="admin-claims-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-clipboard-check me-1"></i>
                Claims Management
            </div>

            <h1 class="admin-page-title">
                Manage Claims
            </h1>

            <p class="admin-page-description">
                View and manage all item claims.
            </p>

        </div>


        <div class="admin-header-actions no-print">

            <button
                type="button"
                class="admin-print-button"
                onclick="window.print()"
            >
                <i class="bi bi-printer"></i>
                Print Claims
            </button>

            <span class="admin-count-badge">
                {{ $claims->count() }} Claims
            </span>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show admin-alert no-print">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show admin-alert no-print">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div id="printArea">

        <div class="print-header">

            <h1>
                MLG COLLEGE OF LEARNING, INC.
            </h1>

            <h2>
                Web-Based Lost and Found Management System
            </h2>

            <h3>
                CLAIMS REPORT
            </h3>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="admin-table-card">

            <div class="admin-search-wrapper no-print">

                <div class="input-group">

                    <span class="input-group-text admin-search-icon">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        id="claimSearch"
                        class="form-control admin-search"
                        placeholder="Search claims..."
                        autocomplete="off"
                    >

                </div>

            </div>


            <div class="table-responsive">

                <table
                    class="table admin-table align-middle"
                    id="claimsTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Claimant
                            </th>

                            <th>
                                Found Item
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Release Schedule
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

                        @forelse($claims as $claim)

                            <tr>

                                <td>

                                    <div class="admin-user-name">
                                        {{ $claim->claimant->name ?? 'Unknown' }}
                                    </div>

                                    <div class="admin-secondary-text">
                                        {{ $claim->claimant->email ?? '' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="admin-user-name">
                                        {{ $claim->foundItem->item_name ?? 'Unknown' }}
                                    </div>

                                    <div class="admin-secondary-text">

                                        <span class="admin-claim-number">
                                            Claim #{{ $claim->id }}
                                        </span>

                                    </div>

                                </td>


                                <td>

                                    {{ $claim->foundItem->category->name ?? 'Unknown' }}

                                </td>


                                <td>

                                    @if($claim->release_date)

                                        <div class="admin-user-name">

                                            {{ \Carbon\Carbon::parse($claim->release_date)->format('M d, Y') }}

                                        </div>

                                        @if($claim->release_time)

                                            <div class="admin-secondary-text">

                                                {{ \Carbon\Carbon::parse($claim->release_time)->format('h:i A') }}

                                            </div>

                                        @endif

                                        @if($claim->release_location)

                                            <div class="admin-secondary-text">

                                                {{ $claim->release_location }}

                                            </div>

                                        @endif

                                    @else

                                        <span class="admin-secondary-text">
                                            Not scheduled
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($claim->status === 'pending')

                                        <span class="admin-status pending">
                                            Pending
                                        </span>

                                    @elseif($claim->status === 'approved')

                                        <span class="admin-status approved">
                                            Approved
                                        </span>

                                    @elseif($claim->status === 'rejected')

                                        <span class="admin-status rejected">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="admin-status default">

                                            {{ ucfirst(str_replace('_', ' ', $claim->status)) }}

                                        </span>

                                    @endif

                                </td>


                                <td class="text-center no-print">

                                    <div class="admin-action-group">

                                        <a
                                            href="{{ route('admin.claim-details', $claim->id) }}"
                                            class="admin-action-button admin-action-view"
                                            title="View Details"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <form
                                            action="{{ route('admin.claim-delete', $claim->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this claim?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="admin-action-button admin-action-delete"
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
                                    colspan="6"
                                    class="admin-empty"
                                >

                                    <div class="admin-empty-icon">

                                        <i class="bi bi-inbox"></i>

                                    </div>

                                    <div class="admin-empty-title">
                                        No Claims Found
                                    </div>

                                    <p class="admin-empty-text">
                                        There are currently no claims in the system.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <div class="print-footer">

                <div>
                    <strong>Total Claims:</strong>
                    {{ $claims->count() }}
                </div>

                <div>
                    <strong>Report Generated By:</strong>
                    {{ auth()->user()->name }}
                </div>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('claimSearch');

    const rows =
        document.querySelectorAll('#claimsTable tbody tr');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const search =
            this.value.trim().toLowerCase();

        rows.forEach(function (row) {

            const text =
                row.innerText.toLowerCase();

            row.style.display =
                text.includes(search)
                    ? ''
                    : 'none';

        });

    });

});

</script>

@endsection