@extends('layouts.app')

@section('title', 'Found Item Details')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Found Item Details</h2>
            <p class="text-muted mb-0">
                View complete information about this found item.
            </p>
        </div>

        <a href="{{ route('admin.found-items') }}"
           class="btn btn-light border rounded-3">

            <i class="bi bi-arrow-left me-2"></i>
            Back
        </a>

    </div>

    <div class="row g-4">

        <div class="col-lg-5">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4 text-center">

                    @if($foundItem->image)

                        <img src="{{ asset('storage/' . $foundItem->image) }}"
                             alt="{{ $foundItem->item_name }}"
                             class="img-fluid rounded-4"
                             style="max-height: 400px; object-fit: cover;">

                    @else

                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
                             style="height:300px;">

                            <div>
                                <i class="bi bi-image text-muted"
                                   style="font-size: 70px;"></i>

                                <p class="text-muted mb-0">
                                    No image available
                                </p>
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start mb-4">

                        <div>
                            <h3 class="fw-bold mb-1">
                                {{ $foundItem->item_name }}
                            </h3>

                            <small class="text-muted">
                                Report #{{ $foundItem->id }}
                            </small>
                        </div>

                        @if($foundItem->status === 'claimed')

                            <span class="badge bg-primary">
                                Claimed
                            </span>

                        @elseif($foundItem->status === 'approved')

                            <span class="badge bg-success">
                                Available
                            </span>

                        @elseif($foundItem->status === 'received')

                            <span class="badge bg-info text-dark">
                                Received
                            </span>

                        @elseif($foundItem->status === 'awaiting_surrender')

                            <span class="badge bg-warning text-dark">
                                Awaiting Surrender
                            </span>

                        @elseif($foundItem->status === 'rejected')

                            <span class="badge bg-danger">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ ucfirst(str_replace('_', ' ', $foundItem->status)) }}
                            </span>

                        @endif

                    </div>

                    <hr>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Reported By
                            </small>

                            <strong>
                                {{ $foundItem->user->name ?? 'Unknown' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $foundItem->user->email ?? 'Unknown' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Category
                            </small>

                            <strong>
                                {{ $foundItem->category->name ?? 'Unknown' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Location
                            </small>

                            <strong>
                                {{ $foundItem->location->name ?? 'Unknown' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Found Date
                            </small>

                            <strong>
                                {{ \Carbon\Carbon::parse($foundItem->found_date)->format('M d, Y') }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Received By
                            </small>

                            <strong>
                                {{ $foundItem->receiver->name ?? 'Not yet received' }}
                            </strong>

                        </div>

                    </div>

                    <hr>

                    <div class="mb-4">

                        <small class="text-muted d-block mb-2">
                            Description
                        </small>

                        <p class="mb-0">
                            {{ $foundItem->description }}
                        </p>

                    </div>

                    @if($foundItem->suggested_compensation !== null)

                        <div class="mb-4">

                            <small class="text-muted d-block mb-2">
                                Suggested Compensation
                            </small>

                            <strong>
                                ₱{{ number_format($foundItem->suggested_compensation, 2) }}
                            </strong>

                        </div>

                    @endif

                    <div class="d-flex gap-2">

                        <a href="{{ route('admin.found-items') }}"
                           class="btn btn-light border rounded-3">

                            Back
                        </a>

                        <form action="{{ route('admin.found-item-delete', $foundItem->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this found item report?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger rounded-3">

                                <i class="bi bi-trash me-2"></i>
                                Delete Report

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection