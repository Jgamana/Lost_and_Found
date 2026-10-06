@extends('layouts.app')

@section('title', 'Report Details')

@section('content')

<style>

.student-report-details-page {
    --details-teal: #365c5a;
    --details-teal-dark: #294947;
    --details-gold: #d6a51d;
    --details-border: #e4eceb;
    --details-text: #263b3a;
    --details-muted: #7b8d8b;
    --details-light: #eef5f3;
}


/* PAGE HEADER */

.student-report-details-page .page-heading {
    margin-bottom: 24px;
}

.student-report-details-page .page-label {
    color: var(--details-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-report-details-page .page-heading h1 {
    color: var(--details-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-report-details-page .page-heading p {
    color: var(--details-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* MAIN CARD */

.student-report-details-card {
    background: #ffffff;
    border: 1px solid var(--details-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    padding: 24px;
}


/* IMAGE */

.student-report-image-wrapper {
    width: 100%;
    min-height: 350px;
    border-radius: 16px;
    overflow: hidden;
    background: #f4f8f7;
    border: 1px solid var(--details-border);
    display: flex;
    align-items: center;
    justify-content: center;
}

.student-report-image {
    width: 100%;
    height: 350px;
    object-fit: cover;
    display: block;
}

.student-report-no-image {
    width: 100%;
    min-height: 350px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--details-muted);
}

.student-report-no-image i {
    font-size: 58px;
    color: #b7c6c4;
    margin-bottom: 12px;
}

.student-report-no-image p {
    font-size: 12px;
    margin: 0;
}


/* DETAILS */

.student-report-details-content {
    padding-left: 10px;
}

.student-report-item-title {
    color: var(--details-text);
    font-size: 25px;
    font-weight: 700;
    margin-bottom: 22px;
    line-height: 1.25;
}

.student-report-detail-list {
    display: flex;
    flex-direction: column;
    gap: 13px;
}

.student-report-detail {
    display: flex;
    align-items: flex-start;
    gap: 11px;
}

.student-report-detail-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 9px;
    background: var(--details-light);
    color: var(--details-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.student-report-detail-content {
    padding-top: 1px;
}

.student-report-detail-label {
    color: var(--details-muted);
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 3px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.student-report-detail-value {
    color: var(--details-text);
    font-size: 13px;
    font-weight: 600;
}


/* STATUS */

.student-report-status {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
}

.student-report-status.reported {
    background: #fff6dc;
    color: #967414;
}

.student-report-status.claimed {
    background: #e8eef8;
    color: #506d9a;
}

.student-report-status.resolved {
    background: #e5f3ea;
    color: #43835a;
}

.student-report-status.default {
    background: #eef2f1;
    color: #64716f;
}


/* DESCRIPTION */

.student-report-description-box {
    margin-top: 22px;
    padding-top: 20px;
    border-top: 1px solid var(--details-border);
}

.student-report-description-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--details-text);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 9px;
}

.student-report-description-title i {
    color: var(--details-teal);
}

.student-report-description {
    color: var(--details-muted);
    font-size: 12px;
    line-height: 1.7;
    margin: 0;
    white-space: pre-line;
}


/* ACTIONS */

.student-report-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 9px;
    margin-top: 23px;
    padding-top: 20px;
    border-top: 1px solid var(--details-border);
}

.student-report-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 38px;
    padding: 0 13px;
    border-radius: 9px;
    font-size: 10px;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    transition: 0.2s ease;
}

.student-report-back {
    background: #f5f7f7;
    border-color: var(--details-border);
    color: #64716f;
}

.student-report-back:hover {
    background: #edf2f1;
    color: var(--details-text);
}

.student-report-edit {
    background: var(--details-teal);
    color: #ffffff;
}

.student-report-edit:hover {
    background: var(--details-teal-dark);
    color: #ffffff;
}

.student-report-matches {
    background: #fff8df;
    border-color: #eadcae;
    color: #947315;
}

.student-report-matches:hover {
    background: var(--details-gold);
    border-color: var(--details-gold);
    color: #ffffff;
}

.student-report-delete {
    background: #fff0f0;
    border-color: #f0d2d2;
    color: #bd5555;
}

.student-report-delete:hover {
    background: #bd5555;
    border-color: #bd5555;
    color: #ffffff;
}


/* RESPONSIVE */

@media (max-width: 991px) {

    .student-report-details-content {
        padding-left: 0;
    }

    .student-report-image-wrapper {
        margin-bottom: 8px;
    }

}

@media (max-width: 767px) {

    .student-report-details-page .page-heading h1 {
        font-size: 26px;
    }

    .student-report-details-card {
        padding: 17px;
    }

    .student-report-image-wrapper,
    .student-report-no-image {
        min-height: 270px;
    }

    .student-report-image {
        height: 270px;
    }

    .student-report-item-title {
        font-size: 21px;
    }

    .student-report-actions {
        flex-direction: column;
    }

    .student-report-action {
        width: 100%;
    }

}

</style>


<div class="student-report-details-page">

    {{-- PAGE HEADER --}}

    <div class="page-heading">

        <div class="page-label">
            Lost & Found
        </div>

        <h1>
            Report Details
        </h1>

        <p>
            View the details of your lost item report.
        </p>

    </div>


    {{-- DETAILS CARD --}}

    <div class="student-report-details-card">

        <div class="row g-4">

            {{-- IMAGE --}}

            <div class="col-lg-5">

                <div class="student-report-image-wrapper">

                    @if($lostItem->image)

                        <img
                            src="{{ asset('storage/' . $lostItem->image) }}"
                            alt="{{ $lostItem->item_name }}"
                            class="student-report-image"
                        >

                    @else

                        <div class="student-report-no-image">

                            <i class="bi bi-image"></i>

                            <p>
                                No image uploaded
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- DETAILS --}}

            <div class="col-lg-7">

                <div class="student-report-details-content">

                    <h2 class="student-report-item-title">
                        {{ $lostItem->item_name }}
                    </h2>


                    <div class="student-report-detail-list">

                        {{-- CATEGORY --}}

                        <div class="student-report-detail">

                            <div class="student-report-detail-icon">
                                <i class="bi bi-tag"></i>
                            </div>

                            <div class="student-report-detail-content">

                                <div class="student-report-detail-label">
                                    Category
                                </div>

                                <div class="student-report-detail-value">

                                    @if($lostItem->category)

                                        {{ $lostItem->category->name }}

                                    @elseif($lostItem->custom_category)

                                        {{ $lostItem->custom_category }}

                                    @else

                                        —

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- LOCATION --}}

                        <div class="student-report-detail">

                            <div class="student-report-detail-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <div class="student-report-detail-content">

                                <div class="student-report-detail-label">
                                    Location Lost
                                </div>

                                <div class="student-report-detail-value">

                                    @if($lostItem->location)

                                        {{ $lostItem->location->name }}

                                    @elseif($lostItem->custom_location)

                                        {{ $lostItem->custom_location }}

                                    @else

                                        —

                                    @endif

                                </div>

                            </div>

                        </div>

                        {{-- DATE --}}

                        <div class="student-report-detail">

                            <div class="student-report-detail-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>

                            <div class="student-report-detail-content">

                                <div class="student-report-detail-label">
                                    Date Lost
                                </div>

                                <div class="student-report-detail-value">

                                    {{ \Carbon\Carbon::parse(
                                        $lostItem->lost_date
                                    )->format('M d, Y') }}

                                </div>

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="student-report-detail">

                            <div class="student-report-detail-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>

                            <div class="student-report-detail-content">

                                <div class="student-report-detail-label">
                                    Status
                                </div>

                                <div class="student-report-detail-value">

                                    @if($lostItem->status === 'reported')

                                        <span class="student-report-status reported">
                                            Reported
                                        </span>

                                    @elseif($lostItem->status === 'claimed')

                                        <span class="student-report-status claimed">
                                            Claimed
                                        </span>

                                    @elseif($lostItem->status === 'resolved')

                                        <span class="student-report-status resolved">
                                            Resolved
                                        </span>

                                    @else

                                        <span class="student-report-status default">
                                            {{ ucfirst($lostItem->status) }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="student-report-description-box">

                        <div class="student-report-description-title">

                            <i class="bi bi-card-text"></i>

                            Description

                        </div>

                        <p class="student-report-description">
                            {{ $lostItem->description }}
                        </p>

                    </div>


                    {{-- ACTIONS --}}

                    <div class="student-report-actions">

                        <a
                            href="{{ route('student.my-reports') }}"
                            class="student-report-action student-report-back"
                        >

                            <i class="bi bi-arrow-left"></i>

                            Back to My Reports

                        </a>


                        <a
                            href="{{ route(
                                'student.report-edit',
                                $lostItem->id
                            ) }}"
                            class="student-report-action student-report-edit"
                        >

                            <i class="bi bi-pencil"></i>

                            Edit Report

                        </a>


                        <a
                            href="{{ route(
                                'student.report-matches',
                                $lostItem->id
                            ) }}"
                            class="student-report-action student-report-matches"
                        >

                            <i class="bi bi-stars"></i>

                            Find Possible Matches

                        </a>


                        <form
                            action="{{ route(
                                'student.report-delete',
                                $lostItem->id
                            ) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Are you sure you want to delete this report?');"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="student-report-action student-report-delete"
                            >

                                <i class="bi bi-trash"></i>

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