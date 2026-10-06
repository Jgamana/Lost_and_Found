@extends('layouts.app')

@section('title', 'Found Item Details')
@section('page-title', 'Found Item Details')

@section('content')

<style>

.admin-found-details-page {
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
    border: 1px solid var(--admin-border);
    background: white;
    color: var(--admin-text);
    border-radius: 11px;
    padding: 10px 15px;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-back-button:hover {
    background: #f4f8f7;
    color: var(--admin-teal);
    border-color: #cbdedb;
}

.admin-found-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-image-card {
    padding: 22px;
}

.admin-image-wrapper {
    width: 100%;
    height: 430px;
    background: #f4f8f7;
    border: 1px solid #e8efed;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.admin-found-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 12px;
}

.admin-no-image {
    text-align: center;
    color: var(--admin-muted);
}

.admin-no-image-icon {
    font-size: 58px;
    margin-bottom: 10px;
    color: #b8c8c5;
}

.admin-no-image-text {
    font-size: 13px;
    margin-bottom: 0;
}

.admin-details-card {
    padding: 25px;
}

.admin-details-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px;
}

.admin-item-name {
    color: var(--admin-text);
    font-size: 25px;
    font-weight: 700;
    margin-bottom: 5px;
}

.admin-report-number {
    color: var(--admin-muted);
    font-size: 12px;
}

.admin-status {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 9px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.admin-status-claimed {
    background: #e7effa;
    color: #416fa5;
}

.admin-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status-received {
    background: #e5f1f5;
    color: #39778a;
}

.admin-status-awaiting {
    background: #fbf2d7;
    color: #967414;
}

.admin-status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.admin-status-default {
    background: #eef2f1;
    color: #64716f;
}

.admin-divider {
    border: 0;
    border-top: 1px solid var(--admin-border);
    opacity: 1;
    margin: 22px 0;
}

.admin-detail-item {
    padding: 13px 15px;
    background: #fafcfb;
    border: 1px solid #edf2f1;
    border-radius: 12px;
    height: 100%;
}

.admin-detail-label {
    display: block;
    color: var(--admin-muted);
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 5px;
}

.admin-detail-value {
    color: var(--admin-text);
    font-size: 14px;
    font-weight: 600;
    word-break: break-word;
}

.admin-description-label {
    color: var(--admin-muted);
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 8px;
}

.admin-description-box {
    background: #fafcfb;
    border: 1px solid #edf2f1;
    border-radius: 13px;
    padding: 15px;
    color: var(--admin-text);
    font-size: 14px;
    line-height: 1.65;
}

.admin-compensation-box {
    background: #fbf6e5;
    border: 1px solid #eee1b8;
    border-radius: 13px;
    padding: 15px;
}

.admin-compensation-label {
    color: #967414;
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 5px;
}

.admin-compensation-amount {
    color: #80630e;
    font-size: 19px;
    font-weight: 700;
}

.admin-action-area {
    display: flex;
    align-items: center;
    gap: 9px;
    flex-wrap: wrap;
}

.admin-delete-button {
    border: none;
    border-radius: 10px;
    background: #fff0f0;
    color: #bd5555;
    padding: 10px 15px;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-delete-button:hover {
    background: #bd5555;
    color: white;
}

@media (max-width: 992px) {

    .admin-image-wrapper {
        height: 360px;
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

    .admin-details-card {
        padding: 20px;
    }

    .admin-details-heading {
        flex-direction: column;
    }

    .admin-item-name {
        font-size: 22px;
    }

    .admin-image-wrapper {
        height: 300px;
    }

    .admin-action-area {
        width: 100%;
    }

    .admin-back-button,
    .admin-delete-button {
        flex: 1;
    }

}

</style>


<div class="admin-found-details-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-box-seam me-1"></i>
                Found Item Management
            </div>

            <h1 class="admin-page-title">
                Found Item Details
            </h1>

            <p class="admin-page-description">
                View complete information about this found item.
            </p>

        </div>


        <a
            href="{{ route('admin.found-items') }}"
            class="admin-back-button"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back to Found Items
        </a>

    </div>


    <div class="row g-4">

        <div class="col-lg-5">

            <div class="admin-found-card admin-image-card">

                <div class="admin-image-wrapper">

                    @if($foundItem->image)

                        <img
                            src="{{ asset('storage/' . $foundItem->image) }}"
                            alt="{{ $foundItem->item_name }}"
                            class="admin-found-image"
                        >

                    @else

                        <div class="admin-no-image">

                            <div class="admin-no-image-icon">
                                <i class="bi bi-image"></i>
                            </div>

                            <p class="admin-no-image-text">
                                No image available
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        <div class="col-lg-7">

            <div class="admin-found-card admin-details-card">

                <div class="admin-details-heading">

                    <div>

                        <h2 class="admin-item-name">
                            {{ $foundItem->item_name }}
                        </h2>

                        <div class="admin-report-number">
                            Report #{{ $foundItem->id }}
                        </div>

                    </div>


                    @if($foundItem->status === 'claimed')

                        <span class="admin-status admin-status-claimed">
                            Claimed
                        </span>

                    @elseif($foundItem->status === 'approved')

                        <span class="admin-status admin-status-approved">
                            Available
                        </span>

                    @elseif($foundItem->status === 'received')

                        <span class="admin-status admin-status-received">
                            Received
                        </span>

                    @elseif($foundItem->status === 'awaiting_surrender')

                        <span class="admin-status admin-status-awaiting">
                            Awaiting Surrender
                        </span>

                    @elseif($foundItem->status === 'rejected')

                        <span class="admin-status admin-status-rejected">
                            Rejected
                        </span>

                    @else

                        <span class="admin-status admin-status-default">
                            {{ ucfirst(str_replace('_', ' ', $foundItem->status)) }}
                        </span>

                    @endif

                </div>


                <hr class="admin-divider">


                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="admin-detail-item">

                            <span class="admin-detail-label">
                                Reported By
                            </span>

                            <div class="admin-detail-value">
                                {{ $foundItem->user->name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="admin-detail-item">

                            <span class="admin-detail-label">
                                Email
                            </span>

                            <div class="admin-detail-value">
                                {{ $foundItem->user->email ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="admin-detail-item">

                            <span class="admin-detail-label">
                                Category
                            </span>

                            <div class="admin-detail-value">
                                {{ $foundItem->category->name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="admin-detail-item">

                            <span class="admin-detail-label">
                                Location
                            </span>

                            <div class="admin-detail-value">
                                {{ $foundItem->location->name ?? 'Unknown' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="admin-detail-item">

                            <span class="admin-detail-label">
                                Found Date
                            </span>

                            <div class="admin-detail-value">
                                {{ \Carbon\Carbon::parse($foundItem->found_date)->format('M d, Y') }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="admin-detail-item">

                            <span class="admin-detail-label">
                                Received By
                            </span>

                            <div class="admin-detail-value">
                                {{ $foundItem->receiver->name ?? 'Not yet received' }}
                            </div>

                        </div>

                    </div>

                </div>


                <hr class="admin-divider">


                <div class="mb-4">

                    <div class="admin-description-label">
                        Description
                    </div>

                    <div class="admin-description-box">
                        {{ $foundItem->description ?: 'No description provided.' }}
                    </div>

                </div>


                @if($foundItem->suggested_compensation !== null)

                    <div class="mb-4">

                        <div class="admin-compensation-box">

                            <div class="admin-compensation-label">
                                Suggested Compensation
                            </div>

                            <div class="admin-compensation-amount">
                                ₱{{ number_format($foundItem->suggested_compensation, 2) }}
                            </div>

                        </div>

                    </div>

                @endif


                <div class="admin-action-area">

                    <a
                        href="{{ route('admin.found-items') }}"
                        class="admin-back-button"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Back
                    </a>


                    <form
                        action="{{ route('admin.found-item-delete', $foundItem->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this found item report?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="admin-delete-button"
                        >
                            <i class="bi bi-trash me-1"></i>
                            Delete Report
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection