@extends('layouts.app')

@section('title', 'Claim Found Item')

@section('content')

<style>

.claim-page {
    --claim-teal: #365c5a;
    --claim-teal-dark: #294947;
    --claim-gold: #d6a51d;
    --claim-border: #e4eceb;
    --claim-text: #263b3a;
    --claim-muted: #7b8d8b;
}

.claim-page .page-heading {
    margin-bottom: 24px;
}

.claim-page .page-label {
    color: var(--claim-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.claim-page .page-heading h1 {
    color: var(--claim-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.claim-page .page-heading p {
    color: var(--claim-muted);
    font-size: 14px;
    margin-bottom: 0;
}

.claim-card {
    background: #ffffff;
    border: 1px solid var(--claim-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.04);
    overflow: hidden;
}

.claim-card-header {
    padding: 22px 24px;
    border-bottom: 1px solid var(--claim-border);
}

.claim-card-header h5 {
    color: var(--claim-text);
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}

.claim-card-header h5 i {
    color: var(--claim-teal);
}

.claim-card-header p {
    color: var(--claim-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.claim-card-body {
    padding: 24px;
}

.claim-image-wrapper {
    width: 100%;
    height: 320px;
    background: #f5f8f7;
    border: 1px solid var(--claim-border);
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.claim-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.claim-no-image {
    color: #a5b1af;
    text-align: center;
}

.claim-no-image i {
    font-size: 48px;
    display: block;
    margin-bottom: 8px;
}

.claim-no-image span {
    font-size: 12px;
}

.claim-details {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
}

.claim-detail-item {
    border: 1px solid var(--claim-border);
    background: #fbfcfc;
    border-radius: 13px;
    padding: 14px 15px;
}

.claim-detail-item.full {
    grid-column: 1 / -1;
}

.claim-detail-label {
    display: block;
    color: var(--claim-muted);
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 5px;
}

.claim-detail-value {
    color: var(--claim-text);
    font-size: 13px;
    font-weight: 700;
}

.claim-compensation {
    background: #fbf7e8;
    border: 1px solid #eee0aa;
    border-radius: 14px;
    padding: 16px;
}

.claim-compensation-label {
    color: #967414;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 5px;
}

.claim-compensation-amount {
    color: var(--claim-teal);
    font-size: 22px;
    font-weight: 700;
}

.claim-compensation-note {
    color: #897c55;
    font-size: 11px;
    margin-top: 4px;
}

.claim-divider {
    border: 0;
    border-top: 1px solid var(--claim-border);
    margin: 25px 0;
}

.claim-form-title {
    color: var(--claim-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 5px;
}

.claim-form-description {
    color: var(--claim-muted);
    font-size: 12px;
    margin-bottom: 18px;
}

.claim-form-label {
    color: var(--claim-text);
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 7px;
}

.claim-form-control {
    width: 100%;
    border: 1px solid var(--claim-border);
    border-radius: 11px;
    padding: 12px 14px;
    color: var(--claim-text);
    background: #ffffff;
    font-size: 13px;
    outline: none;
    resize: vertical;
    transition: 0.2s ease;
}

.claim-form-control:focus {
    border-color: #a9c5c1;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

.claim-form-control::placeholder {
    color: #a1aaa9;
}

.claim-error {
    color: #bd5555;
    font-size: 11px;
    margin-top: 6px;
}

.claim-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    margin-top: 20px;
}

.claim-cancel-button,
.claim-submit-button {
    border-radius: 10px;
    padding: 10px 17px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.claim-cancel-button {
    background: #f5f7f7;
    border: 1px solid var(--claim-border);
    color: #66716f;
}

.claim-cancel-button:hover {
    background: #eef2f1;
    color: var(--claim-text);
}

.claim-submit-button {
    border: 1px solid var(--claim-teal);
    background: var(--claim-teal);
    color: #ffffff;
}

.claim-submit-button:hover {
    background: var(--claim-teal-dark);
    border-color: var(--claim-teal-dark);
    color: #ffffff;
}

@media (max-width: 767px) {

    .claim-page .page-heading h1 {
        font-size: 26px;
    }

    .claim-card-header,
    .claim-card-body {
        padding: 18px;
    }

    .claim-image-wrapper {
        height: 240px;
    }

    .claim-details {
        grid-template-columns: 1fr;
    }

    .claim-detail-item.full {
        grid-column: auto;
    }

    .claim-actions {
        flex-direction: column-reverse;
    }

    .claim-cancel-button,
    .claim-submit-button {
        width: 100%;
        text-align: center;
    }

}

</style>


<div class="claim-page">

    <div class="page-heading">

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

            <div class="claim-card">

                <div class="claim-card-header">

                    <h5>
                        <i class="bi bi-box-seam me-2"></i>
                        {{ $foundItem->item_name }}
                    </h5>

                    <p>
                        Review the details before submitting your claim.
                    </p>

                </div>


                <div class="claim-card-body">

                    @if($foundItem->image)

                        <div class="claim-image-wrapper">

                            <img
                                src="{{ asset('storage/' . $foundItem->image) }}"
                                alt="{{ $foundItem->item_name }}"
                            >

                        </div>

                    @else

                        <div class="claim-image-wrapper">

                            <div class="claim-no-image">

                                <i class="bi bi-image"></i>

                                <span>
                                    No image uploaded
                                </span>

                            </div>

                        </div>

                    @endif


                    <div class="claim-details">

                        <div class="claim-detail-item">

                            <span class="claim-detail-label">
                                Item Name
                            </span>

                            <div class="claim-detail-value">
                                {{ $foundItem->item_name }}
                            </div>

                        </div>


                        <div class="claim-detail-item">

                            <span class="claim-detail-label">
                                Category
                            </span>

                            <div class="claim-detail-value">
                                {{ $foundItem->category->name ?? 'N/A' }}
                            </div>

                        </div>


                        <div class="claim-detail-item">

                            <span class="claim-detail-label">
                                Location
                            </span>

                            <div class="claim-detail-value">
                                {{ $foundItem->location->name ?? 'N/A' }}
                            </div>

                        </div>


                        <div class="claim-detail-item">

                            <span class="claim-detail-label">
                                Date Found
                            </span>

                            <div class="claim-detail-value">

                                {{ \Carbon\Carbon::parse(
                                    $foundItem->found_date
                                )->format('M d, Y') }}

                            </div>

                        </div>


                        <div class="claim-detail-item full">

                            <div class="claim-compensation">

                                <div class="claim-compensation-label">
                                    Suggested Compensation
                                </div>

                                <div class="claim-compensation-amount">

                                    ₱{{ number_format(
                                        $foundItem->suggested_compensation ?? 0,
                                        2
                                    ) }}

                                </div>

                                <div class="claim-compensation-note">

                                    This is the compensation suggested by the
                                    person who found the item.

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="claim-divider">


                    <div>

                        <div class="claim-form-title">
                            Claim Verification
                        </div>

                        <p class="claim-form-description">
                            Provide details that can help verify that this item belongs to you.
                        </p>


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


                            <div>

                                <label class="claim-form-label">
                                    Proof / Claim Details
                                </label>

                                <textarea
                                    name="proof"
                                    class="claim-form-control"
                                    rows="5"
                                    placeholder="Describe details that can prove this item belongs to you."
                                    required
                                >{{ old('proof') }}</textarea>

                                @error('proof')

                                    <div class="claim-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="claim-actions">

                                <a
                                    href="{{ route('student.found-items') }}"
                                    class="claim-cancel-button"
                                >
                                    Cancel
                                </a>


                                <button
                                    type="submit"
                                    class="claim-submit-button"
                                >

                                    <i class="bi bi-send me-1"></i>

                                    Submit Claim

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection