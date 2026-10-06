@extends('layouts.app')

@section('title', 'Found Items')
@section('page-title', 'Found Items')

@section('content')

<style>

.faculty-found-page {
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

.faculty-search-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 15px;
    margin-bottom: 22px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.faculty-search-wrapper {
    position: relative;
}

.faculty-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 15px;
    z-index: 2;
}

.faculty-search-input {
    width: 100%;
    height: 46px;
    border: 1px solid var(--border);
    border-radius: 11px;
    padding: 0 14px 0 40px;
    background: #fafcfc;
    color: var(--text);
    font-size: 13px;
    outline: none;
    transition: 0.2s ease;
}

.faculty-search-input::placeholder {
    color: #9aa9a7;
}

.faculty-search-input:focus {
    background: #ffffff;
    border-color: #b8d0cc;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

.faculty-found-card {
    height: 100%;
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 14px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    transition: 0.2s ease;
}

.faculty-found-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(41, 73, 71, 0.09);
}

.faculty-found-image {
    width: 100%;
    height: 210px;
    background: #f5f8f7;
    border-radius: 15px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.faculty-found-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.faculty-no-image {
    color: #a9b7b5;
    font-size: 48px;
}

.faculty-found-content {
    display: flex;
    flex-direction: column;
    min-height: 300px;
    padding: 18px 4px 3px;
}

.faculty-found-title {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 18px;
}

.faculty-found-title h5 {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    line-height: 1.35;
    margin: 0;
    word-break: break-word;
}

.faculty-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    max-width: 125px;
    padding: 6px 9px;
    border-radius: 20px;
    font-size: 9px;
    font-weight: 700;
    line-height: 1.2;
    text-align: center;
}

.faculty-status-warning {
    background: #fbf2d7;
    color: #967414;
}

.faculty-status-info {
    background: #e4f2f3;
    color: #39777b;
}

.faculty-status-success {
    background: #e5f3ea;
    color: #43835a;
}

.faculty-status-primary {
    background: #e7eef8;
    color: #42628f;
}

.faculty-status-danger {
    background: #fff0f0;
    color: #bd5555;
}

.faculty-status-default {
    background: #eef2f1;
    color: #64716f;
}

.faculty-details {
    display: flex;
    flex-direction: column;
    gap: 11px;
}

.faculty-detail {
    display: flex;
    align-items: center;
    gap: 11px;
}

.faculty-detail-icon {
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

.faculty-detail-label {
    display: block;
    color: var(--muted);
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 2px;
}

.faculty-detail-value {
    color: var(--text);
    font-size: 12px;
    font-weight: 600;
    line-height: 1.3;
}

.faculty-claim-wrapper {
    margin-top: auto;
    padding-top: 20px;
}

.faculty-claim-button {
    width: 100%;
    min-height: 44px;
    padding: 0 14px;
    border-radius: 11px;
    background: var(--teal);
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.faculty-claim-button span {
    display: flex;
    align-items: center;
    gap: 7px;
}

.faculty-claim-button > i {
    transition: transform 0.2s ease;
}

.faculty-claim-button:hover {
    background: var(--teal-dark);
    color: #ffffff;
}

.faculty-claim-button:hover > i {
    transform: translateX(3px);
}

.faculty-item-message {
    width: 100%;
    min-height: 44px;
    padding: 9px 12px;
    border-radius: 11px;
    background: #f7f9f8;
    border: 1px solid #edf2f1;
    color: var(--muted);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    text-align: center;
    font-size: 11px;
    line-height: 1.35;
}

.faculty-item-message i {
    color: var(--teal);
    font-size: 14px;
    flex-shrink: 0;
}

.faculty-empty-state {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 60px 25px;
    text-align: center;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
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

    .faculty-found-image {
        height: 220px;
    }

    .faculty-found-content {
        min-height: auto;
    }

}

</style>


<div class="faculty-found-page">

    <div class="faculty-page-header">

        <div>

            <div class="faculty-page-label">
                <i class="bi bi-box-seam me-1"></i>
                Lost & Found
            </div>

            <h1 class="faculty-page-title">
                Found Items
            </h1>

            <p class="faculty-page-description">
                Browse items that have been reported as found.
            </p>

        </div>

    </div>


    <div class="faculty-search-card">

        <div class="faculty-search-wrapper">

            <i class="bi bi-search faculty-search-icon"></i>

            <input
                type="text"
                id="foundItemSearch"
                class="faculty-search-input"
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
                data-search="{{ strtolower(
                    $item->item_name . ' ' .
                    ($item->description ?? '') . ' ' .
                    ($item->category->name ?? '') . ' ' .
                    ($item->location->name ?? '') . ' ' .
                    ($item->user->name ?? '')
                ) }}"
            >

                <div class="faculty-found-card">

                    <div class="faculty-found-image">

                        @if($item->image)

                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->item_name }}"
                            >

                        @else

                            <div class="faculty-no-image">
                                <i class="bi bi-image"></i>
                            </div>

                        @endif

                    </div>


                    <div class="faculty-found-content">

                        <div class="faculty-found-title">

                            <h5>
                                {{ $item->item_name }}
                            </h5>


                            @if($item->status === 'awaiting_surrender')

                                <span class="faculty-status faculty-status-warning">
                                    Awaiting Surrender
                                </span>

                            @elseif($item->status === 'received')

                                <span class="faculty-status faculty-status-info">
                                    Received
                                </span>

                            @elseif($item->status === 'approved')

                                <span class="faculty-status faculty-status-success">
                                    Approved
                                </span>

                            @elseif($item->status === 'claimed')

                                <span class="faculty-status faculty-status-primary">
                                    Claimed
                                </span>

                            @elseif($item->status === 'rejected')

                                <span class="faculty-status faculty-status-danger">
                                    Rejected
                                </span>

                            @else

                                <span class="faculty-status faculty-status-default">
                                    {{ ucfirst($item->status) }}
                                </span>

                            @endif

                        </div>


                        <div class="faculty-details">

                            <div class="faculty-detail">

                                <div class="faculty-detail-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div>

                                    <span class="faculty-detail-label">
                                        Reported By
                                    </span>

                                    <div class="faculty-detail-value">
                                        {{ $item->user->name ?? 'Unknown' }}
                                    </div>

                                </div>

                            </div>


                            <div class="faculty-detail">

                                <div class="faculty-detail-icon">
                                    <i class="bi bi-grid"></i>
                                </div>

                                <div>

                                    <span class="faculty-detail-label">
                                        Category
                                    </span>

                                    <div class="faculty-detail-value">
                                        {{ $item->category->name ?? 'N/A' }}
                                    </div>

                                </div>

                            </div>


                            <div class="faculty-detail">

                                <div class="faculty-detail-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>

                                <div>

                                    <span class="faculty-detail-label">
                                        Location
                                    </span>

                                    <div class="faculty-detail-value">
                                        {{ $item->location->name ?? 'N/A' }}
                                    </div>

                                </div>

                            </div>


                            <div class="faculty-detail">

                                <div class="faculty-detail-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>

                                <div>

                                    <span class="faculty-detail-label">
                                        Date Found
                                    </span>

                                    <div class="faculty-detail-value">
                                        {{ \Carbon\Carbon::parse($item->found_date)->format('M d, Y') }}
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="faculty-claim-wrapper">

                            @if(
                                $item->status === 'approved' &&
                                $item->user_id != auth()->id()
                            )

                                <a
                                    href="{{ route('faculty.claim-create', $item->id) }}"
                                    class="faculty-claim-button"
                                >

                                    <span>
                                        <i class="bi bi-hand-index-thumb"></i>
                                        Claim This Item
                                    </span>

                                    <i class="bi bi-arrow-right"></i>

                                </a>

                            @elseif($item->user_id == auth()->id())

                                <div class="faculty-item-message">

                                    <i class="bi bi-person-check"></i>

                                    <span>
                                        You reported this item.
                                    </span>

                                </div>

                            @elseif($item->status === 'claimed')

                                <div class="faculty-item-message">

                                    <i class="bi bi-check-circle"></i>

                                    <span>
                                        This item has already been claimed.
                                    </span>

                                </div>

                            @else

                                <div class="faculty-item-message">

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

                <div class="faculty-empty-state">

                    <div class="faculty-empty-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <h5 class="faculty-empty-title">
                        No Found Items Available
                    </h5>

                    <p class="faculty-empty-text">
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

            <div class="faculty-empty-state">

                <div class="faculty-empty-icon">
                    <i class="bi bi-search"></i>
                </div>

                <h5 class="faculty-empty-title">
                    No Matching Items
                </h5>

                <p class="faculty-empty-text">
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