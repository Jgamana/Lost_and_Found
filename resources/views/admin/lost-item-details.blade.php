@extends('layouts.app')

@section('title', 'Lost Item Details')
@section('page-title', 'Lost Item Details')

@section('content')

<div class="welcome-section">

    <h1 class="welcome-title">
        Lost Item Details
    </h1>

    <p class="welcome-text">
        View the complete information for this lost item report.
    </p>

</div>


<div class="row g-4">

    <div class="col-lg-5">

        <div class="modern-card">

            @if ($lostItem->image)

                <img
                    src="{{ asset('storage/' . $lostItem->image) }}"
                    alt="{{ $lostItem->item_name }}"
                    class="img-fluid rounded-4 w-100"
                    style="max-height: 400px; object-fit: cover;"
                >

            @else

                <div
                    class="d-flex align-items-center justify-content-center bg-light rounded-4"
                    style="height: 350px;"
                >

                    <div class="text-center text-muted">

                        <i class="bi bi-image fs-1"></i>

                        <p class="mt-2 mb-0">
                            No image uploaded
                        </p>

                    </div>

                </div>

            @endif

        </div>

    </div>


    <div class="col-lg-7">

        <div class="modern-card">

            <div class="d-flex justify-content-between align-items-start mb-4">

                <div>

                    <h3 class="fw-bold mb-1">
                        {{ $lostItem->item_name }}
                    </h3>

                    <p class="text-muted mb-0">
                        Lost Item Report #{{ $lostItem->id }}
                    </p>

                </div>


                @if ($lostItem->status === 'reported')

                    <span class="badge bg-warning text-dark">
                        Reported
                    </span>

                @elseif ($lostItem->status === 'resolved')

                    <span class="badge bg-success">
                        Resolved
                    </span>

                @elseif ($lostItem->status === 'claimed')

                    <span class="badge bg-primary">
                        Claimed
                    </span>

                @else

                    <span class="badge bg-secondary">
                        {{ ucfirst($lostItem->status) }}
                    </span>

                @endif

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Reported By
                    </small>

                    <strong>
                        {{ $lostItem->user->name ?? 'Unknown' }}
                    </strong>

                </div>


                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Email
                    </small>

                    <strong>
                        {{ $lostItem->user->email ?? 'Unknown' }}
                    </strong>

                </div>


                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Category
                    </small>

                    <strong>
                        {{ $lostItem->custom_category ?? $lostItem->category->name ?? 'Unknown' }}
                    </strong>

                </div>


                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Location
                    </small>

                    <strong>
                        {{ $lostItem->custom_location ?? $lostItem->location->name ?? 'Unknown' }}
                    </strong>

                </div>


                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Lost Date
                    </small>

                    <strong>
                        {{ \Carbon\Carbon::parse($lostItem->lost_date)->format('F d, Y') }}
                    </strong>

                </div>


                <div class="col-md-6">

                    <small class="text-muted d-block">
                        Report Created
                    </small>

                    <strong>
                        {{ $lostItem->created_at->format('F d, Y h:i A') }}
                    </strong>

                </div>

            </div>


            <hr class="my-4">


            <div>

                <small class="text-muted d-block mb-2">
                    Description
                </small>

                <p class="mb-0">
                    {{ $lostItem->description }}
                </p>

            </div>


            <div class="d-flex gap-2 mt-4">

                <a
                    href="{{ route('admin.lost-items') }}"
                    class="btn btn-light border"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Back

                </a>


                <form
                    action="{{ route('admin.lost-item-delete', $lostItem->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this lost item report?');"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >

                        <i class="bi bi-trash me-1"></i>

                        Delete Report

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection