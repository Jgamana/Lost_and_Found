@extends('layouts.app')

@section('title', 'Lost Items')
@section('page-title', 'Lost Items')

@section('content')

<div class="welcome-section">

    <h1 class="welcome-title">
        Reported Lost Items
    </h1>

    <p class="welcome-text">
        Browse all lost item reports submitted by students and faculty.
    </p>

</div>


<div class="modern-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h5 class="fw-bold mb-1">
                Lost Item Reports
            </h5>

            <p class="text-muted small mb-0">
                {{ $lostItems->count() }} report(s) found.
            </p>

        </div>

    </div>


    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>
                        Item
                    </th>

                    <th>
                        Reported By
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Location
                    </th>

                    <th>
                        Lost Date
                    </th>

                    <th>
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($lostItems as $item)

                    <tr>

                        <td>
                            <strong>
                                {{ $item->item_name }}
                            </strong>
                        </td>


                        <td>
                            {{ $item->user->name ?? 'Unknown' }}
                        </td>


                        <td>
                            {{ $item->custom_category ?? $item->category->name ?? 'Unknown' }}
                        </td>


                        <td>
                            {{ $item->custom_location ?? $item->location->name ?? 'Unknown' }}
                        </td>


                        <td>

                            {{ \Carbon\Carbon::parse($item->lost_date)->format('F d, Y') }}

                        </td>


                        <td>

                            @if ($item->status === 'reported')

                                <span class="badge bg-warning text-dark">
                                    Reported
                                </span>

                            @elseif ($item->status === 'resolved')

                                <span class="badge bg-success">
                                    Resolved
                                </span>

                            @elseif ($item->status === 'claimed')

                                <span class="badge bg-primary">
                                    Claimed
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ ucfirst($item->status) }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5"
                        >

                            <i class="bi bi-search fs-1 text-muted"></i>

                            <p class="text-muted mt-3 mb-0">
                                No lost item reports found.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection