@extends('layouts.app')

@section('title', 'Found Items')

@section('content')

<style>

.student-found-page {
    --found-teal: #365c5a;
    --found-teal-dark: #294947;
    --found-gold: #d6a51d;
    --found-border: #e4eceb;
    --found-text: #263b3a;
    --found-muted: #7b8d8b;
    --found-light: #eef5f3;
}


/* PAGE HEADER */

.student-found-page .page-heading {
    margin-bottom: 24px;
}

.student-found-page .page-label {
    color: var(--found-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-found-page .page-heading h1 {
    color: var(--found-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-found-page .page-heading p {
    color: var(--found-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* SEARCH */

.found-search-card {
    background: #ffffff;
    border: 1px solid var(--found-border);
    border-radius: 16px;
    padding: 15px;
    margin-bottom: 22px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.found-search-wrapper {
    position: relative;
}

.found-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--found-muted);
    font-size: 15px;
    z-index: 2;
}

.found-search-input {
    width: 100%;
    height: 46px;
    border: 1px solid var(--found-border);
    border-radius: 11px;
    padding: 0 14px 0 40px;
    background: #fafcfc;
    color: var(--found-text);
    font-size: 13px;
    outline: none;
    transition: 0.2s ease;
}

.found-search-input::placeholder {
    color: #9aa9a7;
}

.found-search-input:focus {
    background: #ffffff;
    border-color: #b8d0cc;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}


/* ITEM CARD */

.found-item-card {
    display: flex;
}

.found-item-card-inner {
    width: 100%;
    height: 100%;
    min-height: 485px;
    background: #ffffff;
    border: 1px solid var(--found-border);
    border-radius: 20px;
    padding: 14px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.045);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.found-item-card-inner:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(41, 73, 71, 0.10);
}


/* IMAGE */

.found-item-image {
    width: 100%;
    height: 215px;
    flex-shrink: 0;
    background: #f4f8f7;
    border: 1px solid #edf2f1;
    border-radius: 15px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.found-item-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.found-no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #a6b3b1;
    font-size: 48px;
}


/* CONTENT */

.found-item-content {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 18px 4px 3px;
}


/* TITLE */

.found-item-title {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 18px;
}

.found-item-title h5 {
    margin: 0;
    color: var(--found-text);
    font-size: 17px;
    font-weight: 700;
    line-height: 1.35;
    word-break: break-word;
}

.found-badge {
    flex-shrink: 0;
    background: #e5f2ed;
    color: #397566;
    border-radius: 20px;
    padding: 6px 10px;
    font-size: 10px;
    font-weight: 700;
}


/* DETAILS */

.found-item-details {
    display: flex;
    flex-direction: column;
    gap: 13px;
}

.found-detail-item {
    display: flex;
    align-items: center;
    gap: 11px;
}

.found-detail-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 10px;
    background: var(--found-light);
    color: var(--found-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.found-detail-item small {
    display: block;
    margin-bottom: 2px;
    color: var(--found-muted);
    font-size: 10px;
    font-weight: 500;
}

.found-detail-item p {
    margin: 0;
    color: #465b59;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.3;
}


/* CLAIM BUTTON */

.found-claim-button-wrapper {
    margin-top: auto;
    padding-top: 20px;
}

.found-claim-button {
    width: 100%;
    min-height: 44px;
    padding: 0 15px;
    border-radius: 11px;
    background: var(--found-teal);
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.found-claim-button span {
    display: flex;
    align-items: center;
    gap: 7px;
}

.found-claim-button > i {
    font-size: 13px;
    transition: transform 0.2s ease;
}

.found-claim-button:hover {
    background: var(--found-teal-dark);
    color: #ffffff;
}

.found-claim-button:hover > i {
    transform: translateX(3px);
}


/* EMPTY STATE */

.found-empty-state {
    background: #ffffff;
    border: 1px solid var(--found-border);
    border-radius: 20px;
    padding: 60px 25px;
    text-align: center;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.found-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: var(--found-light);
    color: var(--found-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.found-empty-state h5 {
    color: var(--found-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 7px;
}

.found-empty-state p {
    color: var(--found-muted);
    font-size: 12px;
    margin-bottom: 0;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-found-page .page-heading h1 {
        font-size: 26px;
    }

    .found-item-card-inner {
        min-height: auto;
    }

    .found-item-image {
        height: 225px;
    }

    .found-item-title h5 {
        font-size: 16px;
    }

}

@media (min-width: 1200px) {

    .found-item-image {
        height: 210px;
    }

}

</style>


<div class="student-found-page">

    <div class="page-heading">

        <div class="page-label">
            Lost & Found
        </div>

        <h1>
            Found Items
        </h1>

        <p>
            Browse items that have been reported as found.
        </p>

    </div>


    {{-- SEARCH --}}

    <div class="found-search-card">

        <div class="found-search-wrapper">

            <i class="bi bi-search found-search-icon"></i>

            <input
                type="text"
                id="foundItemSearch"
                class="found-search-input"
                placeholder="Search found items..."
                autocomplete="off"
            >

        </div>

    </div>


    {{-- FOUND ITEMS --}}

    <div
        class="row g-4"
        id="foundItemsContainer"
    >

        @forelse($foundItems as $item)

            <div
                class="col-12 col-md-6 col-xl-4 found-item-card"
                data-search="{{ strtolower(
                    $item->item_name . ' ' .
                    ($item->description ?? '') . ' ' .
                    ($item->category->name ?? '') . ' ' .
                    ($item->location->name ?? '')
                ) }}"
            >

                <div class="found-item-card-inner">

                    {{-- IMAGE --}}

                    <div class="found-item-image">

                        @if($item->image)

                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->item_name }}"
                            >

                        @else

                            <div class="found-no-image">

                                <i class="bi bi-image"></i>

                            </div>

                        @endif

                    </div>


                    {{-- CONTENT --}}

                    <div class="found-item-content">

                        <div class="found-item-title">

                            <h5>
                                {{ $item->item_name }}
                            </h5>

                            <span class="found-badge">
                                Found
                            </span>

                        </div>


                        <div class="found-item-details">

                            {{-- CATEGORY --}}

                            <div class="found-detail-item">

                                <div class="found-detail-icon">
                                    <i class="bi bi-grid"></i>
                                </div>

                                <div>

                                    <small>
                                        Category
                                    </small>

                                    <p>
                                        {{ $item->category->name ?? 'N/A' }}
                                    </p>

                                </div>

                            </div>


                            {{-- LOCATION --}}

                            <div class="found-detail-item">

                                <div class="found-detail-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>

                                <div>

                                    <small>
                                        Location
                                    </small>

                                    <p>
                                        {{ $item->location->name ?? 'N/A' }}
                                    </p>

                                </div>

                            </div>


                            {{-- DATE FOUND --}}

                            <div class="found-detail-item">

                                <div class="found-detail-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>

                                <div>

                                    <small>
                                        Date Found
                                    </small>

                                    <p>
                                        {{ \Carbon\Carbon::parse(
                                            $item->found_date
                                        )->format('M d, Y') }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- CLAIM --}}

                        <div class="found-claim-button-wrapper">

                            <a
                                href="{{ route(
                                    'student.claim-create',
                                    $item->id
                                ) }}"
                                class="found-claim-button"
                            >

                                <span>

                                    <i class="bi bi-hand-index-thumb"></i>

                                    Claim This Item

                                </span>

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="found-empty-state">

                    <div class="found-empty-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <h5>
                        No Found Items Available
                    </h5>

                    <p>
                        There are currently no found items available for claiming.
                    </p>

                </div>

            </div>

        @endforelse


        {{-- NO SEARCH RESULTS --}}

        <div
            id="noSearchResults"
            class="col-12"
            style="display: none;"
        >

            <div class="found-empty-state">

                <div class="found-empty-icon">
                    <i class="bi bi-search"></i>
                </div>

                <h5>
                    No Matching Items
                </h5>

                <p>
                    No found items match your search.
                </p>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('foundItemSearch');

    const itemCards =
        document.querySelectorAll('.found-item-card');

    const noResults =
        document.getElementById('noSearchResults');


    if (!searchInput) {
        return;
    }


    searchInput.addEventListener('input', function () {

        const searchText =
            this.value.trim().toLowerCase();

        let visibleItems = 0;


        itemCards.forEach(function (card) {

            const searchableText =
                card.dataset.search.toLowerCase();


            if (
                searchText === '' ||
                searchableText.includes(searchText)
            ) {

                card.style.display = '';

                visibleItems++;

            } else {

                card.style.display = 'none';

            }

        });


        if (
            searchText !== '' &&
            visibleItems === 0
        ) {

            noResults.style.display = '';

        } else {

            noResults.style.display = 'none';

        }

    });

});

</script>

@endsection