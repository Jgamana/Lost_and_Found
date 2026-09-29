@extends('layouts.app')

@section('title', 'Report Details')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">
        Lost & Found
    </div>

    <h1>Report Details</h1>

    <p>
        View the details of your lost item report.
    </p>
</div>

<div class="modern-card p-4">

    <div class="row">

        <!-- IMAGE -->
        <div class="col-md-5 mb-4">

            @if($lostItem->image)

                <img
                    src="{{ asset('storage/' . $lostItem->image) }}"
                    alt="{{ $lostItem->item_name }}"
                    class="img-fluid rounded"
                    style="width: 100%; max-height: 350px; object-fit: cover;"
                >

            @else

                <div class="text-center p-5 bg-light rounded">
                    <i
                        class="bi bi-image"
                        style="font-size: 60px;"
                    ></i>

                    <p class="mt-2 text-muted">
                        No image uploaded
                    </p>
                </div>

            @endif

        </div>

        <!-- DETAILS -->
        <div class="col-md-7">

            <h3 class="mb-4">
                {{ $lostItem->item_name }}
            </h3>

            <p>
                <strong>Category:</strong>

                @if($lostItem->category)
                    {{ $lostItem->category->name }}
                @elseif($lostItem->custom_category)
                    {{ $lostItem->custom_category }}
                @else
                    —
                @endif
            </p>

            <p>
                <strong>Location Lost:</strong>
                {{ $lostItem->location->name ?? '—' }}
            </p>

            <p>
                <strong>Date Lost:</strong>
                {{ \Carbon\Carbon::parse($lostItem->lost_date)->format('M d, Y') }}
            </p>

            <p>
                <strong>Status:</strong>

                <span class="badge bg-secondary">
                    {{ ucfirst($lostItem->status) }}
                </span>
            </p>

            <hr>

            <h6>Description</h6>

            <p class="text-muted">
                {{ $lostItem->description }}
            </p>

            <div class="mt-4">

                                    <a
                        href="{{ route('student.my-reports') }}"
                        class="btn btn-light"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to My Reports
                    </a>

                    <a
                        href="{{ route('student.report-edit', $lostItem->id) }}"
                        class="btn btn-dark"
                    >
                        <i class="bi bi-pencil me-1"></i>
                        Edit Report
                    </a>

                    <a
                        href="{{ route('student.report-matches', $lostItem->id) }}"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-stars me-1"></i>
                        Find Possible Matches
                    </a>
                    <form
                        action="{{ route('student.report-delete', $lostItem->id) }}"
                        method="POST"
                        style="display: inline;"
                        onsubmit="return confirm('Are you sure you want to delete this report?');"
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