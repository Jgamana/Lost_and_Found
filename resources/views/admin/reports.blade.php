@extends('layouts.app')

@section('title', 'Admin Reports')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4 no-print">

        <div>
            <h1 class="fw-bold mb-1">
                Admin Reports
            </h1>

            <p class="text-muted mb-0">
                View a summary of the Lost and Found Management System.
            </p>
        </div>

        <button
            type="button"
            class="btn btn-dark"
            onclick="window.print()"
        >
            <i class="bi bi-printer me-1"></i>
            Print Report
        </button>

    </div>


    <div id="printArea">

        <div class="print-header">

            <h1>MLG COLLEGE OF LEARNING, INC.</h1>

            <h2>Web-Based Lost and Found Management System</h2>

            <h3>ADMIN SYSTEM REPORT</h3>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="row g-4 mb-4">

            <div class="col-md-6 col-xl-3">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Users
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalUsers }}
                                </h2>
                            </div>

                            <i class="bi bi-people fs-2 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-xl-3">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Lost Items
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalLostItems }}
                                </h2>
                            </div>

                            <i class="bi bi-search fs-2 text-danger"></i>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-xl-3">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Found Items
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalFoundItems }}
                                </h2>
                            </div>

                            <i class="bi bi-box-seam fs-2 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-xl-3">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Claims
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalClaims }}
                                </h2>
                            </div>

                            <i class="bi bi-clipboard-check fs-2 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="row g-4 mb-4">

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Claim Status
                        </h5>

                        <table class="table align-middle">

                            <tbody>

                                <tr>
                                    <td>Pending</td>
                                    <td class="text-end fw-bold">
                                        {{ $pendingClaims }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Approved</td>
                                    <td class="text-end fw-bold">
                                        {{ $approvedClaims }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Rejected</td>
                                    <td class="text-end fw-bold">
                                        {{ $rejectedClaims }}
                                    </td>
                                </tr>

                                <tr class="fw-bold">
                                    <td>Total Claims</td>
                                    <td class="text-end">
                                        {{ $totalClaims }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Lost Item Status
                        </h5>

                        <table class="table align-middle">

                            <tbody>

                                <tr>
                                    <td>Reported</td>
                                    <td class="text-end fw-bold">
                                        {{ $lostReported }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Claimed</td>
                                    <td class="text-end fw-bold">
                                        {{ $lostClaimed }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Resolved</td>
                                    <td class="text-end fw-bold">
                                        {{ $lostResolved }}
                                    </td>
                                </tr>

                                <tr class="fw-bold">
                                    <td>Total Lost Items</td>
                                    <td class="text-end">
                                        {{ $totalLostItems }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        <div class="row g-4 mb-4">

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Found Item Status
                        </h5>

                        <table class="table align-middle">

                            <tbody>

                                <tr>
                                    <td>Awaiting Surrender</td>
                                    <td class="text-end fw-bold">
                                        {{ $foundAwaitingSurrender }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Received</td>
                                    <td class="text-end fw-bold">
                                        {{ $foundReceived }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Approved</td>
                                    <td class="text-end fw-bold">
                                        {{ $foundApproved }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Claimed</td>
                                    <td class="text-end fw-bold">
                                        {{ $foundClaimed }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Rejected</td>
                                    <td class="text-end fw-bold">
                                        {{ $foundRejected }}
                                    </td>
                                </tr>

                                <tr class="fw-bold">
                                    <td>Total Found Items</td>
                                    <td class="text-end">
                                        {{ $totalFoundItems }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Compensation Summary
                        </h5>

                        <table class="table align-middle">

                            <tbody>

                                <tr>
                                    <td>Total Records</td>
                                    <td class="text-end fw-bold">
                                        {{ $totalCompensations }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Paid</td>
                                    <td class="text-end fw-bold">
                                        {{ $paidCompensations }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Unpaid / Pending</td>
                                    <td class="text-end fw-bold">
                                        {{ $unpaidCompensations }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Total Compensation Amount</td>
                                    <td class="text-end fw-bold">
                                        ₱{{ number_format($totalCompensationAmount, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Total Paid Amount</td>
                                    <td class="text-end fw-bold">
                                        ₱{{ number_format($paidCompensationAmount, 2) }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Overall System Summary
                </h5>

                <table class="table align-middle">

                    <tbody>

                        <tr>
                            <td>Total Users</td>
                            <td class="text-end fw-bold">
                                {{ $totalUsers }}
                            </td>
                        </tr>

                        <tr>
                            <td>Total Lost Item Reports</td>
                            <td class="text-end fw-bold">
                                {{ $totalLostItems }}
                            </td>
                        </tr>

                        <tr>
                            <td>Total Found Item Reports</td>
                            <td class="text-end fw-bold">
                                {{ $totalFoundItems }}
                            </td>
                        </tr>

                        <tr>
                            <td>Total Claims</td>
                            <td class="text-end fw-bold">
                                {{ $totalClaims }}
                            </td>
                        </tr>

                        <tr>
                            <td>Total Compensation Records</td>
                            <td class="text-end fw-bold">
                                {{ $totalCompensations }}
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        <div class="print-footer">

            <div>
                <strong>Report Generated By:</strong>
                {{ auth()->user()->name }}
            </div>

            <div>
                <strong>Generated:</strong>
                {{ now()->format('F d, Y h:i A') }}
            </div>

        </div>

    </div>

</div>


<style>

.print-header {
    display: none;
}

.print-footer {
    display: none;
}

@media print {

    @page {
        size: A4 portrait;
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
        border: 1px solid #000 !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        break-inside: avoid;
    }

    .card-body {
        padding: 12px !important;
    }

    .row {
        margin-bottom: 10px !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 10px;
    }

    th,
    td {
        border: 1px solid #000 !important;
        padding: 6px !important;
    }

    .table {
        margin-bottom: 0 !important;
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
        font-size: 10px;
    }

}

</style>

@endsection