@extends('layouts.app')

@section('title', 'Found Items')

@section('content')

<div class="page-heading mb-4">

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


<div class="modern-card search-card mb-4">

    <div class="search-wrapper">

        <i class="bi bi-search"></i>

        <input
            type="text"
            id="foundItemSearch"
            class="search-input"
            placeholder="Search found items..."
            autocomplete="off"
        >

    </div>

</div>


<div
    class="row g-4"
    id="foundItemsContainer"
>

    @forelse($foundItems as $item)

        <div
            class="col-12 col-md-6 col-xl-4 found-item-card"
            data-search="
                {{ strtolower(
                    $item->item_name . ' ' .
                    ($item->description ?? '') . ' ' .
                    ($item->category->name ?? '') . ' ' .
                    ($item->location->name ?? '') . ' ' .
                    ($item->user->name ?? '')
                ) }}
            "
        >

            <div class="found-item-card-inner">

                <div class="found-item-image">

                    @if($item->image)

                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->item_name }}"
                        >

                    @else

                        <div class="no-image">

                            <i class="bi bi-image"></i>

                        </div>

                    @endif

                </div>


                <div class="found-item-content">

                    <div class="found-item-title">

                        <h5>
                            {{ $item->item_name }}
                        </h5>

                        @if($item->status === 'awaiting_surrender')

                            <span class="found-badge warning">
                                Awaiting Surrender
                            </span>

                        @elseif($item->status === 'received')

                            <span class="found-badge info">
                                Received
                            </span>

                        @elseif($item->status === 'approved')

                            <span class="found-badge success">
                                Approved
                            </span>

                        @elseif($item->status === 'claimed')

                            <span class="found-badge primary">
                                Claimed
                            </span>

                        @elseif($item->status === 'rejected')

                            <span class="found-badge danger">
                                Rejected
                            </span>

                        @else

                            <span class="found-badge">
                                {{ ucfirst($item->status) }}
                            </span>

                        @endif

                    </div>


                    <div class="found-item-details">

                        <div class="detail-item">

                            <div class="detail-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            <div>

                                <small>
                                    Reported By
                                </small>

                                <p>
                                    {{ $item->user->name ?? 'Unknown' }}
                                </p>

                            </div>

                        </div>


                        <div class="detail-item">

                            <div class="detail-icon">
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


                        <div class="detail-item">

                            <div class="detail-icon">
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


                        <div class="detail-item">

                            <div class="detail-icon">
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


                    <div class="claim-button-wrapper">

                        @if(
                            $item->status === 'approved' &&
                            $item->user_id != auth()->id()
                        )

                            <a
                                href="{{ route(
                                    'faculty.claim-create',
                                    $item->id
                                ) }}"
                                class="claim-button"
                            >

                                <span>
                                    <i class="bi bi-hand-index-thumb"></i>
                                    Claim This Item
                                </span>

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        @elseif($item->user_id == auth()->id())

                            <div class="item-message">

                                <i class="bi bi-person-check"></i>

                                <span>
                                    You reported this item.
                                </span>

                            </div>

                        @elseif($item->status === 'claimed')

                            <div class="item-message">

                                <i class="bi bi-check-circle"></i>

                                <span>
                                    This item has already been claimed.
                                </span>

                            </div>

                        @else

                            <div class="item-message">

                                <i class="bi bi-hourglass-split"></i>

                                <span>
                                    This item is not available for claiming yet.
                                </span>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="empty-state">

                <div class="empty-icon">
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


    <div
        id="noSearchResults"
        class="col-12"
        style="display: none;"
    >

        <div class="empty-state">

            <div class="empty-icon">
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


<style>

.search-card {
    padding: 16px 20px;
    border: 1px solid #edf0f2;
    background: #ffffff;
}

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.search-wrapper i {
    position: absolute;
    left: 16px;
    color: #8a949e;
    font-size: 15px;
    z-index: 2;
}

.search-input {
    width: 100%;
    height: 46px;
    border: 1px solid #e4e8eb;
    border-radius: 12px;
    padding: 0 16px 0 43px;
    font-size: 12px;
    color: #303943;
    background: #fafbfc;
    outline: none;
    transition: 0.2s ease;
}

.search-input::placeholder {
    color: #9aa3ad;
}

.search-input:focus {
    border-color: #365c5a;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.08);
}


.found-item-card {
    display: flex;
}


.found-item-card-inner {
    width: 100%;
    height: 100%;
    min-height: 525px;
    background: #ffffff;
    border: 1px solid #edf0f2;
    border-radius: 18px;
    padding: 14px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 18px rgba(31, 41, 55, 0.05);
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.found-item-card-inner:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(31, 41, 55, 0.10);
}


.found-item-image {
    width: 100%;
    height: 205px;
    flex-shrink: 0;
    background: #f6f8f9;
    border-radius: 14px;
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

.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aab2ba;
    font-size: 48px;
}


.found-item-content {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 17px 4px 3px;
}


.found-item-title {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 17px;
}


.found-item-title h5 {
    margin: 0;
    color: #26313a;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.35;
    word-break: break-word;
}


.found-badge {
    flex-shrink: 0;
    max-width: 125px;
    text-align: center;
    background: #f0f2f4;
    color: #66717c;
    border-radius: 20px;
    padding: 5px 9px;
    font-size: 8px;
    font-weight: 700;
    line-height: 1.2;
}


.found-badge.warning {
    background: #fff3cd;
    color: #856404;
}


.found-badge.info {
    background: #dff3f8;
    color: #267080;
}


.found-badge.success {
    background: #e8f3ef;
    color: #397566;
}


.found-badge.primary {
    background: #e8eef8;
    color: #42628f;
}


.found-badge.danger {
    background: #fde8e8;
    color: #a94442;
}


.found-item-details {
    display: flex;
    flex-direction: column;
    gap: 11px;
}


.detail-item {
    display: flex;
    align-items: center;
    gap: 11px;
}


.detail-icon {
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    border-radius: 9px;
    background: #f1f6f5;
    color: #365c5a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
}


.detail-item small {
    display: block;
    margin-bottom: 2px;
    color: #9aa3ad;
    font-size: 9px;
    font-weight: 500;
}


.detail-item p {
    margin: 0;
    color: #46515b;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.3;
}


.claim-button-wrapper {
    margin-top: auto;
    padding-top: 18px;
}


.claim-button {
    width: 100%;
    min-height: 42px;
    padding: 0 14px;
    border-radius: 11px;
    background: #365c5a;
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 11px;
    font-weight: 600;
    transition: 0.2s ease;
}


.claim-button span {
    display: flex;
    align-items: center;
    gap: 7px;
}


.claim-button > i {
    font-size: 13px;
    transition: transform 0.2s ease;
}


.claim-button:hover {
    background: #2d4e4c;
    color: #ffffff;
}


.claim-button:hover > i {
    transform: translateX(3px);
}


.item-message {
    width: 100%;
    min-height: 42px;
    padding: 8px 12px;
    border-radius: 11px;
    background: #f7f8f9;
    border: 1px solid #edf0f2;
    color: #8a949e;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    text-align: center;
    font-size: 10px;
    font-weight: 500;
    line-height: 1.3;
}


.item-message i {
    font-size: 13px;
    flex-shrink: 0;
}


.empty-state {
    background: #ffffff;
    border: 1px solid #edf0f2;
    border-radius: 18px;
    padding: 55px 25px;
    text-align: center;
    box-shadow: 0 5px 18px rgba(31, 41, 55, 0.04);
}


.empty-icon {
    width: 62px;
    height: 62px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: #f1f6f5;
    color: #365c5a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 27px;
}


.empty-state h5 {
    color: #303943;
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 7px;
}


.empty-state p {
    color: #9099a3;
    font-size: 11px;
    margin: 0;
}


@media (max-width: 767px) {

    .found-item-card-inner {
        min-height: auto;
    }

    .found-item-image {
        height: 220px;
    }

    .found-item-title h5 {
        font-size: 15px;
    }

}


@media (min-width: 1200px) {

    .found-item-image {
        height: 205px;
    }

}

</style>


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