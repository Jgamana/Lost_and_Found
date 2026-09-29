@extends('layouts.app')

@section('title', 'Possible Matches')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">
        Lost & Found
    </div>

    <h1>Possible Matches</h1>

    <p>
        These found items may match your lost item based on their details.
    </p>
</div>

{{-- Lost Item --}}
<div class="modern-card p-4 mb-4">

    <h5 class="mb-3">
        <i class="bi bi-search me-2"></i>
        Your Lost Item
    </h5>

    <div class="row">

        <div class="col-md-6">
            <p class="mb-2">
                <strong>Item:</strong>
                {{ $lostItem->item_name }}
            </p>

            <p class="mb-2">
                <strong>Category:</strong>
                {{ $lostItem->category->name ?? 'Custom Category' }}
            </p>

            <p class="mb-0">
                <strong>Location:</strong>
                {{ $lostItem->location->name ?? $lostItem->custom_location ?? 'Not specified' }}
            </p>
        </div>

        <div class="col-md-6">
            <p class="mb-0">
                <strong>Description:</strong><br>
                {{ $lostItem->description }}
            </p>
        </div>

    </div>

</div>


{{-- Matches --}}
<div class="modern-card p-4">

    <div class="section-header mb-4">
        <div>
            <h5>
                <i class="bi bi-stars me-2"></i>
                Recommended Matches
            </h5>

            <p>
                Found items with a match score of 40% or higher.
            </p>
        </div>
    </div>


    @if($matches->count() > 0)

        <div class="row g-4">

            @foreach($matches as $foundItem)

                <div class="col-12 col-md-6">

                    <div class="border rounded-4 p-3 h-100">

                        {{-- Image --}}
                        @if($foundItem->image)

                            <img
                                src="{{ asset('storage/' . $foundItem->image) }}"
                                alt="{{ $foundItem->item_name }}"
                                class="img-fluid rounded-3 mb-3"
                                style="width: 100%; height: 200px; object-fit: cover;"
                            >

                        @else

                            <div
                                class="bg-light rounded-3 mb-3 d-flex align-items-center justify-content-center"
                                style="height: 200px;"
                            >
                                <i class="bi bi-image fs-1 text-secondary"></i>
                            </div>

                        @endif


                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <h5 class="mb-0">
                                {{ $foundItem->item_name }}
                            </h5>

                            <span class="badge bg-dark">
                                {{ $foundItem->match_score }}% Match
                            </span>

                        </div>


                        <p class="mb-2">
                            <strong>Category:</strong>
                            {{ $foundItem->category->name ?? 'Not specified' }}
                        </p>


                        <p class="mb-2">
                            <strong>Location:</strong>
                            {{ $foundItem->location->name ?? 'Not specified' }}
                        </p>


                        <p class="mb-3">
                            <strong>Description:</strong><br>
                            {{ $foundItem->description }}
                        </p>


                        <p class="text-muted small mb-0">

                            <i class="bi bi-calendar3 me-1"></i>

                            Found on
                            {{ \Carbon\Carbon::parse($foundItem->found_date)->format('F d, Y') }}

                        </p>

                        <a
                            href="{{ route('student.claim-create', $foundItem->id) }}"
                            class="btn btn-dark w-100 mt-3"
                        >
                            <i class="bi bi-hand-index-thumb me-1"></i>
                            Claim This Item
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center py-5">

            <i class="bi bi-search fs-1 text-secondary"></i>

            <h5 class="mt-3">
                No possible matches found
            </h5>

            <p class="text-muted mb-0">
                We couldn't find any found items that closely match your report yet.
            </p>

        </div>

    @endif

</div>

@endsection