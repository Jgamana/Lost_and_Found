@extends('layouts.app')

@section('title', 'Admin Reports')
@section('page-title', 'Admin Reports')

@section('content')

<style>

.admin-reports-page {
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

.admin-summary-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 18px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    height: 100%;
}

.admin-summary-card .card-body {
    padding: 20px;
}

.admin-summary-label {
    color: var(--admin-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 6px;
}

.admin-summary-value {
    color: var(--admin-text);
    font-size: 27px;
    font-weight: 700;
    margin-bottom: 0;
}

.admin-summary-icon {
    width: 45px;
    height: 45px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.admin-summary-icon-users {
    background: #e7f0ee;
    color: var(--admin-teal);
}

.admin-summary-icon-lost {
    background: #fff0f0;
    color: #bd5555;
}

.admin-summary-icon-found {
    background: #e5f3ea;
    color: #43835a;
}

.admin-summary-icon-claims {
    background: #fbf2d7;
    color: #967414;
}

.admin-report-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    height: 100%;
    overflow: hidden;
}

.admin-report-card-body {
    padding: 22px;
}

.admin-section-header {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 20px;
}

.admin-section-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.admin-section-title {
    color: var(--admin-text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-section-description {
    color: var(--admin-muted);
    font-size: 11px;
    margin-bottom: 0;
}

.admin-report-table {
    width: 100%;
    margin-bottom: 0;
}

.admin-report-table tbody td {
    color: var(--admin-text);
    border-bottom: 1px solid #edf2f1;
    font-size: 13px;
    padding: 12px 5px;
}

.admin-report-table tbody tr:last-child td {
    border-bottom: none;
}

.admin-report-label {
    color: var(--admin-muted);
}

.admin-report-value {
    color: var(--admin-text);
    font-weight: 700;
}

.admin-report-total td {
    color: var(--admin-teal) !important;
    font-weight: 700;
    border-top: 1px solid var(--admin-border);
}

.admin-compensation-value {
    color: var(--admin-teal);
    font-weight: 700;
}

.admin-overall-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-overall-body {
    padding: 22px;
}

.admin-overall-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 12px;
}

.admin-overall-item {
    background: #fafcfb;
    border: 1px solid #edf2f1;
    border-radius: 13px;
    padding: 16px;
}

.admin-overall-label {
    color: var(--admin-muted);
    font-size: 11px;
    line-height: 1.4;
    margin-bottom: 7px;
}

.admin-overall-value {
    color: var(--admin-text);
    font-size: 22px;
    font-weight: 700;
}

.admin-print-header,
.admin-print-footer {
    display: none;
}

@media (max-width: 992px) {

    .admin-overall-grid {
        grid-template-columns: repeat(3, 1fr);
    }

}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-print-button {
        width: 100%;
    }

    .admin-overall-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 480px) {

    .admin-overall-grid {
        grid-template-columns: 1fr;
    }

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
        display: block !important;
        text-align: center;
        margin-bottom: 22px;
    }

    .print-header h1 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .print-header h2 {
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 9px;
    }

    .print-header h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .print-header p {
        font-size: 10px;
        margin-bottom: 0;
    }

    .admin-summary-card,
    .admin-report-card,
    .admin-overall-card {
        border: 1px solid #000 !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        break-inside: avoid;
    }

    .admin-summary-card .card-body,
    .admin-report-card-body,
    .admin-overall-body {
        padding: 10px !important;
    }

    .admin-summary-label,
    .admin-summary-value,
    .admin-section-title,
    .admin-section-description,
    .admin-report-label,
    .admin-report-value,
    .admin-compensation-value,
    .admin-overall-label,
    .admin-overall-value {
        color: #000 !important;
    }

    .admin-summary-icon,
    .admin-section-icon {
        background: transparent !important;
        color: #000 !important;
    }

    .admin-summary-value {
        font-size: 20px;
    }

    .admin-report-table {
        font-size: 10px;
    }

    .admin-report-table tbody td {
        border: 1px solid #000 !important;
        padding: 6px !important;
        color: #000 !important;
    }

    .admin-report-total td {
        border-top: 1px solid #000 !important;
    }

    .admin-overall-grid {
        display: grid !important;
        grid-template-columns: repeat(5, 1fr) !important;
        gap: 5px !important;
    }

    .admin-overall-item {
        border: 1px solid #000 !important;
        border-radius: 0 !important;
        padding: 8px !important;
        background: white !important;
    }

    .admin-overall-value {
        font-size: 16px;
    }

    .print-footer {
        display: flex !important;
        justify-content: space-between;
        margin-top: 18px;
        padding-top: 9px;
        border-top: 1px solid #000;
        font-size: 9px;
    }

}

</style>


<div class="admin-reports-page">

    <div class="admin-page-header no-print">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-bar-chart-line me-1"></i>
                Administration
            </div>

            <h1 class="admin-page-title">
                Admin Reports
            </h1>

            <p class="admin-page-description">
                View a summary of the Lost and Found Management System.
            </p>

        </div>


        <button
            type="button"
            class="admin-print-button"
            onclick="window.print()"
        >
            <i class="bi bi-printer me-1"></i>
            Print Report
        </button>

    </div>


    <div id="printArea">

        <div class="print-header">

            <h1>
                MLG COLLEGE OF LEARNING, INC.
            </h1>

            <h2>
                Web-Based Lost and Found Management System
            </h2>

            <h3>
                ADMIN SYSTEM REPORT
            </h3>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="row g-4 mb-4">

            <div class="col-md-6 col-xl-3">

                <div class="admin-summary-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="admin-summary-label">
                                    Total Users
                                </div>

                                <div class="admin-summary-value">
                                    {{ $totalUsers }}
                                </div>

                            </div>

                            <div class="admin-summary-icon admin-summary-icon-users">
                                <i class="bi bi-people"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-xl-3">

                <div class="admin-summary-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="admin-summary-label">
                                    Lost Items
                                </div>

                                <div class="admin-summary-value">
                                    {{ $totalLostItems }}
                                </div>

                            </div>

                            <div class="admin-summary-icon admin-summary-icon-lost">
                                <i class="bi bi-search"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-xl-3">

                <div class="admin-summary-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="admin-summary-label">
                                    Found Items
                                </div>

                                <div class="admin-summary-value">
                                    {{ $totalFoundItems }}
                                </div>

                            </div>

                            <div class="admin-summary-icon admin-summary-icon-found">
                                <i class="bi bi-box-seam"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-xl-3">

                <div class="admin-summary-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="admin-summary-label">
                                    Total Claims
                                </div>

                                <div class="admin-summary-value">
                                    {{ $totalClaims }}
                                </div>

                            </div>

                            <div class="admin-summary-icon admin-summary-icon-claims">
                                <i class="bi bi-clipboard-check"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="row g-4 mb-4">


            <div class="col-lg-6">

                <div class="admin-report-card">

                    <div class="admin-report-card-body">

                        <div class="admin-section-header">

                            <div class="admin-section-icon">
                                <i class="bi bi-clipboard-check"></i>
                            </div>

                            <div>

                                <h5 class="admin-section-title">
                                    Claim Status
                                </h5>

                                <p class="admin-section-description">
                                    Current status of submitted claims.
                                </p>

                            </div>

                        </div>


                        <table class="table admin-report-table">

                            <tbody>

                                <tr>

                                    <td class="admin-report-label">
                                        Pending
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $pendingClaims }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Approved
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $approvedClaims }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Rejected
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $rejectedClaims }}
                                    </td>

                                </tr>


                                <tr class="admin-report-total">

                                    <td>
                                        Total Claims
                                    </td>

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

                <div class="admin-report-card">

                    <div class="admin-report-card-body">

                        <div class="admin-section-header">

                            <div class="admin-section-icon">
                                <i class="bi bi-search"></i>
                            </div>

                            <div>

                                <h5 class="admin-section-title">
                                    Lost Item Status
                                </h5>

                                <p class="admin-section-description">
                                    Current status of lost item reports.
                                </p>

                            </div>

                        </div>


                        <table class="table admin-report-table">

                            <tbody>

                                <tr>

                                    <td class="admin-report-label">
                                        Reported
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $lostReported }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Claimed
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $lostClaimed }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Resolved
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $lostResolved }}
                                    </td>

                                </tr>


                                <tr class="admin-report-total">

                                    <td>
                                        Total Lost Items
                                    </td>

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

                <div class="admin-report-card">

                    <div class="admin-report-card-body">

                        <div class="admin-section-header">

                            <div class="admin-section-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>

                                <h5 class="admin-section-title">
                                    Found Item Status
                                </h5>

                                <p class="admin-section-description">
                                    Current status of found item reports.
                                </p>

                            </div>

                        </div>


                        <table class="table admin-report-table">

                            <tbody>

                                <tr>

                                    <td class="admin-report-label">
                                        Awaiting Surrender
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $foundAwaitingSurrender }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Received
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $foundReceived }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Approved
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $foundApproved }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Claimed
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $foundClaimed }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Rejected
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $foundRejected }}
                                    </td>

                                </tr>


                                <tr class="admin-report-total">

                                    <td>
                                        Total Found Items
                                    </td>

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

                <div class="admin-report-card">

                    <div class="admin-report-card-body">

                        <div class="admin-section-header">

                            <div class="admin-section-icon">
                                <i class="bi bi-cash-coin"></i>
                            </div>

                            <div>

                                <h5 class="admin-section-title">
                                    Compensation Summary
                                </h5>

                                <p class="admin-section-description">
                                    Overview of compensation records and payments.
                                </p>

                            </div>

                        </div>


                        <table class="table admin-report-table">

                            <tbody>

                                <tr>

                                    <td class="admin-report-label">
                                        Total Records
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $totalCompensations }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Paid
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $paidCompensations }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Unpaid / Pending
                                    </td>

                                    <td class="text-end admin-report-value">
                                        {{ $unpaidCompensations }}
                                    </td>

                                </tr>


                                <tr>

                                    <td class="admin-report-label">
                                        Total Compensation Amount
                                    </td>

                                    <td class="text-end admin-compensation-value">
                                        ₱{{ number_format($totalCompensationAmount, 2) }}
                                    </td>

                                </tr>


                                <tr class="admin-report-total">

                                    <td>
                                        Total Paid Amount
                                    </td>

                                    <td class="text-end">
                                        ₱{{ number_format($paidCompensationAmount, 2) }}
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        <div class="admin-overall-card">

            <div class="admin-overall-body">

                <div class="admin-section-header">

                    <div class="admin-section-icon">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>

                    <div>

                        <h5 class="admin-section-title">
                            Overall System Summary
                        </h5>

                        <p class="admin-section-description">
                            General overview of the system records.
                        </p>

                    </div>

                </div>


                <div class="admin-overall-grid">

                    <div class="admin-overall-item">

                        <div class="admin-overall-label">
                            Total Users
                        </div>

                        <div class="admin-overall-value">
                            {{ $totalUsers }}
                        </div>

                    </div>


                    <div class="admin-overall-item">

                        <div class="admin-overall-label">
                            Total Lost Item Reports
                        </div>

                        <div class="admin-overall-value">
                            {{ $totalLostItems }}
                        </div>

                    </div>


                    <div class="admin-overall-item">

                        <div class="admin-overall-label">
                            Total Found Item Reports
                        </div>

                        <div class="admin-overall-value">
                            {{ $totalFoundItems }}
                        </div>

                    </div>


                    <div class="admin-overall-item">

                        <div class="admin-overall-label">
                            Total Claims
                        </div>

                        <div class="admin-overall-value">
                            {{ $totalClaims }}
                        </div>

                    </div>


                    <div class="admin-overall-item">

                        <div class="admin-overall-label">
                            Total Compensation Records
                        </div>

                        <div class="admin-overall-value">
                            {{ $totalCompensations }}
                        </div>

                    </div>

                </div>

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

@endsection