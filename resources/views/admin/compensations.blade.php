@extends('layouts.app')

@section('title', 'Manage Compensations')
@section('page-title', 'Manage Compensations')

@section('content')

<style>

.admin-compensation-page {
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

.admin-count-badge {
    background: #eef5f3;
    color: var(--admin-teal);
    border: 1px solid #dce9e6;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
}

.admin-alert {
    border: none;
    border-radius: 13px;
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

.admin-primary-text {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
}

.admin-secondary-text {
    color: var(--admin-muted);
    font-size: 12px;
    margin-top: 3px;
}

.admin-amount-text {
    color: var(--admin-gold);
    font-size: 14px;
    font-weight: 700;
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

.admin-status-paid {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status-pending,
.admin-status-unpaid {
    background: #fbf2d7;
    color: #967414;
}

.admin-status-default {
    background: #eef2f1;
    color: #64716f;
}

.admin-action-group {
    display: flex;
    align-items: center;
    gap: 7px;
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

.admin-paid-button {
    border: 1px solid #cfe4d5;
    color: #43835a;
}

.admin-paid-button:hover {
    background: #43835a;
    color: white;
    border-color: #43835a;
}

.admin-delete-button {
    border: 1px solid #e6cccc;
    color: #bd5555;
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

.print-header {
    display: none;
}

.print-footer {
    display: none;
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

    .admin-search-wrapper {
        display: none !important;
    }

    .table-responsive {
        overflow: visible !important;
    }

    .admin-table {
        width: 100% !important;
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

    .admin-primary-text,
    .admin-secondary-text,
    .admin-amount-text {
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


<div class="admin-compensation-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-cash-stack me-1"></i>
                Compensation Management
            </div>

            <h1 class="admin-page-title">
                Manage Compensations
            </h1>

            <p class="admin-page-description">
                View and manage compensation records.
            </p>

        </div>


        <div class="admin-page-actions">

            <button
                type="button"
                class="admin-print-button no-print"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Compensations
            </button>

            <span class="admin-count-badge no-print">

                {{ $compensations->count() }}

                {{ $compensations->count() === 1 ? 'Compensation' : 'Compensations' }}

            </span>

        </div>

    </div>


    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show admin-alert no-print">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if ($errors->has('compensation'))

        <div class="alert alert-danger alert-dismissible fade show admin-alert no-print">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ $errors->first('compensation') }}

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
                COMPENSATION REPORT
            </h3>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="admin-table-card">

            <div class="admin-table-body">

                <div class="admin-search-wrapper no-print">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            id="compensationSearch"
                            class="form-control"
                            placeholder="Search compensations..."
                            autocomplete="off"
                        >

                    </div>

                </div>


                <div class="table-responsive">

                    <table
                        class="table admin-table align-middle"
                        id="compensationTable"
                    >

                        <thead>

                            <tr>

                                <th>
                                    Finder
                                </th>

                                <th>
                                    Claimant
                                </th>

                                <th>
                                    Found Item
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Paid Date
                                </th>

                                <th class="no-print">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($compensations as $compensation)

                                <tr>

                                    <td class="searchable">

                                        <div class="admin-primary-text">
                                            {{ $compensation->finder->name ?? 'Unknown' }}
                                        </div>

                                        <div class="admin-secondary-text">
                                            {{ $compensation->finder->email ?? '' }}
                                        </div>

                                    </td>


                                    <td class="searchable">

                                        <div class="admin-primary-text">
                                            {{ $compensation->claimant->name ?? 'Unknown' }}
                                        </div>

                                        <div class="admin-secondary-text">
                                            {{ $compensation->claimant->email ?? '' }}
                                        </div>

                                    </td>


                                    <td class="searchable">

                                        <div class="admin-primary-text">
                                            {{ $compensation->claim->foundItem->item_name ?? 'Unknown' }}
                                        </div>

                                        <div class="admin-secondary-text">
                                            Claim #{{ $compensation->claim_id }}
                                        </div>

                                    </td>


                                    <td class="searchable">

                                        <div class="admin-amount-text">
                                            ₱{{ number_format($compensation->amount, 2) }}
                                        </div>

                                    </td>


                                    <td class="searchable">

                                        @if ($compensation->status === 'paid')

                                            <span class="admin-status admin-status-paid">
                                                Paid
                                            </span>

                                        @elseif ($compensation->status === 'pending')

                                            <span class="admin-status admin-status-pending">
                                                Pending
                                            </span>

                                        @elseif ($compensation->status === 'unpaid')

                                            <span class="admin-status admin-status-unpaid">
                                                Unpaid
                                            </span>

                                        @else

                                            <span class="admin-status admin-status-default">
                                                {{ ucfirst($compensation->status ?? 'Unknown') }}
                                            </span>

                                        @endif

                                    </td>


                                    <td class="searchable">

                                        @if ($compensation->paid_at)

                                            <div class="admin-primary-text">
                                                {{ \Carbon\Carbon::parse($compensation->paid_at)->format('M d, Y') }}
                                            </div>

                                            <div class="admin-secondary-text">
                                                {{ \Carbon\Carbon::parse($compensation->paid_at)->format('h:i A') }}
                                            </div>

                                        @else

                                            <span class="admin-secondary-text">
                                                Not paid
                                            </span>

                                        @endif

                                    </td>


                                    <td class="no-print">

                                        <div class="admin-action-group">

                                            <a
                                                href="{{ url('/admin/compensations/' . $compensation->id) }}"
                                                class="admin-action-button admin-view-button"
                                                title="View"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            @if ($compensation->status !== 'paid')

                                                <form
                                                    action="{{ url('/admin/compensations/' . $compensation->id . '/paid') }}"
                                                    method="POST"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="admin-action-button admin-paid-button"
                                                        title="Mark as Paid"
                                                        onclick="return confirm('Mark this compensation as paid?')"
                                                    >
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>

                                                </form>

                                            @endif


                                            <form
                                                action="{{ url('/admin/compensations/' . $compensation->id) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="admin-action-button admin-delete-button"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this compensation record?')"
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
                                            <i class="bi bi-cash-stack"></i>
                                        </div>

                                        <div class="admin-empty-title">
                                            No compensation records
                                        </div>

                                        <p class="admin-empty-text">
                                            Compensation records will appear here
                                            after approved claims.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="print-footer">

                    <div>
                        <strong>Total Compensation Records:</strong>
                        {{ $compensations->count() }}
                    </div>

                    <div>
                        <strong>Report Generated By:</strong>
                        {{ auth()->user()->name }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('compensationSearch');
    const table = document.getElementById('compensationTable');

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