@extends('layouts.app')

@section('title', 'My Claims')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Claims
    </div>

    <h1>
        My Claims
    </h1>

    <p>
        View the found items you have submitted claims for.
    </p>

</div>


<div class="modern-card">

    <div class="section-header mb-4">

        <div>

            <h5>
                <i class="bi bi-clipboard-check me-2"></i>
                My Submitted Claims
            </h5>

            <p>
                Track the status of your claims and release schedule.
            </p>

        </div>

    </div>


    @if($claims->count() > 0)

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>
                            Item
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Location
                        </th>

                        <th>
                            Date Found
                        </th>

                        <th>
                            Claim Status
                        </th>

                        <th>
                            Release Schedule
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($claims as $claim)

                        <tr>

                            {{-- Item --}}
                            <td>

                                <div class="fw-semibold">

                                    {{ $claim->foundItem->item_name ?? 'N/A' }}

                                </div>

                            </td>


                            {{-- Category --}}
                            <td>

                                {{ $claim->foundItem->category->name ?? 'N/A' }}

                            </td>


                            {{-- Location --}}
                            <td>

                                {{ $claim->foundItem->location->name ?? 'N/A' }}

                            </td>


                            {{-- Date Found --}}
                            <td>

                                @if($claim->foundItem)

                                    {{ \Carbon\Carbon::parse(
                                        $claim->foundItem->found_date
                                    )->format('M d, Y') }}

                                @else

                                    N/A

                                @endif

                            </td>


                            {{-- Claim Status --}}
                            <td>

                                @if($claim->status === 'pending')

                                    <span class="badge text-bg-warning">
                                        Pending
                                    </span>

                                @elseif($claim->status === 'approved')

                                    <span class="badge text-bg-success">
                                        Approved
                                    </span>

                                @elseif($claim->status === 'rejected')

                                    <span class="badge text-bg-danger">
                                        Rejected
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">

                                        {{ ucfirst($claim->status) }}

                                    </span>

                                @endif

                            </td>


                           {{-- Release Schedule --}}
                                <td>

                                    @if($claim->status === 'rejected')

                                        @if(
                                            $claim->release_date ||
                                            $claim->release_time ||
                                            $claim->release_location
                                        )

                                            <span class="text-danger small fw-semibold">
                                                <i class="bi bi-calendar-x me-1"></i>
                                                Schedule Cancelled
                                            </span>

                                        @else

                                            <span class="text-danger small fw-semibold">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Claim Cancelled
                                            </span>

                                        @endif


                                    @elseif(
                                        $claim->release_date &&
                                        $claim->release_time &&
                                        $claim->release_location
                                    )

                                        <div class="small">

                                            <div class="mb-1">
                                                <i class="bi bi-calendar-event me-1"></i>

                                                <strong>Date:</strong>

                                                {{ \Carbon\Carbon::parse(
                                                    $claim->release_date
                                                )->format('M d, Y') }}
                                            </div>

                                            <div class="mb-1">
                                                <i class="bi bi-clock me-1"></i>

                                                <strong>Time:</strong>

                                                {{ \Carbon\Carbon::parse(
                                                    $claim->release_time
                                                )->format('h:i A') }}
                                            </div>

                                            <div>
                                                <i class="bi bi-geo-alt me-1"></i>

                                                <strong>Location:</strong>

                                                {{ $claim->release_location }}
                                            </div>

                                        </div>


                                    @else

                                        <span class="text-muted small">
                                            Waiting for release schedule
                                        </span>

                                    @endif

                                </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


    @else

        {{-- No Claims --}}
        <div class="text-center py-5">

            <i
                class="bi bi-clipboard-x text-muted"
                style="font-size: 50px;"
            ></i>


            <h5 class="mt-3">

                No Claims Yet

            </h5>


            <p class="text-muted mb-4">

                You have not submitted any claims for found items.

            </p>


            <a
                href="{{ route('student.found-items') }}"
                class="btn btn-dark"
            >

                <i class="bi bi-box-seam me-1"></i>

                Browse Found Items

            </a>

        </div>

    @endif

</div>

@endsection