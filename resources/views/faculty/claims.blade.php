@extends('layouts.app')

@section('title', 'Review Claims')
@section('page-title', 'Review Claims')

@section('content')

<style>

.faculty-claims-page {
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

.faculty-claim-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.faculty-claim-body {
    padding: 24px;
}

.faculty-claim-section {
    height: 100%;
}

.faculty-claim-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px;
}

.faculty-claim-title {
    color: var(--text);
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 5px;
}

.faculty-claim-number {
    color: var(--muted);
    font-size: 11px;
    margin: 0;
}

.faculty-claim-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 10px;
    border-radius: 9px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-status-pending {
    background: #fbf2d7;
    color: #967414;
}

.faculty-status-scheduled {
    background: #e4f2f3;
    color: #39777b;
}

.faculty-info-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.faculty-info-item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
}

.faculty-info-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.faculty-info-label {
    color: var(--muted);
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 2px;
}

.faculty-info-value {
    color: var(--text);
    font-size: 12px;
    font-weight: 600;
    line-height: 1.45;
}

.faculty-description-box {
    background: #f8faf9;
    border: 1px solid #edf2f1;
    border-radius: 13px;
    padding: 13px 14px;
    margin-top: 16px;
}

.faculty-description-label {
    color: var(--muted);
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 5px;
}

.faculty-description-text {
    color: #4e5d5b;
    font-size: 12px;
    line-height: 1.5;
    margin: 0;
}

.faculty-compensation {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    background: #fffaf0;
    border: 1px solid #f0dfad;
    border-radius: 13px;
    padding: 13px 14px;
    margin-top: 16px;
}

.faculty-compensation-label {
    color: #806b2b;
    font-size: 11px;
    font-weight: 600;
}

.faculty-compensation-amount {
    color: #967414;
    font-size: 15px;
    font-weight: 700;
}

.faculty-schedule-card {
    height: 100%;
    background: #f8faf9;
    border: 1px solid #e8efed;
    border-radius: 16px;
    padding: 20px;
}

.faculty-schedule-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text);
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 20px;
}

.faculty-schedule-heading-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #e8f2f0;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.faculty-form-label {
    color: var(--text);
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 7px;
}

.faculty-form-control {
    width: 100%;
    height: 43px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: #ffffff;
    color: var(--text);
    padding: 0 12px;
    font-size: 12px;
    outline: none;
    transition: 0.2s ease;
}

.faculty-form-control:focus {
    border-color: #b8d0cc;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

.faculty-schedule-info {
    display: flex;
    flex-direction: column;
    gap: 11px;
    margin-bottom: 18px;
}

.faculty-schedule-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.faculty-schedule-item i {
    color: var(--teal);
    font-size: 14px;
    margin-top: 1px;
}

.faculty-schedule-label {
    display: block;
    color: var(--muted);
    font-size: 10px;
    margin-bottom: 2px;
}

.faculty-schedule-value {
    color: var(--text);
    font-size: 12px;
    font-weight: 600;
}

.faculty-notification {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    background: #eaf5f5;
    border: 1px solid #d8e9e8;
    border-radius: 10px;
    padding: 11px 12px;
    color: #39777b;
    font-size: 10px;
    line-height: 1.4;
    margin-bottom: 18px;
}

.faculty-notification i {
    font-size: 13px;
    margin-top: 1px;
}

.faculty-primary-button,
.faculty-danger-button {
    width: 100%;
    min-height: 43px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    transition: 0.2s ease;
}

.faculty-primary-button {
    border: none;
    background: var(--teal);
    color: #ffffff;
}

.faculty-primary-button:hover {
    background: var(--teal-dark);
    color: #ffffff;
}

.faculty-danger-button {
    margin-top: 9px;
    border: 1px solid #efcaca;
    background: #fff0f0;
    color: #bd5555;
}

.faculty-danger-button:hover {
    background: #bd5555;
    border-color: #bd5555;
    color: #ffffff;
}

.faculty-empty-state {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    padding: 60px 25px;
    text-align: center;
}

.faculty-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.faculty-empty-title {
    color: var(--text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 7px;
}

.faculty-empty-text {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

@media (max-width: 768px) {

    .faculty-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .faculty-page-title {
        font-size: 26px;
    }

    .faculty-claim-body {
        padding: 18px;
    }

    .faculty-claim-header {
        flex-direction: column;
    }

    .faculty-schedule-card {
        padding: 17px;
    }

}

</style>


<div class="faculty-claims-page">

    <div class="faculty-page-header">

        <div>

            <div class="faculty-page-label">
                <i class="bi bi-clipboard-check me-1"></i>
                Claim Management
            </div>

            <h1 class="faculty-page-title">
                Review Claims
            </h1>

            <p class="faculty-page-description">
                Review submitted claims, schedule release, and confirm physical release.
            </p>

        </div>

    </div>


    @if($claims->count() > 0)

        <div class="row g-4">

            @foreach($claims as $claim)

                <div class="col-12">

                    <div class="faculty-claim-card">

                        <div class="faculty-claim-body">

                            <div class="row g-4">

                                <div class="col-lg-7">

                                    <div class="faculty-claim-section">

                                        <div class="faculty-claim-header">

                                            <div>

                                                <h5 class="faculty-claim-title">
                                                    {{ $claim->foundItem->item_name }}
                                                </h5>

                                                <p class="faculty-claim-number">
                                                    Claim #{{ $claim->id }}
                                                </p>

                                            </div>


                                            @if($claim->release_date)

                                                <span class="faculty-claim-status faculty-status-scheduled">
                                                    <i class="bi bi-calendar-check"></i>
                                                    Scheduled
                                                </span>

                                            @else

                                                <span class="faculty-claim-status faculty-status-pending">
                                                    <i class="bi bi-clock"></i>
                                                    Pending
                                                </span>

                                            @endif

                                        </div>


                                        <div class="faculty-info-list">

                                            <div class="faculty-info-item">

                                                <div class="faculty-info-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>

                                                <div>

                                                    <div class="faculty-info-label">
                                                        Claimant
                                                    </div>

                                                    <div class="faculty-info-value">
                                                        {{ $claim->claimant->name ?? 'Unknown' }}
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="faculty-info-item">

                                                <div class="faculty-info-icon">
                                                    <i class="bi bi-grid"></i>
                                                </div>

                                                <div>

                                                    <div class="faculty-info-label">
                                                        Category
                                                    </div>

                                                    <div class="faculty-info-value">
                                                        {{ $claim->foundItem->category->name ?? 'N/A' }}
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="faculty-info-item">

                                                <div class="faculty-info-icon">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>

                                                <div>

                                                    <div class="faculty-info-label">
                                                        Location Found
                                                    </div>

                                                    <div class="faculty-info-value">
                                                        {{ $claim->foundItem->location->name ?? 'N/A' }}
                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="faculty-description-box">

                                            <div class="faculty-description-label">
                                                Description
                                            </div>

                                            <p class="faculty-description-text">
                                                {{ $claim->foundItem->description ?? 'No description provided.' }}
                                            </p>

                                        </div>


                                        <div class="faculty-description-box">

                                            <div class="faculty-description-label">
                                                Proof Submitted
                                            </div>

                                            <p class="faculty-description-text">
                                                {{ $claim->proof ?? 'No proof provided.' }}
                                            </p>

                                        </div>


                                        <div class="faculty-compensation">

                                            <span class="faculty-compensation-label">
                                                Suggested Compensation
                                            </span>

                                            <span class="faculty-compensation-amount">
                                                ₱{{ number_format(
                                                    $claim->foundItem->suggested_compensation ?? 0,
                                                    2
                                                ) }}
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-5">

                                    <div class="faculty-schedule-card">

                                        <div class="faculty-schedule-heading">

                                            <div class="faculty-schedule-heading-icon">
                                                <i class="bi bi-calendar-check"></i>
                                            </div>

                                            <span>
                                                Release Schedule
                                            </span>

                                        </div>


                                        @if(!$claim->release_date)

                                            <form
                                                action="{{ route(
                                                    'faculty.claim-schedule',
                                                    $claim->id
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <div class="mb-3">

                                                    <label class="faculty-form-label">
                                                        Release Date
                                                    </label>

                                                    <input
                                                        type="date"
                                                        name="release_date"
                                                        class="faculty-form-control"
                                                        min="{{ date('Y-m-d') }}"
                                                        required
                                                    >

                                                </div>


                                                <div class="mb-3">

                                                    <label class="faculty-form-label">
                                                        Release Time
                                                    </label>

                                                    <input
                                                        type="time"
                                                        name="release_time"
                                                        class="faculty-form-control"
                                                        required
                                                    >

                                                </div>


                                                <div class="mb-3">

                                                    <label class="faculty-form-label">
                                                        Release Location
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="release_location"
                                                        class="faculty-form-control"
                                                        placeholder="Example: Faculty Office"
                                                        maxlength="255"
                                                        required
                                                    >

                                                </div>


                                                <button
                                                    type="submit"
                                                    class="faculty-primary-button"
                                                >

                                                    <i class="bi bi-calendar-check me-1"></i>
                                                    Set Release Schedule

                                                </button>

                                            </form>

                                        @else

                                            <div class="faculty-schedule-info">

                                                <div class="faculty-schedule-item">

                                                    <i class="bi bi-calendar-event"></i>

                                                    <div>

                                                        <span class="faculty-schedule-label">
                                                            Date
                                                        </span>

                                                        <span class="faculty-schedule-value">
                                                            {{ \Carbon\Carbon::parse(
                                                                $claim->release_date
                                                            )->format('M d, Y') }}
                                                        </span>

                                                    </div>

                                                </div>


                                                <div class="faculty-schedule-item">

                                                    <i class="bi bi-clock"></i>

                                                    <div>

                                                        <span class="faculty-schedule-label">
                                                            Time
                                                        </span>

                                                        <span class="faculty-schedule-value">
                                                            {{ \Carbon\Carbon::parse(
                                                                $claim->release_time
                                                            )->format('h:i A') }}
                                                        </span>

                                                    </div>

                                                </div>


                                                <div class="faculty-schedule-item">

                                                    <i class="bi bi-geo-alt"></i>

                                                    <div>

                                                        <span class="faculty-schedule-label">
                                                            Location
                                                        </span>

                                                        <span class="faculty-schedule-value">
                                                            {{ $claim->release_location }}
                                                        </span>

                                                    </div>

                                                </div>

                                            </div>


                                            <div class="faculty-notification">

                                                <i class="bi bi-info-circle"></i>

                                                <span>
                                                    The claimant has been notified of the release schedule.
                                                </span>

                                            </div>


                                            <form
                                                action="{{ route(
                                                    'faculty.claim-approve',
                                                    $claim->id
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to release and approve this claim?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="faculty-primary-button"
                                                >

                                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                                    Release &amp; Approve

                                                </button>

                                            </form>

                                        @endif


                                        <form
                                            action="{{ route(
                                                'faculty.claim-reject',
                                                $claim->id
                                            ) }}"
                                            method="POST"
                                            class="mt-2"
                                            onsubmit="return confirm('Are you sure you want to reject this claim?');"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="faculty-danger-button"
                                            >

                                                <i class="bi bi-x-circle me-1"></i>
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

        <div class="faculty-empty-state">

            <div class="faculty-empty-icon">
                <i class="bi bi-clipboard-check"></i>
            </div>

            <h5 class="faculty-empty-title">
                No Pending Claims
            </h5>

            <p class="faculty-empty-text">
                There are currently no claims waiting for review.
            </p>

        </div>

    @endif

</div>

@endsection