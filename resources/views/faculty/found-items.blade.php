@extends('layouts.app')

@section('title', 'Found Item Verification')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Lost & Found
    </div>

    <h1>
        Found Item Verification
    </h1>

    <p>
        Review found items that are waiting to be surrendered and verified.
    </p>

</div>


{{-- Error Message --}}
@if(session('error'))

    <div class="alert alert-danger">

        <i class="bi bi-exclamation-circle me-2"></i>

        {{ session('error') }}

    </div>

@endif


{{-- Success Message --}}
@if(session('success'))

    <div class="alert alert-success">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

    </div>

@endif


{{-- Validation Errors --}}
@if($errors->any())

    <div class="alert alert-danger">

        @foreach($errors->all() as $error)

            <div>
                {{ $error }}
            </div>

        @endforeach

    </div>

@endif


<div class="modern-card p-4">

    <div class="section-header mb-4">

        <div>

            <h5>
                <i class="bi bi-box-seam me-2"></i>
                Found Item Reports
            </h5>

            <p>
                Verify items after they have been physically surrendered.
            </p>

        </div>

    </div>


    @if($foundItems->count() > 0)

        <div class="row g-4">

            @foreach($foundItems as $foundItem)

                <div class="col-12 col-lg-6">

                    <div class="border rounded-4 p-3 h-100">


                        {{-- ========================================= --}}
                        {{-- ITEM IMAGE --}}
                        {{-- ========================================= --}}

                        @if($foundItem->image)

                            <img
                                src="{{ asset('storage/' . $foundItem->image) }}"
                                alt="{{ $foundItem->item_name }}"
                                class="img-fluid rounded-3 mb-3"
                                style="
                                    width: 100%;
                                    height: 220px;
                                    object-fit: cover;
                                "
                            >

                        @else

                            <div
                                class="bg-light rounded-3 mb-3 d-flex align-items-center justify-content-center"
                                style="height: 220px;"
                            >

                                <i class="bi bi-image fs-1 text-secondary"></i>

                            </div>

                        @endif


                        {{-- ========================================= --}}
                        {{-- ITEM NAME + STATUS --}}
                        {{-- ========================================= --}}

                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div>

                                <h5 class="mb-1">
                                    {{ $foundItem->item_name }}
                                </h5>

                                <small class="text-muted">
                                    Report #{{ $foundItem->id }}
                                </small>

                            </div>


                            @if($foundItem->status === 'awaiting_surrender')

                                <span class="badge bg-warning text-dark">
                                    Awaiting Surrender
                                </span>

                            @elseif($foundItem->status === 'received')

                                <span class="badge bg-info text-dark">
                                    Received
                                </span>

                            @endif

                        </div>


                        {{-- ========================================= --}}
                        {{-- REPORTED BY --}}
                        {{-- ========================================= --}}

                        <p class="mb-2">

                            <strong>
                                Reported by:
                            </strong>

                            {{ $foundItem->user->name ?? 'Unknown' }}

                        </p>


                        {{-- ========================================= --}}
                        {{-- CATEGORY --}}
                        {{-- ========================================= --}}

                        <p class="mb-2">

                            <strong>
                                Category:
                            </strong>

                            {{ $foundItem->category->name ?? 'Not specified' }}

                        </p>


                        {{-- ========================================= --}}
                        {{-- SUGGESTED COMPENSATION --}}
                        {{-- ========================================= --}}

                        <p class="mb-2">

                            <strong>
                                Suggested Compensation:
                            </strong>


                            @if($foundItem->suggested_compensation !== null)

                                <span class="fw-bold text-success">

                                    ₱{{ number_format($foundItem->suggested_compensation, 2) }}

                                </span>

                            @else

                                <span class="text-muted">

                                    No compensation suggested

                                </span>

                            @endif

                        </p>


                        {{-- ========================================= --}}
                        {{-- LOCATION --}}
                        {{-- ========================================= --}}

                        <p class="mb-2">

                            <strong>
                                Location Found:
                            </strong>

                            {{ $foundItem->location->name ?? 'Not specified' }}

                        </p>


                        {{-- ========================================= --}}
                        {{-- DATE FOUND --}}
                        {{-- ========================================= --}}

                        <p class="mb-2">

                            <strong>
                                Date Found:
                            </strong>

                            {{ \Carbon\Carbon::parse($foundItem->found_date)->format('F d, Y') }}

                        </p>


                        {{-- ========================================= --}}
                        {{-- DESCRIPTION --}}
                        {{-- ========================================= --}}

                        <p class="mb-3">

                            <strong>
                                Description:
                            </strong>

                            <br>

                            {{ $foundItem->description }}

                        </p>


                        {{-- ========================================= --}}
                        {{-- RECEIVED BY --}}
                        {{-- ========================================= --}}

                        @if($foundItem->receiver)

                            <div class="alert alert-info py-2">

                                <small>

                                    <i class="bi bi-person-check me-1"></i>

                                    Received by:

                                    <strong>
                                        {{ $foundItem->receiver->name }}
                                    </strong>

                                </small>

                            </div>

                        @endif


                        {{-- ========================================= --}}
                        {{-- ACTIONS --}}
                        {{-- ========================================= --}}

                        <div class="d-flex gap-2 mt-3">


                            {{-- ===================================== --}}
                            {{-- AWAITING SURRENDER --}}
                            {{-- ===================================== --}}

                            @if($foundItem->status === 'awaiting_surrender')


                                {{-- Prevent Faculty from receiving own item --}}
                                @if($foundItem->user_id === auth()->id())

                                    <button
                                        type="button"
                                        class="btn btn-secondary w-100"
                                        disabled
                                    >

                                        <i class="bi bi-lock me-1"></i>

                                        Cannot Receive Own Item

                                    </button>


                                @else


                                    {{-- Receive Item --}}
                                    <form
                                        action="{{ route('faculty.found-item-receive', $foundItem->id) }}"
                                        method="POST"
                                        class="flex-grow-1"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-info w-100"
                                            onclick="return confirm('Have you physically received this item?');"
                                        >

                                            <i class="bi bi-box-arrow-in-down me-1"></i>

                                            Receive Item

                                        </button>

                                    </form>


                                @endif


                            {{-- ===================================== --}}
                            {{-- RECEIVED --}}
                            {{-- ===================================== --}}

                            @elseif($foundItem->status === 'received')


                                {{-- Prevent Faculty from verifying own item --}}
                                @if($foundItem->user_id === auth()->id())

                                    <button
                                        type="button"
                                        class="btn btn-secondary w-100"
                                        disabled
                                    >

                                        <i class="bi bi-lock me-1"></i>

                                        Cannot Verify Own Item

                                    </button>


                                @else


                                    {{-- Approve --}}
                                    <form
                                        action="{{ route('faculty.found-item-approve', $foundItem->id) }}"
                                        method="POST"
                                        class="flex-grow-1"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-success w-100"
                                            onclick="return confirm('Are you sure you want to approve this found item?');"
                                        >

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approve

                                        </button>

                                    </form>


                                    {{-- Reject --}}
                                    <form
                                        action="{{ route('faculty.found-item-reject', $foundItem->id) }}"
                                        method="POST"
                                        class="flex-grow-1"
                                        onsubmit="return confirm('Are you sure you want to reject this found item?');"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-danger w-100"
                                        >

                                            <i class="bi bi-x-circle me-1"></i>

                                            Reject

                                        </button>

                                    </form>


                                @endif


                            @endif


                        </div>


                    </div>

                </div>

            @endforeach

        </div>


    @else


        {{-- ========================================= --}}
        {{-- EMPTY STATE --}}
        {{-- ========================================= --}}

        <div class="text-center py-5">

            <i class="bi bi-inbox fs-1 text-secondary"></i>

            <h5 class="mt-3">
                No Found Items Awaiting Verification
            </h5>

            <p class="text-muted mb-0">

                There are currently no found items waiting
                for surrender or verification.

            </p>

        </div>


    @endif


</div>

@endsection