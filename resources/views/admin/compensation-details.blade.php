@extends('layouts.app')

@section('title', 'Compensation Details')
@section('page-title', 'Compensation Details')

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

.admin-back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 16px;
    border-radius: 12px;
    background: white;
    border: 1px solid var(--admin-border);
    color: var(--admin-text);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-back-button:hover {
    background: #f4f8f7;
    color: var(--admin-teal);
    border-color: #cfdedc;
}

.admin-compensation-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 23px;
    height: 100%;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.admin-detail-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px;
}

.admin-detail-title {
    color: var(--admin-text);
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 5px;
}

.admin-detail-subtitle {
    color: var(--admin-muted);
    font-size: 12px;
}

.admin-status {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.admin-status.paid {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status.unpaid,
.admin-status.pending {
    background: #fbf2d7;
    color: #967414;
}

.admin-status.default {
    background: #eef2f1;
    color: #64716f;
}

.admin-detail-divider {
    border: 0;
    border-top: 1px solid #edf1f0;
    margin: 21px 0;
}

.admin-detail-item {
    padding: 15px 16px;
    background: #f7faf9;
    border: 1px solid #edf2f1;
    border-radius: 13px;
    height: 100%;
}

.admin-detail-label {
    color: var(--admin-muted);
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.admin-detail-value {
    color: var(--admin-text);
    font-size: 14px;
    font-weight: 600;
    word-break: break-word;
}

.admin-detail-secondary {
    color: var(--admin-muted);
    font-size: 12px;
    margin-top: 3px;
    word-break: break-word;
}

.admin-amount {
    color: var(--admin-gold);
    font-size: 22px;
    font-weight: 700;
}

.admin-side-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 22px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.admin-side-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 9px;
}

.admin-side-text {
    color: var(--admin-muted);
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 18px;
}

.admin-payment-box {
    background: #eef6f4;
    border: 1px solid #d9e9e6;
    border-radius: 14px;
    padding: 16px;
    margin-bottom: 17px;
}

.admin-payment-box-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: #dcece9;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    margin-bottom: 11px;
}

.admin-payment-box-title {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-payment-box-text {
    color: var(--admin-muted);
    font-size: 12px;
    line-height: 1.5;
    margin-bottom: 0;
}

.admin-paid-box {
    background: #eaf5ed;
    border: 1px solid #d5e9da;
    border-radius: 14px;
    padding: 17px;
    color: #43835a;
    font-size: 13px;
    line-height: 1.5;
}

.admin-paid-box i {
    font-size: 20px;
    margin-right: 7px;
}

.admin-paid-box strong {
    display: block;
    margin-bottom: 4px;
    font-size: 14px;
}

.admin-action-paid {
    width: 100%;
    border: none;
    border-radius: 11px;
    padding: 12px 15px;
    background: var(--admin-teal);
    color: white;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-action-paid:hover {
    background: var(--admin-teal-dark);
    color: white;
}

.admin-delete-card {
    margin-top: 18px;
}

.admin-delete-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    background: #fff1f1;
    color: #bd5555;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    margin-bottom: 11px;
}

.admin-delete-button {
    width: 100%;
    border: 1px solid #e4caca;
    border-radius: 11px;
    padding: 11px 15px;
    background: #fffafa;
    color: #bd5555;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-delete-button:hover {
    background: #bd5555;
    color: white;
    border-color: #bd5555;
}

.admin-alert {
    border: 0;
    border-radius: 13px;
    font-size: 13px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-compensation-card,
    .admin-side-card {
        padding: 18px;
        border-radius: 17px;
    }

    .admin-detail-heading {
        flex-direction: column;
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
                Compensation Details
            </h1>

            <p class="admin-page-description">
                View compensation and payment information.
            </p>

        </div>


        <a
            href="{{ route('admin.compensations') }}"
            class="admin-back-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Compensation
        </a>

    </div>


    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show admin-alert">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="row g-4">

        <div class="col-12 col-lg-8">

            <div class="admin-compensation-card">

                <div class="admin-detail-heading">

                    <div>

                        <h2 class="admin-detail-title">
                            Compensation #{{ $compensation->id }}
                        </h2>

                        <div class="admin-detail-subtitle">
                            Claim #{{ $compensation->claim_id }}
                        </div>

                    </div>


                    @if ($compensation->status === 'paid')

                        <span class="admin-status paid">
                            Paid
                        </span>

                    @elseif ($compensation->status === 'unpaid')

                        <span class="admin-status unpaid">
                            Unpaid
                        </span>

                    @elseif ($compensation->status === 'pending')

                        <span class="admin-status pending">
                            Pending
                        </span>

                    @else

                        <span class="admin-status default">
                            {{ ucfirst($compensation->status) }}
                        </span>

                    @endif

                </div>


                <hr class="admin-detail-divider">


                <div class="row g-3">

                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Finder
                            </div>

                            <div class="admin-detail-value">
                                {{ $compensation->finder->name ?? 'Unknown' }}
                            </div>

                            <div class="admin-detail-secondary">
                                {{ $compensation->finder->email ?? '' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Claimant
                            </div>

                            <div class="admin-detail-value">
                                {{ $compensation->claimant->name ?? 'Unknown' }}
                            </div>

                            <div class="admin-detail-secondary">
                                {{ $compensation->claimant->email ?? '' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Found Item
                            </div>

                            <div class="admin-detail-value">
                                {{ $compensation->claim->foundItem->item_name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Compensation Amount
                            </div>

                            <div class="admin-amount">
                                ₱{{ number_format($compensation->amount, 2) }}
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Paid At
                            </div>

                            <div class="admin-detail-value">

                                @if ($compensation->paid_at)

                                    {{ \Carbon\Carbon::parse($compensation->paid_at)->format('F d, Y h:i A') }}

                                @else

                                    <span style="color: #9aa8a6;">
                                        Not paid
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Confirmed By
                            </div>

                            <div class="admin-detail-value">
                                {{ $compensation->confirmer->name ?? 'Not yet confirmed' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Category
                            </div>

                            <div class="admin-detail-value">
                                {{ $compensation->claim->foundItem->category->name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="admin-detail-item">

                            <div class="admin-detail-label">
                                Location
                            </div>

                            <div class="admin-detail-value">
                                {{ $compensation->claim->foundItem->location->name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-12 col-lg-4">

            <div class="admin-side-card">

                <h3 class="admin-side-title">
                    Payment Action
                </h3>

                @if ($compensation->status !== 'paid')

                    <div class="admin-payment-box">

                        <div class="admin-payment-box-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>

                        <div class="admin-payment-box-title">
                            Record Payment
                        </div>

                        <p class="admin-payment-box-text">
                            Once the compensation has been physically
                            given to the finder, the admin can record
                            the payment here.
                        </p>

                    </div>


                    <form
                        action="{{ route('admin.compensation-paid', $compensation->id) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="admin-action-paid"
                            onclick="return confirm('Mark this compensation as paid?')"
                        >
                            <i class="bi bi-check-circle me-2"></i>
                            Mark as Paid
                        </button>

                    </form>

                @else

                    <div class="admin-paid-box">

                        <strong>
                            <i class="bi bi-check-circle"></i>
                            Payment Completed
                        </strong>

                        This compensation has already been marked
                        as paid.

                    </div>

                @endif

            </div>


            <div class="admin-side-card admin-delete-card">

                <div class="admin-delete-icon">
                    <i class="bi bi-trash"></i>
                </div>

                <h3 class="admin-side-title">
                    Delete Record
                </h3>

                <p class="admin-side-text">
                    Deleting this record will permanently remove
                    the compensation record.
                </p>


                <form
                    action="{{ route('admin.compensation-delete', $compensation->id) }}"
                    method="POST"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="admin-delete-button"
                        onclick="return confirm('Are you sure you want to delete this compensation record?')"
                    >
                        <i class="bi bi-trash me-2"></i>
                        Delete Compensation
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection