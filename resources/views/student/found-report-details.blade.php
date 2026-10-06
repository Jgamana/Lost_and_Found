@extends('layouts.app')

@section('title', 'Found Report Details')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">Found Items</div>

    <h1>Found Report Details</h1>

    <p>
        View the details of your found item report.
    </p>
</div>

<div class="row justify-content-center">

    <div class="col-12 col-xl-9">

        <div class="modern-card p-4">

            <div class="section-header mb-4">

                <div>

                    <h5>
                        <i class="bi bi-box-seam me-2"></i>
                        {{ $foundItem->item_name }}
                    </h5>

                    <p>
                        Information about this found item.
                    </p>

                </div>

            </div>


            @if($foundItem->image)

                <div class="found-image-wrapper mb-4">

                    <img
                        src="{{ asset('storage/' . $foundItem->image) }}"
                        alt="{{ $foundItem->item_name }}"
                        class="found-report-image"
                    >

                </div>

            @else

                <div class="found-image-wrapper no-image-wrapper mb-4">

                    <div class="no-image-content">

                        <i class="bi bi-image"></i>

                        <span>
                            No image uploaded
                        </span>

                    </div>

                </div>

            @endif


            <div class="report-details">

                <div class="detail-box">

                    <div class="detail-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>

                        <span class="detail-label">
                            Item Name
                        </span>

                        <div class="detail-value">
                            {{ $foundItem->item_name }}
                        </div>

                    </div>

                </div>


                <div class="detail-box">

                    <div class="detail-icon">
                        <i class="bi bi-grid"></i>
                    </div>

                    <div>

                        <span class="detail-label">
                            Category
                        </span>

                        <div class="detail-value">
                            {{ $foundItem->category->name ?? 'N/A' }}
                        </div>

                    </div>

                </div>


                <div class="detail-box">

                    <div class="detail-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div>

                        <span class="detail-label">
                            Location
                        </span>

                        <div class="detail-value">
                            {{ $foundItem->location->name ?? 'N/A' }}
                        </div>

                    </div>

                </div>


                <div class="detail-box">

                    <div class="detail-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>

                    <div>

                        <span class="detail-label">
                            Date Found
                        </span>

                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse($foundItem->found_date)->format('M d, Y') }}
                        </div>

                    </div>

                </div>


                <div class="detail-box">

                    <div class="detail-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>

                        <span class="detail-label">
                            Status
                        </span>

                        <div class="mt-1">

                            @if($foundItem->status === 'awaiting_surrender')

                                <span class="status-badge status-awaiting">
                                    Awaiting Surrender
                                </span>

                            @elseif($foundItem->status === 'received')

                                <span class="status-badge status-received">
                                    Received
                                </span>

                            @elseif($foundItem->status === 'approved')

                                <span class="status-badge status-approved">
                                    Approved
                                </span>

                            @elseif($foundItem->status === 'claimed')

                                <span class="status-badge status-claimed">
                                    Claimed
                                </span>

                            @elseif($foundItem->status === 'rejected')

                                <span class="status-badge status-rejected">
                                    Rejected
                                </span>

                            @else

                                <span class="status-badge status-default">
                                    {{ ucfirst($foundItem->status) }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            <div class="description-box mt-4">

                <div class="description-heading">

                    <i class="bi bi-card-text"></i>

                    <span>
                        Description
                    </span>

                </div>

                <p>
                    {{ $foundItem->description }}
                </p>

            </div>


            <div class="report-actions">

                <a
                    href="{{ route('student.my-reports') }}"
                    class="back-button"
                >

                    <i class="bi bi-arrow-left"></i>

                    Back to My Reports

                </a>


                <a
                    href="{{ route('student.found-report-edit', $foundItem->id) }}"
                    class="edit-button"
                >

                    <i class="bi bi-pencil"></i>

                    Edit Report

                </a>

            </div>

        </div>

    </div>

</div>


<style>

.report-details {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
}

.detail-box {
    min-height: 76px;
    padding: 14px 15px;
    border: 1px solid #e4eceb;
    border-radius: 13px;
    background: #fbfcfc;
    display: flex;
    align-items: center;
    gap: 12px;
}

.detail-icon {
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #edf5f3;
    color: #365c5a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.detail-label {
    display: block;
    color: #7b8d8b;
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 3px;
}

.detail-value {
    color: #263b3a;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.35;
    word-break: break-word;
}

.found-image-wrapper {
    width: 100%;
    height: 340px;
    background: #f5f8f7;
    border: 1px solid #e4eceb;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.found-report-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.no-image-wrapper {
    background: #f7f9f9;
}

.no-image-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 9px;
    color: #9aa9a7;
}

.no-image-content i {
    font-size: 42px;
}

.no-image-content span {
    font-size: 11px;
    font-weight: 600;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
}

.status-awaiting {
    background: #fff6dc;
    color: #967414;
}

.status-received {
    background: #e8f0f7;
    color: #4d718d;
}

.status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.status-claimed {
    background: #e8eef8;
    color: #506d9a;
}

.status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.status-default {
    background: #eef2f1;
    color: #64716f;
}

.description-box {
    padding: 17px 18px;
    border: 1px solid #e4eceb;
    border-radius: 14px;
    background: #fbfcfc;
}

.description-heading {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #365c5a;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 9px;
}

.description-box p {
    color: #536260;
    font-size: 12px;
    line-height: 1.65;
    margin: 0;
    white-space: pre-line;
}

.report-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 9px;
    margin-top: 22px;
}

.back-button,
.edit-button {
    min-height: 40px;
    padding: 0 15px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    transition: 0.2s ease;
}

.back-button {
    background: #f5f7f7;
    border: 1px solid #e1e8e7;
    color: #667674;
}

.back-button:hover {
    background: #edf1f0;
    color: #365c5a;
}

.edit-button {
    background: #365c5a;
    border: 1px solid #365c5a;
    color: #ffffff;
}

.edit-button:hover {
    background: #294947;
    border-color: #294947;
    color: #ffffff;
}

@media (max-width: 767px) {

    .report-details {
        grid-template-columns: 1fr;
    }

    .found-image-wrapper {
        height: 260px;
    }

    .report-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .back-button,
    .edit-button {
        justify-content: center;
        width: 100%;
    }

}

</style>

@endsection