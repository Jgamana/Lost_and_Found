@extends('layouts.app')

@section('title', 'Found Item Verification')
@section('page-title', 'Found Item Verification')

@section('content')

<style>

.faculty-verification-page {
    --teal: #365c5a;
    --teal-dark: #294947;
    --gold: #d6a51d;
    --border: #e4eceb;
    --text: #263b3a;
    --muted: #7b8d8b;
}

.faculty-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.faculty-page-label {
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.faculty-page-title {
    color: var(--text);
    font-size: 30px;
    font-weight: 700;
    margin: 0 0 6px;
}

.faculty-page-description {
    color: var(--muted);
    font-size: 14px;
    margin: 0;
}

.faculty-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #eef5f3;
    color: var(--teal);
    border: 1px solid #dce9e6;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-alert {
    border-radius: 12px;
    border: 1px solid transparent;
    font-size: 12px;
    margin-bottom: 18px;
    padding: 12px 15px;
}

.faculty-alert-danger {
    background: #fff0f0;
    border-color: #efcaca;
    color: #a94442;
}

.faculty-alert-success {
    background: #edf8f0;
    border-color: #c8dfcf;
    color: #43835a;
}

.faculty-verification-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.faculty-section-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px 22px;
    border-bottom: 1px solid var(--border);
}

.faculty-section-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.faculty-section-title {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    margin: 0 0 3px;
}

.faculty-section-description {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

.faculty-verification-body {
    padding: 22px;
}

.faculty-item-card {
    height: 100%;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 14px;
    box-shadow: 0 4px 15px rgba(41, 73, 71, 0.025);
    transition: 0.2s ease;
}

.faculty-item-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(41, 73, 71, 0.08);
}

.faculty-item-image {
    width: 100%;
    height: 220px;
    margin-bottom: 17px;
    background: #f5f8f7;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.faculty-item-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.faculty-no-image {
    color: #a4aeac;
    font-size: 48px;
}

.faculty-item-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 18px;
}

.faculty-item-name {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    line-height: 1.35;
    margin: 0 0 4px;
    word-break: break-word;
}

.faculty-report-number {
    color: var(--muted);
    font-size: 10px;
}

.faculty-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 9px;
    font-weight: 700;
    white-space: nowrap;
    text-align: center;
}

.faculty-status-awaiting {
    background: #fbf2d7;
    color: #967414;
}

.faculty-status-received {
    background: #e3f2f5;
    color: #267080;
}

.faculty-detail-list {
    display: flex;
    flex-direction: column;
    gap: 11px;
}

.faculty-detail-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.faculty-detail-icon {
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    border-radius: 9px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
}

.faculty-detail-label {
    color: var(--muted);
    font-size: 9px;
    font-weight: 500;
    margin-bottom: 2px;
}

.faculty-detail-value {
    color: var(--text);
    font-size: 11px;
    font-weight: 600;
    line-height: 1.4;
}

.faculty-compensation {
    color: #43835a;
    font-weight: 700;
}

.faculty-description-box {
    margin-top: 16px;
    padding: 12px 14px;
    background: #f7f9f8;
    border: 1px solid #edf2f1;
    border-radius: 11px;
}

.faculty-description-label {
    color: var(--muted);
    font-size: 9px;
    font-weight: 600;
    margin-bottom: 5px;
}

.faculty-description-text {
    color: #52605e;
    font-size: 11px;
    line-height: 1.5;
    margin: 0;
}

.faculty-received-box {
    margin-top: 15px;
    padding: 10px 12px;
    background: #edf7f8;
    border: 1px solid #d4e9ed;
    border-radius: 10px;
    color: #267080;
    font-size: 10px;
}

.faculty-actions {
    display: flex;
    gap: 8px;
    margin-top: 18px;
}

.faculty-action-button {
    flex: 1;
    min-height: 40px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 600;
    transition: 0.2s ease;
}

.faculty-receive-button {
    border: 1px solid #bcdfe5;
    background: #e3f2f5;
    color: #267080;
}

.faculty-receive-button:hover {
    background: #267080;
    border-color: #267080;
    color: #ffffff;
}

.faculty-approve-button {
    border: 1px solid #c8dfcf;
    background: #edf8f0;
    color: #43835a;
}

.faculty-approve-button:hover {
    background: #43835a;
    border-color: #43835a;
    color: #ffffff;
}

.faculty-reject-button {
    border: 1px solid #efcaca;
    background: #fff0f0;
    color: #bd5555;
}

.faculty-reject-button:hover {
    background: #bd5555;
    border-color: #bd5555;
    color: #ffffff;
}

.faculty-disabled-button {
    flex: 1;
    min-height: 40px;
    border: 1px solid #e1e6e5;
    background: #f3f5f5;
    color: #929d9b;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 600;
    cursor: not-allowed;
}

.faculty-empty-state {
    padding: 65px 25px;
    text-align: center;
}

.faculty-empty-icon {
    width: 66px;
    height: 66px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 29px;
}

.faculty-empty-title {
    color: var(--text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 7px;
}

.faculty-empty-text {
    max-width: 450px;
    margin: 0 auto;
    color: var(--muted);
    font-size: 12px;
    line-height: 1.5;
}

@media (max-width: 768px) {

    .faculty-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .faculty-page-title {
        font-size: 26px;
    }

    .faculty-count-badge {
        width: 100%;
        justify-content: center;
    }

    .faculty-verification-body {
        padding: 15px;
    }

    .faculty-section-header {
        padding: 18px;
    }

    .faculty-item-image {
        height: 220px;
    }

    .faculty-item-heading {
        flex-direction: column;
    }

    .faculty-status {
        align-self: flex-start;
    }

    .faculty-actions {
        flex-direction: column;
    }

}

</style>


<div class="faculty-verification-page">

    <div class="faculty-page-header">

        <div>

            <div class="faculty-page-label">
                <i class="bi bi-shield-check me-1"></i>
                Item Verification
            </div>

            <h1 class="faculty-page-title">
                Found Item Verification
            </h1>

            <p class="faculty-page-description">
                Review found items that are waiting to be surrendered and verified.
            </p>

        </div>


        @if($foundItems->count() > 0)

            <div class="faculty-count-badge">

                <i class="bi bi-box-seam"></i>

                {{ $foundItems->count() }}
                Item{{ $foundItems->count() !== 1 ? 's' : '' }}

            </div>

        @endif

    </div>


    @if(session('error'))

        <div class="faculty-alert faculty-alert-danger">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    @if(session('success'))

        <div class="faculty-alert faculty-alert-success">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    @if($errors->any())

        <div class="faculty-alert faculty-alert-danger">

            <i class="bi bi-exclamation-circle me-2"></i>

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    @endif


    <div class="faculty-verification-card">

        <div class="faculty-section-header">

            <div class="faculty-section-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>

                <h5 class="faculty-section-title">
                    Found Item Reports
                </h5>

                <p class="faculty-section-description">
                    Verify items after they have been physically surrendered.
                </p>

            </div>

        </div>


        <div class="faculty-verification-body">

            @if($foundItems->count() > 0)

                <div class="row g-4">

                    @foreach($foundItems as $foundItem)

                        <div class="col-12 col-lg-6">

                            <div class="faculty-item-card">

                                @if($foundItem->image)

                                    <div class="faculty-item-image">

                                        <img
                                            src="{{ asset('storage/' . $foundItem->image) }}"
                                            alt="{{ $foundItem->item_name }}"
                                        >

                                    </div>

                                @else

                                    <div class="faculty-item-image">

                                        <i class="bi bi-image faculty-no-image"></i>

                                    </div>

                                @endif


                                <div class="faculty-item-heading">

                                    <div>

                                        <h5 class="faculty-item-name">
                                            {{ $foundItem->item_name }}
                                        </h5>

                                        <div class="faculty-report-number">
                                            Report #{{ $foundItem->id }}
                                        </div>

                                    </div>


                                    @if($foundItem->status === 'awaiting_surrender')

                                        <span class="faculty-status faculty-status-awaiting">
                                            Awaiting Surrender
                                        </span>

                                    @elseif($foundItem->status === 'received')

                                        <span class="faculty-status faculty-status-received">
                                            Received
                                        </span>

                                    @endif

                                </div>


                                <div class="faculty-detail-list">

                                    <div class="faculty-detail-item">

                                        <div class="faculty-detail-icon">
                                            <i class="bi bi-person"></i>
                                        </div>

                                        <div>

                                            <div class="faculty-detail-label">
                                                Reported By
                                            </div>

                                            <div class="faculty-detail-value">
                                                {{ $foundItem->user->name ?? 'Unknown' }}
                                            </div>

                                        </div>

                                    </div>


                                    <div class="faculty-detail-item">

                                        <div class="faculty-detail-icon">
                                            <i class="bi bi-grid"></i>
                                        </div>

                                        <div>

                                            <div class="faculty-detail-label">
                                                Category
                                            </div>

                                            <div class="faculty-detail-value">
                                                {{ $foundItem->category->name ?? 'Not specified' }}
                                            </div>

                                        </div>

                                    </div>


                                    <div class="faculty-detail-item">

                                        <div class="faculty-detail-icon">
                                            <i class="bi bi-cash"></i>
                                        </div>

                                        <div>

                                            <div class="faculty-detail-label">
                                                Suggested Compensation
                                            </div>

                                            <div class="faculty-detail-value faculty-compensation">

                                                @if($foundItem->suggested_compensation !== null)

                                                    ₱{{ number_format($foundItem->suggested_compensation, 2) }}

                                                @else

                                                    No compensation suggested

                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    <div class="faculty-detail-item">

                                        <div class="faculty-detail-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>

                                        <div>

                                            <div class="faculty-detail-label">
                                                Location Found
                                            </div>

                                            <div class="faculty-detail-value">
                                                {{ $foundItem->location->name ?? 'Not specified' }}
                                            </div>

                                        </div>

                                    </div>


                                    <div class="faculty-detail-item">

                                        <div class="faculty-detail-icon">
                                            <i class="bi bi-calendar3"></i>
                                        </div>

                                        <div>

                                            <div class="faculty-detail-label">
                                                Date Found
                                            </div>

                                            <div class="faculty-detail-value">
                                                {{ \Carbon\Carbon::parse($foundItem->found_date)->format('F d, Y') }}
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="faculty-description-box">

                                    <div class="faculty-description-label">
                                        Description
                                    </div>

                                    <p class="faculty-description-text">
                                        {{ $foundItem->description ?: 'No description provided.' }}
                                    </p>

                                </div>


                                @if($foundItem->receiver)

                                    <div class="faculty-received-box">

                                        <i class="bi bi-person-check me-1"></i>

                                        Received by:

                                        <strong>
                                            {{ $foundItem->receiver->name }}
                                        </strong>

                                    </div>

                                @endif


                                <div class="faculty-actions">

                                    @if($foundItem->status === 'awaiting_surrender')

                                        @if($foundItem->user_id === auth()->id())

                                            <button
                                                type="button"
                                                class="faculty-disabled-button"
                                                disabled
                                            >

                                                <i class="bi bi-lock me-1"></i>

                                                Cannot Receive Own Item

                                            </button>

                                        @else

                                            <form
                                                action="{{ route(
                                                    'faculty.found-item-receive',
                                                    $foundItem->id
                                                ) }}"
                                                method="POST"
                                                class="flex-grow-1"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="faculty-action-button faculty-receive-button w-100"
                                                    onclick="return confirm('Have you physically received this item?');"
                                                >

                                                    <i class="bi bi-box-arrow-in-down me-1"></i>

                                                    Receive Item

                                                </button>

                                            </form>

                                        @endif


                                    @elseif($foundItem->status === 'received')

                                        @if($foundItem->user_id === auth()->id())

                                            <button
                                                type="button"
                                                class="faculty-disabled-button"
                                                disabled
                                            >

                                                <i class="bi bi-lock me-1"></i>

                                                Cannot Verify Own Item

                                            </button>

                                        @else

                                            <form
                                                action="{{ route(
                                                    'faculty.found-item-approve',
                                                    $foundItem->id
                                                ) }}"
                                                method="POST"
                                                class="flex-grow-1"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="faculty-action-button faculty-approve-button w-100"
                                                    onclick="return confirm('Are you sure you want to approve this found item?');"
                                                >

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Approve

                                                </button>

                                            </form>


                                            <form
                                                action="{{ route(
                                                    'faculty.found-item-reject',
                                                    $foundItem->id
                                                ) }}"
                                                method="POST"
                                                class="flex-grow-1"
                                                onsubmit="return confirm('Are you sure you want to reject this found item?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="faculty-action-button faculty-reject-button w-100"
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

                <div class="faculty-empty-state">

                    <div class="faculty-empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <h5 class="faculty-empty-title">
                        No Found Items Awaiting Verification
                    </h5>

                    <p class="faculty-empty-text">
                        There are currently no found items waiting
                        for surrender or verification.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection