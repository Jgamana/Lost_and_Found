@extends('layouts.app')

@section('title', 'Possible Matches')

@section('content')

<style>

.student-matches-page {
    --match-teal: #365c5a;
    --match-teal-dark: #294947;
    --match-gold: #d6a51d;
    --match-border: #e4eceb;
    --match-text: #263b3a;
    --match-muted: #7b8d8b;
    --match-light: #eef5f3;
}


/* PAGE HEADER */

.student-matches-page .page-heading {
    margin-bottom: 24px;
}

.student-matches-page .page-label {
    color: var(--match-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-matches-page .page-heading h1 {
    color: var(--match-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-matches-page .page-heading p {
    color: var(--match-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* CARDS */

.match-main-card {
    background: #ffffff;
    border: 1px solid var(--match-border);
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.match-section-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding-bottom: 18px;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--match-border);
}

.match-section-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    background: var(--match-light);
    color: var(--match-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.match-section-title {
    color: var(--match-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.match-section-text {
    color: var(--match-muted);
    font-size: 12px;
    margin-bottom: 0;
}


/* LOST ITEM SUMMARY */

.lost-item-summary {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
}

.lost-summary-item {
    padding: 14px 15px;
    border: 1px solid var(--match-border);
    border-radius: 13px;
    background: #fbfcfc;
}

.lost-summary-label {
    display: block;
    color: var(--match-muted);
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 5px;
}

.lost-summary-value {
    color: var(--match-text);
    font-size: 13px;
    font-weight: 700;
    line-height: 1.4;
    word-break: break-word;
}

.lost-description {
    grid-column: 1 / -1;
}

.lost-description .lost-summary-value {
    font-weight: 500;
    line-height: 1.6;
}


/* MATCH CARD */

.match-item-card {
    height: 100%;
    background: #ffffff;
    border: 1px solid var(--match-border);
    border-radius: 17px;
    padding: 14px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.match-item-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 11px 26px rgba(41, 73, 71, 0.09);
}


/* MATCH IMAGE */

.match-item-image {
    width: 100%;
    height: 205px;
    background: #f5f8f7;
    border: 1px solid #edf2f1;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 17px;
}

.match-item-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.match-no-image {
    color: #a6b3b1;
    font-size: 45px;
}


/* MATCH TITLE */

.match-item-title {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 17px;
}

.match-item-title h5 {
    color: var(--match-text);
    font-size: 16px;
    font-weight: 700;
    line-height: 1.35;
    margin: 0;
    word-break: break-word;
}

.match-score {
    flex-shrink: 0;
    background: #fbf2d7;
    color: #967414;
    border: 1px solid #eadcae;
    border-radius: 9px;
    padding: 6px 9px;
    font-size: 10px;
    font-weight: 700;
}


/* MATCH DETAILS */

.match-details {
    display: flex;
    flex-direction: column;
    gap: 11px;
}

.match-detail {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.match-detail-icon {
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    border-radius: 9px;
    background: var(--match-light);
    color: var(--match-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
}

.match-detail-content {
    min-width: 0;
}

.match-detail-label {
    display: block;
    color: var(--match-muted);
    font-size: 9px;
    font-weight: 600;
    margin-bottom: 2px;
}

.match-detail-value {
    color: #465b59;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.45;
    word-break: break-word;
}


/* CLAIM BUTTON */

.match-claim-button {
    width: 100%;
    min-height: 43px;
    margin-top: 18px;
    padding: 0 14px;
    border-radius: 11px;
    background: var(--match-teal);
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 600;
    transition: 0.2s ease;
}

.match-claim-button:hover {
    background: var(--match-teal-dark);
    color: #ffffff;
}


/* EMPTY STATE */

.match-empty-state {
    text-align: center;
    padding: 55px 20px 35px;
}

.match-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    border-radius: 18px;
    background: var(--match-light);
    color: var(--match-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 27px;
}

.match-empty-state h5 {
    color: var(--match-text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 7px;
}

.match-empty-state p {
    max-width: 430px;
    margin: 0 auto;
    color: var(--match-muted);
    font-size: 12px;
    line-height: 1.6;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-matches-page .page-heading h1 {
        font-size: 26px;
    }

    .match-main-card {
        padding: 19px;
        border-radius: 17px;
    }

    .lost-item-summary {
        grid-template-columns: 1fr;
    }

    .lost-description {
        grid-column: auto;
    }

    .match-item-image {
        height: 220px;
    }

}

</style>


<div class="student-matches-page">

    {{-- PAGE HEADER --}}

    <div class="page-heading">

        <div class="page-label">
            Lost & Found
        </div>

        <h1>
            Possible Matches
        </h1>

        <p>
            These found items may match your lost item based on their details.
        </p>

    </div>


    {{-- LOST ITEM --}}

    <div class="match-main-card mb-4">

        <div class="match-section-header">

            <div class="match-section-icon">
                <i class="bi bi-search"></i>
            </div>

            <div>

                <h5 class="match-section-title">
                    Your Lost Item
                </h5>

                <p class="match-section-text">
                    Details from your lost item report.
                </p>

            </div>

        </div>


        <div class="lost-item-summary">

            <div class="lost-summary-item">

                <span class="lost-summary-label">
                    Item
                </span>

                <div class="lost-summary-value">
                    {{ $lostItem->item_name }}
                </div>

            </div>


            <div class="lost-summary-item">

                <span class="lost-summary-label">
                    Category
                </span>

                <div class="lost-summary-value">
                    {{ $lostItem->category->name ?? 'Custom Category' }}
                </div>

            </div>


            <div class="lost-summary-item">

                <span class="lost-summary-label">
                    Location
                </span>

                <div class="lost-summary-value">
                    {{ $lostItem->location->name ?? $lostItem->custom_location ?? 'Not specified' }}
                </div>

            </div>


            <div class="lost-summary-item lost-description">

                <span class="lost-summary-label">
                    Description
                </span>

                <div class="lost-summary-value">
                    {{ $lostItem->description }}
                </div>

            </div>

        </div>

    </div>


    {{-- RECOMMENDED MATCHES --}}

    <div class="match-main-card">

        <div class="match-section-header">

            <div class="match-section-icon">
                <i class="bi bi-stars"></i>
            </div>

            <div>

                <h5 class="match-section-title">
                    Recommended Matches
                </h5>

                <p class="match-section-text">
                    Found items with a match score of 40% or higher.
                </p>

            </div>

        </div>


        @if($matches->count() > 0)

            <div class="row g-4">

                @foreach($matches as $foundItem)

                    <div class="col-12 col-md-6">

                        <div class="match-item-card">

                            {{-- IMAGE --}}

                            <div class="match-item-image">

                                @if($foundItem->image)

                                    <img
                                        src="{{ asset('storage/' . $foundItem->image) }}"
                                        alt="{{ $foundItem->item_name }}"
                                    >

                                @else

                                    <div class="match-no-image">

                                        <i class="bi bi-image"></i>

                                    </div>

                                @endif

                            </div>


                            {{-- TITLE + SCORE --}}

                            <div class="match-item-title">

                                <h5>
                                    {{ $foundItem->item_name }}
                                </h5>

                                <span class="match-score">
                                    {{ $foundItem->match_score }}% Match
                                </span>

                            </div>


                            {{-- DETAILS --}}

                            <div class="match-details">

                                <div class="match-detail">

                                    <div class="match-detail-icon">
                                        <i class="bi bi-grid"></i>
                                    </div>

                                    <div class="match-detail-content">

                                        <span class="match-detail-label">
                                            Category
                                        </span>

                                        <div class="match-detail-value">
                                            {{ $foundItem->category->name ?? 'Not specified' }}
                                        </div>

                                    </div>

                                </div>


                                <div class="match-detail">

                                    <div class="match-detail-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>

                                    <div class="match-detail-content">

                                        <span class="match-detail-label">
                                            Location
                                        </span>

                                        <div class="match-detail-value">
                                            {{ $foundItem->location->name ?? 'Not specified' }}
                                        </div>

                                    </div>

                                </div>


                                <div class="match-detail">

                                    <div class="match-detail-icon">
                                        <i class="bi bi-card-text"></i>
                                    </div>

                                    <div class="match-detail-content">

                                        <span class="match-detail-label">
                                            Description
                                        </span>

                                        <div class="match-detail-value">
                                            {{ $foundItem->description }}
                                        </div>

                                    </div>

                                </div>


                                <div class="match-detail">

                                    <div class="match-detail-icon">
                                        <i class="bi bi-calendar3"></i>
                                    </div>

                                    <div class="match-detail-content">

                                        <span class="match-detail-label">
                                            Date Found
                                        </span>

                                        <div class="match-detail-value">
                                            {{ \Carbon\Carbon::parse($foundItem->found_date)->format('F d, Y') }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- CLAIM --}}

                            <a
                                href="{{ route('student.claim-create', $foundItem->id) }}"
                                class="match-claim-button"
                            >

                                <i class="bi bi-hand-index-thumb"></i>

                                Claim This Item

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="match-empty-state">

                <div class="match-empty-icon">

                    <i class="bi bi-search"></i>

                </div>

                <h5>
                    No Possible Matches Found
                </h5>

                <p>
                    We couldn't find any found items that closely match your report yet.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection