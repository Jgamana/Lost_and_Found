@extends('layouts.app')

@section('title', 'Claim Details')
@section('page-title', 'Claim Details')

@section('content')

<style>

.admin-claim-details {
    --admin-teal: #365c5a;
    --admin-teal-dark: #294947;
    --admin-gold: #d6a51d;
    --admin-border: #e4eceb;
    --admin-text: #263b3a;
    --admin-muted: #7b8d8b;
}


/*
|--------------------------------------------------------------------------
| Page Header
|--------------------------------------------------------------------------
*/

.admin-claim-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.admin-claim-header-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--admin-gold);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.admin-claim-header h1 {
    color: var(--admin-text);
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 6px;
}

.admin-claim-header p {
    color: var(--admin-muted);
    font-size: 13px;
    margin-bottom: 0;
}

.admin-back-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 15px;
    border-radius: 11px;
    background: white;
    border: 1px solid var(--admin-border);
    color: var(--admin-text);
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-back-button:hover {
    background: #f4f8f7;
    border-color: #cfdedb;
    color: var(--admin-teal);
}


/*
|--------------------------------------------------------------------------
| Main Cards
|--------------------------------------------------------------------------
*/

.admin-claim-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 22px;
    height: 100%;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.admin-claim-card-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}

.admin-claim-card-heading h5 {
    color: var(--admin-text);
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 4px;
}

.admin-claim-card-heading p {
    color: var(--admin-muted);
    font-size: 11px;
    margin-bottom: 0;
}


/*
|--------------------------------------------------------------------------
| Found Item Image
|--------------------------------------------------------------------------
*/

.admin-claim-image-wrapper {
    width: 100%;
    height: 330px;
    background: #f5f8f7;
    border: 1px solid var(--admin-border);
    border-radius: 17px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-claim-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.admin-no-image {
    text-align: center;
    color: var(--admin-muted);
}

.admin-no-image-icon {
    width: 58px;
    height: 58px;
    margin: 0 auto 12px;
    border-radius: 16px;
    background: #eef4f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.admin-no-image p {
    font-size: 12px;
    margin-bottom: 0;
}


/*
|--------------------------------------------------------------------------
| Found Item Information
|--------------------------------------------------------------------------
*/

.admin-item-title {
    color: var(--admin-text);
    font-size: 21px;
    font-weight: 700;
    margin-top: 8px;
    margin-bottom: 0;
}

.admin-info-row {
    padding: 13px 0;
    border-bottom: 1px solid #edf1f0;
}

.admin-info-row:last-child {
    border-bottom: 0;
}

.admin-info-label {
    color: var(--admin-muted);
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.admin-info-value {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
    word-break: break-word;
}


/*
|--------------------------------------------------------------------------
| Claim Heading
|--------------------------------------------------------------------------
*/

.admin-claim-number {
    color: var(--admin-text);
    font-size: 21px;
    font-weight: 700;
    margin-bottom: 3px;
}

.admin-claim-date {
    color: var(--admin-muted);
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| Status
|--------------------------------------------------------------------------
*/

.admin-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 11px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
}

.admin-status-pending {
    background: #fbf2d7;
    color: #a2760e;
}

.admin-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status-rejected {
    background: #fbe7e7;
    color: #a84a4a;
}

.admin-status-default {
    background: #eef1f2;
    color: #667180;
}


/*
|--------------------------------------------------------------------------
| Details Grid
|--------------------------------------------------------------------------
*/

.admin-details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0 25px;
}


/*
|--------------------------------------------------------------------------
| Proof
|--------------------------------------------------------------------------
*/

.admin-proof-section {
    margin-top: 22px;
}

.admin-proof-box {
    background: #f7faf9;
    border: 1px solid var(--admin-border);
    border-radius: 13px;
    padding: 15px;
    color: var(--admin-text);
    font-size: 13px;
    line-height: 1.6;
    min-height: 70px;
    white-space: pre-wrap;
}


/*
|--------------------------------------------------------------------------
| Compensation
|--------------------------------------------------------------------------
*/

.admin-compensation-box {
    margin-top: 20px;
    padding: 16px;
    border-radius: 14px;
    background: #f7faf9;
    border: 1px solid var(--admin-border);
}

.admin-compensation-label {
    color: var(--admin-muted);
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.admin-compensation-amount {
    color: var(--admin-teal);
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-compensation-status {
    color: var(--admin-text);
    font-size: 12px;
}


/*
|--------------------------------------------------------------------------
| Action Buttons
|--------------------------------------------------------------------------
*/

.admin-action-area {
    display: flex;
    flex-wrap: wrap;
    gap: 9px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--admin-border);
}

.admin-action-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    border: 0;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
    cursor: pointer;
}

.admin-action-button:hover {
    transform: translateY(-1px);
}

.admin-button-back {
    background: #f5f7f8;
    color: #667180;
    border: 1px solid var(--admin-border);
}

.admin-button-back:hover {
    background: #edf1f2;
    color: var(--admin-text);
}

.admin-button-schedule {
    background: var(--admin-teal);
    color: white;
}

.admin-button-schedule:hover {
    background: var(--admin-teal-dark);
    color: white;
}

.admin-button-approve {
    background: #43835a;
    color: white;
}

.admin-button-approve:hover {
    background: #367049;
    color: white;
}

.admin-button-reject {
    background: #d6a51d;
    color: white;
}

.admin-button-reject:hover {
    background: #bd9015;
    color: white;
}

.admin-button-delete {
    background: #b94b4b;
    color: white;
}

.admin-button-delete:hover {
    background: #9f3d3d;
    color: white;
}


/*
|--------------------------------------------------------------------------
| Schedule Modal
|--------------------------------------------------------------------------
*/

.admin-schedule-modal {
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    overflow: hidden;
}

.admin-schedule-header {
    background: var(--admin-teal);
    color: white;
    border-bottom: 0;
    padding: 18px 20px;
}

.admin-schedule-header h5 {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 3px;
}

.admin-schedule-header small {
    color: rgba(255,255,255,0.68);
    font-size: 10px;
}

.admin-schedule-header .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.admin-schedule-body {
    padding: 22px;
}

.admin-form-group {
    margin-bottom: 17px;
}

.admin-form-label {
    display: block;
    color: var(--admin-text);
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 7px;
}

.admin-form-control {
    width: 100%;
    border: 1px solid var(--admin-border);
    border-radius: 10px;
    padding: 10px 12px;
    color: var(--admin-text);
    font-size: 12px;
    background: white;
    outline: none;
    transition: 0.2s ease;
}

.admin-form-control:focus {
    border-color: var(--admin-teal);
    box-shadow: 0 0 0 3px rgba(54,92,90,0.08);
}

.admin-schedule-footer {
    border-top: 1px solid var(--admin-border);
    padding: 15px 20px;
    background: #fafcfb;
}


/*
|--------------------------------------------------------------------------
| Responsive
|--------------------------------------------------------------------------
*/

@media (max-width: 992px) {

    .admin-details-grid {
        grid-template-columns: 1fr 1fr;
    }

}

@media (max-width: 768px) {

    .admin-claim-header {
        flex-direction: column;
    }

    .admin-back-button {
        width: 100%;
        justify-content: center;
    }

    .admin-claim-header h1 {
        font-size: 24px;
    }

    .admin-claim-card {
        padding: 17px;
        border-radius: 17px;
    }

    .admin-claim-image-wrapper {
        height: 270px;
    }

    .admin-details-grid {
        grid-template-columns: 1fr;
    }

    .admin-action-area {
        flex-direction: column;
    }

    .admin-action-button {
        width: 100%;
    }

}

@media (max-width: 576px) {

    .admin-claim-header h1 {
        font-size: 22px;
    }

    .admin-claim-image-wrapper {
        height: 230px;
    }

    .admin-claim-number {
        font-size: 19px;
    }

}

</style>


<div class="admin-claim-details">


    {{-- Page Header --}}
    <div class="admin-claim-header">

        <div>

            <div class="admin-claim-header-label">

                <i class="bi bi-clipboard-check"></i>

                Claim Management

            </div>

            <h1>
                Claim Details
            </h1>

            <p>
                View complete information about this claim.
            </p>

        </div>


        <a
            href="{{ route('admin.claims') }}"
            class="admin-back-button"
        >

            <i class="bi bi-arrow-left"></i>

            Back to Claims

        </a>

    </div>


    <div class="row g-4">


        {{-- Found Item --}}
        <div class="col-12 col-xl-5">

            <div class="admin-claim-card">


                <div class="admin-claim-card-heading">

                    <div>

                        <h5>
                            Found Item
                        </h5>

                        <p>
                            Item associated with this claim.
                        </p>

                    </div>

                </div>


                @if($claim->foundItem && $claim->foundItem->image)

                    <div class="admin-claim-image-wrapper">

                        <img
                            src="{{ asset('storage/' . $claim->foundItem->image) }}"
                            alt="{{ $claim->foundItem->item_name }}"
                        >

                    </div>

                @else

                    <div class="admin-claim-image-wrapper">

                        <div class="admin-no-image">

                            <div class="admin-no-image-icon">

                                <i class="bi bi-image"></i>

                            </div>

                            <p>
                                No image available
                            </p>

                        </div>

                    </div>

                @endif


                <div class="mt-4">

                    <div class="admin-info-label">
                        Item Name
                    </div>

                    <div class="admin-item-title">
                        {{ $claim->foundItem->item_name ?? 'Unknown' }}
                    </div>

                </div>


                <div class="admin-info-row mt-3">

                    <div class="admin-info-label">
                        Category
                    </div>

                    <div class="admin-info-value">
                        {{ $claim->foundItem->category->name ?? 'Unknown' }}
                    </div>

                </div>


                <div class="admin-info-row">

                    <div class="admin-info-label">
                        Location
                    </div>

                    <div class="admin-info-value">
                        {{ $claim->foundItem->location->name ?? 'Unknown' }}
                    </div>

                </div>


            </div>

        </div>


        {{-- Claim Information --}}
        <div class="col-12 col-xl-7">

            <div class="admin-claim-card">


                <div class="admin-claim-card-heading">

                    <div>

                        <div class="admin-claim-number">
                            Claim #{{ $claim->id }}
                        </div>

                        <div class="admin-claim-date">

                            Submitted
                            {{ $claim->created_at->format('M d, Y h:i A') }}

                        </div>

                    </div>


                    @if($claim->status === 'pending')

                        <span class="admin-status admin-status-pending">

                            <i class="bi bi-clock"></i>

                            Pending

                        </span>

                    @elseif($claim->status === 'approved')

                        <span class="admin-status admin-status-approved">

                            <i class="bi bi-check-circle"></i>

                            Approved

                        </span>

                    @elseif($claim->status === 'rejected')

                        <span class="admin-status admin-status-rejected">

                            <i class="bi bi-x-circle"></i>

                            Rejected

                        </span>

                    @else

                        <span class="admin-status admin-status-default">

                            <i class="bi bi-info-circle"></i>

                            {{ ucfirst(str_replace('_', ' ', $claim->status)) }}

                        </span>

                    @endif

                </div>


                <div class="admin-details-grid">


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Claimant
                        </div>

                        <div class="admin-info-value">
                            {{ $claim->claimant->name ?? 'Unknown' }}
                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Email
                        </div>

                        <div class="admin-info-value">
                            {{ $claim->claimant->email ?? 'Unknown' }}
                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Found Item
                        </div>

                        <div class="admin-info-value">
                            {{ $claim->foundItem->item_name ?? 'Unknown' }}
                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Finder
                        </div>

                        <div class="admin-info-value">
                            {{ $claim->foundItem->user->name ?? 'Unknown' }}
                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Verified By
                        </div>

                        <div class="admin-info-value">

                            {{ $claim->verifier->name ?? 'Not yet verified' }}

                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Release Date
                        </div>

                        <div class="admin-info-value">

                            @if($claim->release_date)

                                {{ \Carbon\Carbon::parse($claim->release_date)->format('M d, Y') }}

                            @else

                                Not scheduled

                            @endif

                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Release Time
                        </div>

                        <div class="admin-info-value">

                            @if($claim->release_time)

                                {{ \Carbon\Carbon::parse($claim->release_time)->format('h:i A') }}

                            @else

                                Not scheduled

                            @endif

                        </div>

                    </div>


                    <div class="admin-info-row">

                        <div class="admin-info-label">
                            Release Location
                        </div>

                        <div class="admin-info-value">

                            {{ $claim->release_location ?? 'Not scheduled' }}

                        </div>

                    </div>


                </div>


                <div class="admin-proof-section">

                    <div class="admin-info-label mb-2">
                        Claimant Proof
                    </div>

                    <div class="admin-proof-box">

                        {{ $claim->proof }}

                    </div>

                </div>


                @if($claim->compensation)

                    <div class="admin-compensation-box">

                        <div class="admin-compensation-label">
                            Compensation
                        </div>

                        <div class="admin-compensation-amount">

                            ₱{{ number_format(
                                $claim->compensation->amount,
                                2
                            ) }}

                        </div>

                        <div class="admin-compensation-status">

                            Status:
                            <strong>
                                {{ ucfirst($claim->compensation->status) }}
                            </strong>

                        </div>

                    </div>

                @endif


                {{-- Actions --}}
                <div class="admin-action-area">


                    <a
                        href="{{ route('admin.claims') }}"
                        class="admin-action-button admin-button-back"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Back

                    </a>


                    @if($claim->status === 'pending')


                        <button
                            type="button"
                            class="admin-action-button admin-button-schedule"
                            data-bs-toggle="modal"
                            data-bs-target="#scheduleModal"
                        >

                            <i class="bi bi-calendar-event"></i>

                            Schedule Release

                        </button>


                        <form
                            action="{{ route(
                                'admin.claim-approve',
                                $claim->id
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Are you sure you want to approve this claim?'
                            );"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="admin-action-button admin-button-approve"
                            >

                                <i class="bi bi-check-circle"></i>

                                Approve Claim

                            </button>

                        </form>


                        <form
                            action="{{ route(
                                'admin.claim-reject',
                                $claim->id
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Are you sure you want to reject this claim?'
                            );"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="admin-action-button admin-button-reject"
                            >

                                <i class="bi bi-x-circle"></i>

                                Reject Claim

                            </button>

                        </form>


                    @endif


                    <form
                        action="{{ route(
                            'admin.claim-delete',
                            $claim->id
                        ) }}"
                        method="POST"
                        onsubmit="return confirm(
                            'Are you sure you want to delete this claim?'
                        );"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="admin-action-button admin-button-delete"
                        >

                            <i class="bi bi-trash"></i>

                            Delete Claim

                        </button>

                    </form>


                </div>


            </div>

        </div>


    </div>


</div>


@if($claim->status === 'pending')

<div
    class="modal fade"
    id="scheduleModal"
    tabindex="-1"
    aria-labelledby="scheduleModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content admin-schedule-modal">


            <div class="modal-header admin-schedule-header">

                <div>

                    <h5
                        class="modal-title"
                        id="scheduleModalLabel"
                    >
                        Schedule Claim Release
                    </h5>

                    <small>
                        Set the date, time, and location for the release.
                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <form
                action="{{ route(
                    'admin.claim-schedule',
                    $claim->id
                ) }}"
                method="POST"
            >

                @csrf


                <div class="admin-schedule-body">


                    <div class="admin-form-group">

                        <label class="admin-form-label">
                            Release Date
                        </label>

                        <input
                            type="date"
                            name="release_date"
                            class="admin-form-control"
                            value="{{ old(
                                'release_date',
                                $claim->release_date
                                    ? $claim->release_date->format('Y-m-d')
                                    : ''
                            ) }}"
                            required
                        >

                    </div>


                    <div class="admin-form-group">

                        <label class="admin-form-label">
                            Release Time
                        </label>

                        <input
                            type="time"
                            name="release_time"
                            class="admin-form-control"
                            value="{{ old(
                                'release_time',
                                $claim->release_time
                                    ? $claim->release_time->format('H:i')
                                    : ''
                            ) }}"
                            required
                        >

                    </div>


                    <div class="admin-form-group mb-0">

                        <label class="admin-form-label">
                            Release Location
                        </label>

                        <input
                            type="text"
                            name="release_location"
                            class="admin-form-control"
                            value="{{ old(
                                'release_location',
                                $claim->release_location
                            ) }}"
                            placeholder="Enter release location"
                            required
                        >

                    </div>


                </div>


                <div class="modal-footer admin-schedule-footer">


                    <button
                        type="button"
                        class="admin-action-button admin-button-back"
                        data-bs-dismiss="modal"
                    >

                        Cancel

                    </button>


                    <button
                        type="submit"
                        class="admin-action-button admin-button-schedule"
                    >

                        <i class="bi bi-calendar-check"></i>

                        Save Schedule

                    </button>


                </div>


            </form>


        </div>

    </div>

</div>

@endif

@endsection