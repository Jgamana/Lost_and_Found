@extends('layouts.app')

@section('title', 'Claim Details')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Claim Details
            </h2>

            <p class="text-muted mb-0">
                View complete information about this claim.
            </p>

        </div>


        <a href="{{ route('admin.claims') }}"
           class="btn btn-light border rounded-3">

            <i class="bi bi-arrow-left me-2"></i>
            Back

        </a>

    </div>


    <div class="row g-4">


        <div class="col-lg-5">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">


                    @if($claim->foundItem && $claim->foundItem->image)

                        <img src="{{ asset('storage/' . $claim->foundItem->image) }}"
                             alt="{{ $claim->foundItem->item_name }}"
                             class="img-fluid rounded-4 w-100"
                             style="max-height: 400px; object-fit: cover;">

                    @else

                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
                             style="height: 300px;">

                            <div class="text-center">

                                <i class="bi bi-image text-muted"
                                   style="font-size: 70px;"></i>

                                <p class="text-muted mb-0">
                                    No image available
                                </p>

                            </div>

                        </div>

                    @endif


                    <div class="mt-4">

                        <small class="text-muted d-block">
                            Found Item
                        </small>

                        <h4 class="fw-bold">
                            {{ $claim->foundItem->item_name ?? 'Unknown' }}
                        </h4>

                    </div>


                    <div class="mt-3">

                        <small class="text-muted d-block">
                            Category
                        </small>

                        <strong>
                            {{ $claim->foundItem->category->name ?? 'Unknown' }}
                        </strong>

                    </div>


                    <div class="mt-3">

                        <small class="text-muted d-block">
                            Location
                        </small>

                        <strong>
                            {{ $claim->foundItem->location->name ?? 'Unknown' }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">


                    <div class="d-flex justify-content-between align-items-start mb-4">

                        <div>

                            <h3 class="fw-bold mb-1">
                                Claim #{{ $claim->id }}
                            </h3>

                            <small class="text-muted">
                                Submitted {{ $claim->created_at->format('M d, Y h:i A') }}
                            </small>

                        </div>


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

                    </div>


                    <hr>


                    <div class="row g-4">


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Claimant
                            </small>

                            <strong>
                                {{ $claim->claimant->name ?? 'Unknown' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $claim->claimant->email ?? 'Unknown' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Found Item
                            </small>

                            <strong>
                                {{ $claim->foundItem->item_name ?? 'Unknown' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Finder
                            </small>

                            <strong>
                                {{ $claim->foundItem->user->name ?? 'Unknown' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Verified By
                            </small>

                            <strong>
                                {{ $claim->verifier->name ?? 'Not yet verified' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Release Date
                            </small>

                            <strong>

                                @if($claim->release_date)

                                    {{ \Carbon\Carbon::parse($claim->release_date)->format('M d, Y') }}

                                @else

                                    Not scheduled

                                @endif

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Release Time
                            </small>

                            <strong>

                                @if($claim->release_time)

                                    {{ \Carbon\Carbon::parse($claim->release_time)->format('h:i A') }}

                                @else

                                    Not scheduled

                                @endif

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Release Location
                            </small>

                            <strong>

                                {{ $claim->release_location ?? 'Not scheduled' }}

                            </strong>

                        </div>

                    </div>


                    <hr>


                    <div class="mb-4">

                        <small class="text-muted d-block mb-2">
                            Claimant Proof
                        </small>

                        <div class="bg-light rounded-3 p-3">

                            {{ $claim->proof }}

                        </div>

                    </div>


                    @if($claim->compensation)

                        <div class="alert alert-info">

                            <strong>
                                Compensation:
                            </strong>

                            ₱{{ number_format($claim->compensation->amount, 2) }}

                            <br>

                            <strong>
                                Status:
                            </strong>

                            {{ ucfirst($claim->compensation->status) }}

                        </div>

                    @endif


                    <div class="d-flex flex-wrap gap-2">

                        <a href="{{ route('admin.claims') }}"
                        class="btn btn-light border rounded-3">

                            <i class="bi bi-arrow-left me-2"></i>
                            Back

                        </a>


                        @if($claim->status === 'pending')

                            {{-- Schedule Release --}}
                            <button type="button"
                                    class="btn btn-primary rounded-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#scheduleModal">

                                <i class="bi bi-calendar-event me-2"></i>
                                Schedule Release

                            </button>


                            {{-- Approve Claim --}}
                            <form action="{{ route('admin.claim-approve', $claim->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to approve this claim?');">

                                @csrf

                                <button type="submit"
                                        class="btn btn-success rounded-3">

                                    <i class="bi bi-check-circle me-2"></i>
                                    Approve Claim

                                </button>

                            </form>


                            {{-- Reject Claim --}}
                            <form action="{{ route('admin.claim-reject', $claim->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to reject this claim?');">

                                @csrf

                                <button type="submit"
                                        class="btn btn-warning rounded-3">

                                    <i class="bi bi-x-circle me-2"></i>
                                    Reject Claim

                                </button>

                            </form>

                        @endif


                        {{-- Delete Claim --}}
                        <form action="{{ route('admin.claim-delete', $claim->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this claim?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger rounded-3">

                                <i class="bi bi-trash me-2"></i>
                                Delete Claim

                            </button>

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@if($claim->status === 'pending')

<div class="modal fade"
     id="scheduleModal"
     tabindex="-1"
     aria-labelledby="scheduleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-header">

                <h5 class="modal-title fw-bold"
                    id="scheduleModalLabel">

                    Schedule Claim Release

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <form action="{{ route('admin.claim-schedule', $claim->id) }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Release Date
                        </label>

                        <input type="date"
                               name="release_date"
                               class="form-control"
                               value="{{ old('release_date', $claim->release_date ? $claim->release_date->format('Y-m-d') : '') }}"
                               required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Release Time
                        </label>

                        <input type="time"
                               name="release_time"
                               class="form-control"
                               value="{{ old('release_time', $claim->release_time ? $claim->release_time->format('H:i') : '') }}"
                               required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Release Location
                        </label>

                        <input type="text"
                               name="release_location"
                               class="form-control"
                               value="{{ old('release_location', $claim->release_location) }}"
                               placeholder="Enter release location"
                               required>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-light border rounded-3"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>


                    <button type="submit"
                            class="btn btn-primary rounded-3">

                        <i class="bi bi-calendar-check me-2"></i>
                        Save Schedule

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif

@endsection