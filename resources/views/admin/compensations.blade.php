@extends('layouts.app')

@section('title', 'Manage Compensations')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Manage Compensations
            </h1>

            <p class="text-muted mb-0">
                View and manage compensation records.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">

            <button
                type="button"
                class="btn btn-dark no-print"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Compensations
            </button>

            <span class="badge bg-dark fs-6 px-3 py-2 no-print">
                {{ $compensations->count() }}
                {{ $compensations->count() === 1 ? 'Compensation' : 'Compensations' }}
            </span>

        </div>

    </div>


    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show no-print">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if ($errors->has('compensation'))

        <div class="alert alert-danger alert-dismissible fade show no-print">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ $errors->first('compensation') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div id="printArea">

        <div class="print-header">

            <h1>MLG COLLEGE OF LEARNING, INC.</h1>

            <h2>Web-Based Lost and Found Management System</h2>

            <h3>COMPENSATION REPORT</h3>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <div class="input-group mb-4 no-print">

                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        id="compensationSearch"
                        class="form-control"
                        placeholder="Search compensations..."
                    >

                </div>


                <div class="table-responsive">

                    <table
                        class="table align-middle mb-0"
                        id="compensationTable"
                    >

                        <thead>

                            <tr>

                                <th>Finder</th>

                                <th>Claimant</th>

                                <th>Found Item</th>

                                <th>Amount</th>

                                <th>Status</th>

                                <th>Paid Date</th>

                                <th class="no-print">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($compensations as $compensation)

                                <tr>

                                    <td class="searchable">

                                        <div class="fw-semibold">
                                            {{ $compensation->finder->name ?? 'Unknown' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $compensation->finder->email ?? '' }}
                                        </small>

                                    </td>


                                    <td class="searchable">

                                        <div class="fw-semibold">
                                            {{ $compensation->claimant->name ?? 'Unknown' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $compensation->claimant->email ?? '' }}
                                        </small>

                                    </td>


                                    <td class="searchable">

                                        <div class="fw-semibold">
                                            {{ $compensation->claim->foundItem->item_name ?? 'Unknown' }}
                                        </div>

                                        <small class="text-muted">
                                            Claim #{{ $compensation->claim_id }}
                                        </small>

                                    </td>


                                    <td class="searchable fw-semibold">

                                        ₱{{ number_format($compensation->amount, 2) }}

                                    </td>


                                    <td class="searchable">

                                        @if ($compensation->status === 'paid')

                                            <span class="badge bg-success">
                                                Paid
                                            </span>

                                        @elseif ($compensation->status === 'pending')

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @elseif ($compensation->status === 'unpaid')

                                            <span class="badge bg-warning text-dark">
                                                Unpaid
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($compensation->status ?? 'Unknown') }}
                                            </span>

                                        @endif

                                    </td>


                                    <td class="searchable">

                                        @if ($compensation->paid_at)

                                            {{ \Carbon\Carbon::parse($compensation->paid_at)->format('M d, Y h:i A') }}

                                        @else

                                            <span class="text-muted">
                                                Not paid
                                            </span>

                                        @endif

                                    </td>


                                    <td class="no-print">

                                        <div class="d-flex gap-2">

                                            <a
                                                href="{{ url('/admin/compensations/' . $compensation->id) }}"
                                                class="btn btn-sm btn-outline-primary"
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
                                                        class="btn btn-sm btn-outline-success"
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
                                                    class="btn btn-sm btn-outline-danger"
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
                                        class="text-center py-5"
                                    >

                                        <i class="bi bi-cash-stack fs-1 text-muted"></i>

                                        <h5 class="mt-3">
                                            No compensation records
                                        </h5>

                                        <p class="text-muted mb-0">
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

document
    .getElementById('compensationSearch')
    .addEventListener('keyup', function () {

        const search = this.value.toLowerCase();

        document
            .querySelectorAll('#compensationTable tbody tr')
            .forEach(function (row) {

                const text = row.innerText.toLowerCase();

                row.style.display =
                    text.includes(search)
                        ? ''
                        : 'none';

            });

    });

</script>


<style>

.print-header {
    display: none;
}

.print-footer {
    display: none;
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

    .card {
        border: none !important;
        box-shadow: none !important;
    }

    .card-body {
        padding: 0 !important;
    }

    .table-responsive {
        overflow: visible !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 11px;
    }

    th,
    td {
        border: 1px solid #000 !important;
        padding: 8px !important;
    }

    thead th {
        font-weight: 700;
        background: #f2f2f2 !important;
    }

    .badge {
        background: none !important;
        color: #000 !important;
        font-weight: 600;
        padding: 0 !important;
    }

    .text-muted {
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

@endsection