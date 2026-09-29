@extends('layouts.app')

@section('title', 'Manage Claims')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Manage Claims</h2>

            <p class="text-muted mb-0">
                View and manage all item claims.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">

            <button
                type="button"
                class="btn btn-dark no-print"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Claims
            </button>

            <span class="badge bg-dark fs-6 px-3 py-2 no-print">
                {{ $claims->count() }} Claims
            </span>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show no-print">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show no-print">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div id="printArea">

        <div class="print-header">

            <h1>MLG COLLEGE OF LEARNING, INC.</h1>

            <h2>Web-Based Lost and Found Management System</h2>

            <h3>CLAIMS REPORT</h3>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">


                <div class="mb-4 no-print">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text"
                               id="claimSearch"
                               class="form-control"
                               placeholder="Search claims...">

                    </div>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle"
                           id="claimsTable">

                        <thead>

                            <tr>

                                <th>Claimant</th>

                                <th>Found Item</th>

                                <th>Category</th>

                                <th>Release Schedule</th>

                                <th>Status</th>

                                <th class="text-center no-print">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($claims as $claim)

                                <tr>

                                    <td>

                                        <div class="fw-semibold">
                                            {{ $claim->claimant->name ?? 'Unknown' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $claim->claimant->email ?? '' }}
                                        </small>

                                    </td>


                                    <td>

                                        <div class="fw-semibold">
                                            {{ $claim->foundItem->item_name ?? 'Unknown' }}
                                        </div>

                                        <small class="text-muted">
                                            Claim #{{ $claim->id }}
                                        </small>

                                    </td>


                                    <td>

                                        {{ $claim->foundItem->category->name ?? 'Unknown' }}

                                    </td>


                                    <td>

                                        @if($claim->release_date)

                                            <div class="fw-semibold">

                                                {{ \Carbon\Carbon::parse($claim->release_date)->format('M d, Y') }}

                                            </div>

                                            @if($claim->release_time)

                                                <small class="text-muted">

                                                    {{ \Carbon\Carbon::parse($claim->release_time)->format('h:i A') }}

                                                </small>

                                            @endif

                                            @if($claim->release_location)

                                                <small class="d-block text-muted">

                                                    {{ $claim->release_location }}

                                                </small>

                                            @endif

                                        @else

                                            <span class="text-muted">
                                                Not scheduled
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if($claim->status === 'pending')

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @elseif($claim->status === 'approved')

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        @elseif($claim->status === 'rejected')

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                {{ ucfirst(str_replace('_', ' ', $claim->status)) }}

                                            </span>

                                        @endif

                                    </td>


                                    <td class="text-center no-print">

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('admin.claim-details', $claim->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="View Details">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            <form action="{{ route('admin.claim-delete', $claim->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this claim?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Delete">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="text-center py-5 text-muted">

                                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                        No claims found.

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

</div>


<script>

document.getElementById('claimSearch').addEventListener('input', function () {

    const search = this.value.toLowerCase();

    document.querySelectorAll('#claimsTable tbody tr').forEach(function (row) {

        row.style.display =
            row.innerText.toLowerCase().includes(search)
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