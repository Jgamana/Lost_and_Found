@extends('layouts.app')

@section('title', 'Compensation Details')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Compensation Details
            </h1>

            <p class="text-muted mb-0">
                View compensation and payment information.
            </p>
        </div>

        <a
            href="{{ route('admin.compensations') }}"
            class="btn btn-light border"
        >
            <i class="bi bi-arrow-left me-2"></i>
            Back
        </a>

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>
                            <h4 class="fw-bold mb-1">
                                Compensation #{{ $compensation->id }}
                            </h4>

                            <small class="text-muted">
                                Claim #{{ $compensation->claim_id }}
                            </small>
                        </div>

                        @if ($compensation->status === 'paid')

                            <span class="badge bg-success fs-6">
                                Paid
                            </span>

                        @elseif ($compensation->status === 'unpaid')

                            <span class="badge bg-warning text-dark fs-6">
                                Unpaid
                            </span>

                        @elseif ($compensation->status === 'pending')

                            <span class="badge bg-warning text-dark fs-6">
                                Pending
                            </span>

                        @else

                            <span class="badge bg-secondary fs-6">
                                {{ ucfirst($compensation->status) }}
                            </span>

                        @endif

                    </div>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Finder
                            </label>

                            <div class="fw-semibold">
                                {{ $compensation->finder->name ?? 'Unknown' }}
                            </div>

                            <small class="text-muted">
                                {{ $compensation->finder->email ?? '' }}
                            </small>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Claimant
                            </label>

                            <div class="fw-semibold">
                                {{ $compensation->claimant->name ?? 'Unknown' }}
                            </div>

                            <small class="text-muted">
                                {{ $compensation->claimant->email ?? '' }}
                            </small>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Found Item
                            </label>

                            <div class="fw-semibold">
                                {{ $compensation->claim->foundItem->item_name ?? 'Unknown' }}
                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Amount
                            </label>

                            <div class="fw-bold fs-5">
                                ₱{{ number_format($compensation->amount, 2) }}
                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Paid At
                            </label>

                            <div>
                                @if ($compensation->paid_at)
                                    {{ \Carbon\Carbon::parse($compensation->paid_at)->format('F d, Y h:i A') }}
                                @else
                                    <span class="text-muted">
                                        Not paid
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Confirmed By
                            </label>

                            <div>
                                {{ $compensation->confirmer->name ?? 'Not yet confirmed' }}
                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Category
                            </label>

                            <div>
                                {{ $compensation->claim->foundItem->category->name ?? 'Unknown' }}
                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">
                                Location
                            </label>

                            <div>
                                {{ $compensation->claim->foundItem->location->name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Payment Action
                    </h5>

                    @if ($compensation->status !== 'paid')

                        <p class="text-muted">
                            Once the compensation has been physically
                            given to the finder, the admin can record
                            the payment here.
                        </p>

                        <form
                            action="{{ route('admin.compensation-paid', $compensation->id) }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-success w-100"
                                onclick="return confirm('Mark this compensation as paid?')"
                            >
                                <i class="bi bi-check-circle me-2"></i>
                                Mark as Paid
                            </button>

                        </form>

                    @else

                        <div class="alert alert-success mb-0">

                            <i class="bi bi-check-circle me-2"></i>

                            This compensation has already been marked
                            as paid.

                        </div>

                    @endif

                </div>

            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Delete Record
                    </h5>

                    <p class="text-muted">
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
                            class="btn btn-outline-danger w-100"
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

</div>

@endsection