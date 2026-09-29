@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold">Review Claims</h2>

        <p class="text-muted mb-0">
            Review submitted claims, schedule release, and confirm physical release.
        </p>
    </div>


    @if($claims->count() > 0)

        <div class="row g-4">

            @foreach($claims as $claim)

                <div class="col-12">

                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-body p-4">

                            <div class="row g-4">


                                {{-- Claim Information --}}
                                <div class="col-lg-7">

                                    <div class="d-flex justify-content-between align-items-start mb-3">

                                        <div>

                                            <h5 class="fw-bold mb-1">
                                                {{ $claim->foundItem->item_name }}
                                            </h5>

                                            @if($claim->release_date)

                                                <span class="badge bg-info text-dark">
                                                    Scheduled
                                                </span>

                                            @else

                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>

                                            @endif

                                        </div>


                                        <small class="text-muted">
                                            Claim #{{ $claim->id }}
                                        </small>

                                    </div>


                                    {{-- Claimant --}}
                                    <div class="mb-3">

                                        <strong>Claimant:</strong>

                                        {{ $claim->claimant->name }}

                                    </div>


                                    {{-- Category --}}
                                    <div class="mb-3">

                                        <strong>Category:</strong>

                                        {{ $claim->foundItem->category->name ?? 'N/A' }}

                                    </div>


                                    {{-- Location Found --}}
                                    <div class="mb-3">

                                        <strong>Location Found:</strong>

                                        {{ $claim->foundItem->location->name ?? 'N/A' }}

                                    </div>


                                    {{-- Description --}}
                                    <div class="mb-3">

                                        <strong>Description:</strong>

                                        <p class="text-muted mb-0">
                                            {{ $claim->foundItem->description }}
                                        </p>

                                    </div>


                                    {{-- Proof --}}
                                    <div class="mb-3">

                                        <strong>Proof Submitted:</strong>

                                        <p class="text-muted mb-0">
                                            {{ $claim->proof ?? 'No proof provided.' }}
                                        </p>

                                    </div>


                                    {{-- Compensation --}}
                                    <div>

                                        <strong>Suggested Compensation:</strong>

                                        <span class="fw-bold text-success">

                                            ₱{{ number_format(
                                                $claim->foundItem->suggested_compensation ?? 0,
                                                2
                                            ) }}

                                        </span>

                                    </div>

                                </div>


                                {{-- Release Schedule --}}
                                <div class="col-lg-5">

                                    <div class="p-4 bg-light rounded-4">

                                        <h6 class="fw-bold mb-3">

                                            <i class="bi bi-calendar-check me-2"></i>

                                            Release Schedule

                                        </h6>


                                        @if(!$claim->release_date)

                                            {{-- SET SCHEDULE FORM --}}

                                            <form
                                                action="{{ route(
                                                    'faculty.claim-schedule',
                                                    $claim->id
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf


                                                {{-- Release Date --}}
                                                <div class="mb-3">

                                                    <label
                                                        for="release_date_{{ $claim->id }}"
                                                        class="form-label"
                                                    >
                                                        Release Date
                                                    </label>

                                                    <input
                                                        type="date"
                                                        name="release_date"
                                                        id="release_date_{{ $claim->id }}"
                                                        class="form-control"
                                                        min="{{ date('Y-m-d') }}"
                                                        required
                                                    >

                                                </div>


                                                {{-- Release Time --}}
                                                <div class="mb-3">

                                                    <label
                                                        for="release_time_{{ $claim->id }}"
                                                        class="form-label"
                                                    >
                                                        Release Time
                                                    </label>

                                                    <input
                                                        type="time"
                                                        name="release_time"
                                                        id="release_time_{{ $claim->id }}"
                                                        class="form-control"
                                                        required
                                                    >

                                                </div>


                                                {{-- Release Location --}}
                                                <div class="mb-3">

                                                    <label
                                                        for="release_location_{{ $claim->id }}"
                                                        class="form-label"
                                                    >
                                                        Release Location
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="release_location"
                                                        id="release_location_{{ $claim->id }}"
                                                        class="form-control"
                                                        placeholder="Example: Faculty Office"
                                                        maxlength="255"
                                                        required
                                                    >

                                                </div>


                                                {{-- Set Schedule --}}
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary w-100"
                                                >

                                                    <i class="bi bi-calendar-check me-2"></i>

                                                    Set Release Schedule

                                                </button>

                                            </form>

                                        @else

                                            {{-- EXISTING SCHEDULE --}}

                                            <div class="mb-3">

                                                <div class="mb-2">

                                                    <i class="bi bi-calendar-event me-2"></i>

                                                    <strong>Date:</strong>

                                                    {{ \Carbon\Carbon::parse(
                                                        $claim->release_date
                                                    )->format('M d, Y') }}

                                                </div>


                                                <div class="mb-2">

                                                    <i class="bi bi-clock me-2"></i>

                                                    <strong>Time:</strong>

                                                    {{ \Carbon\Carbon::parse(
                                                        $claim->release_time
                                                    )->format('h:i A') }}

                                                </div>


                                                <div class="mb-3">

                                                    <i class="bi bi-geo-alt me-2"></i>

                                                    <strong>Location:</strong>

                                                    {{ $claim->release_location }}

                                                </div>


                                                <div class="alert alert-info py-2 mb-3">

                                                    <i class="bi bi-info-circle me-2"></i>

                                                    The student has been notified of the release schedule.

                                                </div>

                                            </div>


                                            {{-- PHYSICAL RELEASE / APPROVAL --}}

                                            <form
                                                action="{{ route(
                                                    'faculty.claim-approve',
                                                    $claim->id
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-success w-100"
                                                >

                                                    <i class="bi bi-box-arrow-in-right me-2"></i>

                                                    Release & Approve

                                                </button>

                                            </form>

                                        @endif


                                        {{-- REJECT CLAIM --}}

                                        <form
                                            action="{{ route(
                                                'faculty.claim-reject',
                                                $claim->id
                                            ) }}"
                                            method="POST"
                                            class="mt-2"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger w-100"
                                            >

                                                <i class="bi bi-x-circle me-2"></i>

                                                Reject Claim

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


    @else

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body text-center py-5">

                <i
                    class="bi bi-clipboard-check fs-1 text-muted"
                ></i>


                <h5 class="fw-bold mt-3">
                    No Pending Claims
                </h5>


                <p class="text-muted mb-0">
                    There are currently no claims waiting for review.
                </p>

            </div>

        </div>

    @endif

</div>

@endsection