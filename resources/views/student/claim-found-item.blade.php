@extends('layouts.app')

@section('title', 'Claim Found Item')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Found Items
    </div>

    <h1>
        Claim Found Item
    </h1>

    <p>
        Review the item details and provide information to verify your claim.
    </p>

</div>


<div class="row justify-content-center">

    <div class="col-12 col-xl-9">

        <div class="modern-card p-4">

            <div class="section-header mb-4">

                <div>

                    <h5>

                        <i class="bi bi-box-seam me-2"></i>

                        {{ $foundItem->item_name }}

                    </h5>

                    <p>
                        Review the details before submitting your claim.
                    </p>

                </div>

            </div>


            {{-- FOUND ITEM INFORMATION --}}

            <div class="mb-4">

                @if($foundItem->image)

                    <div
                        class="d-flex align-items-center justify-content-center mb-4"
                        style="
                            width: 100%;
                            height: 300px;
                            background: #f5f7f9;
                            border-radius: 12px;
                            overflow: hidden;
                        "
                    >

                        <img
                            src="{{ asset('storage/' . $foundItem->image) }}"
                            alt="{{ $foundItem->item_name }}"
                            style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                                border-radius: 12px;
                            "
                        >

                    </div>

                @endif


                <div class="row g-3">


                    {{-- ITEM NAME --}}

                    <div class="col-md-6">

                        <label class="text-muted small">
                            Item Name
                        </label>

                        <div class="fw-semibold">
                            {{ $foundItem->item_name }}
                        </div>

                    </div>


                    {{-- CATEGORY --}}

                    <div class="col-md-6">

                        <label class="text-muted small">
                            Category
                        </label>

                        <div class="fw-semibold">
                            {{ $foundItem->category->name ?? 'N/A' }}
                        </div>

                    </div>


                    {{-- LOCATION --}}

                    <div class="col-md-6">

                        <label class="text-muted small">
                            Location
                        </label>

                        <div class="fw-semibold">
                            {{ $foundItem->location->name ?? 'N/A' }}
                        </div>

                    </div>


                    {{-- DATE FOUND --}}

                    <div class="col-md-6">

                        <label class="text-muted small">
                            Date Found
                        </label>

                        <div class="fw-semibold">

                            {{ \Carbon\Carbon::parse(
                                $foundItem->found_date
                            )->format('M d, Y') }}

                        </div>

                    </div>


                    {{-- SUGGESTED COMPENSATION --}}

                    <div class="col-12">

                        <label class="text-muted small">
                            Suggested Compensation
                        </label>

                        <div class="fw-bold text-success fs-5">

                            ₱{{ number_format(
                                $foundItem->suggested_compensation ?? 0,
                                2
                            ) }}

                        </div>

                        <small class="text-muted">

                            This is the compensation suggested by the
                            person who found the item.

                        </small>

                    </div>


                </div>

            </div>


            <hr>


            {{-- CLAIM FORM --}}

            <form
                action="{{ route('student.claim-store') }}"
                method="POST"
            >

                @csrf


                <input
                    type="hidden"
                    name="found_item_id"
                    value="{{ $foundItem->id }}"
                >


                {{-- PROOF --}}

                <div class="mb-4">

                    <label class="form-label">
                        Proof / Claim Details
                    </label>

                    <textarea
                        name="proof"
                        class="form-control"
                        rows="5"
                        placeholder="Describe details that can prove this item belongs to you."
                        required
                    >{{ old('proof') }}</textarea>

                    @error('proof')

                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- BUTTONS --}}

                <div class="d-flex gap-2 justify-content-end">

                    <a
                        href="{{ route('student.found-items') }}"
                        class="btn btn-light"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="btn btn-dark"
                    >

                        <i class="bi bi-send me-1"></i>

                        Submit Claim

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection