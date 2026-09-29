@extends('layouts.app')

@section('title', 'Found Report Details')

@section('content')



<div class="page-heading mb-4">
    <div class="page-label">Found Items</div>
    <h1>Found Report Details</h1>
    <p>View the details of your found item report.</p>
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
                    <p>Information about this found item.</p>
                </div>
            </div>

            @if($foundItem->image)
                <div class="text-center mb-4">
                    <img
                        src="{{ asset('storage/' . $foundItem->image) }}"
                        alt="{{ $foundItem->item_name }}"
                        style="
                            max-width: 100%;
                            max-height: 350px;
                            object-fit: contain;
                            border-radius: 12px;
                        "
                    >
                </div>
            @endif

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="text-muted small">Item Name</label>
                    <div class="fw-semibold">
                        {{ $foundItem->item_name }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Category</label>
                    <div class="fw-semibold">
                        {{ $foundItem->category->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Location</label>
                    <div class="fw-semibold">
                        {{ $foundItem->location->name ?? 'N/A' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Date Found</label>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($foundItem->found_date)->format('M d, Y') }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Status</label>
                    <div>
                        <span class="badge bg-secondary">
                            {{ ucfirst($foundItem->status) }}
                        </span>
                    </div>
                </div>

                <div class="col-12">
                    <label class="text-muted small">Description</label>
                    <div class="mt-1">
                        {{ $foundItem->description }}
                    </div>
                </div>

            </div>

            <div class="d-flex gap-2 justify-content-end mt-4">

                    <a href="{{ route('student.my-reports') }}"
                    class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to My Reports
                    </a>
                   <a href="{{ route('student.found-report-edit', $foundItem->id) }}"
                    class="btn btn-dark">
                        <i class="bi bi-pencil me-1"></i>
                        Edit Report
                    </a>

            </div>

        </div>

    </div>
</div>

@endsection