@extends('layouts.app')

@section('title', 'My Reports')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Lost & Found
    </div>

    <h1>
        My Reports
    </h1>

    <p>
        View the lost and found items you personally reported.
    </p>

</div>


{{-- SUCCESS MESSAGE --}}
@if(session('success'))

    <div class="alert alert-success">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

    </div>

@endif


{{-- ERROR MESSAGE --}}
@if(session('error'))

    <div class="alert alert-danger">

        <i class="bi bi-exclamation-circle me-2"></i>

        {{ session('error') }}

    </div>

@endif


<div class="row g-4">


    {{-- =========================
         LOST REPORTS
    ========================= --}}

    <div class="col-12">

        <div class="modern-card">

            <div class="section-header p-4 border-bottom">

                <div>

                    <h5 class="mb-1">

                        <i class="bi bi-search me-2"></i>

                        My Lost Reports

                    </h5>

                    <p class="mb-0">

                        Lost items you have personally reported.

                    </p>

                </div>


                <span class="badge bg-primary">

                    {{ $lostItems->count() }}

                </span>

            </div>


            @if($lostItems->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Item</th>

                                <th>Category</th>

                                <th>Location</th>

                                <th>Date Lost</th>

                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($lostItems as $item)

                                <tr>

                                    <td>

                                        <strong>
                                            {{ $item->item_name }}
                                        </strong>

                                    </td>


                                    <td>

                                        {{ $item->category->name ?? 'N/A' }}

                                    </td>


                                    <td>

                                        {{ $item->location->name ?? 'N/A' }}

                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse($item->lost_date)->format('M d, Y') }}

                                    </td>


                                    <td>

                                        @if($item->status === 'resolved')

                                            <span class="badge bg-success">
                                                Resolved
                                            </span>

                                        @elseif($item->status === 'reported')

                                            <span class="badge bg-warning text-dark">
                                                Reported
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center p-5">

                    <i
                        class="bi bi-search"
                        style="font-size: 40px; color: #adb5bd;"
                    ></i>

                    <h6 class="mt-3">
                        No lost reports yet
                    </h6>

                    <p class="text-muted mb-3">
                        You have not reported any lost items.
                    </p>

                    <a
                        href="{{ route('admin.report-lost') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-circle me-1"></i>

                        Report Lost Item

                    </a>

                </div>

            @endif

        </div>

    </div>



    {{-- =========================
         FOUND REPORTS
    ========================= --}}

    <div class="col-12">

        <div class="modern-card">

            <div class="section-header p-4 border-bottom">

                <div>

                    <h5 class="mb-1">

                        <i class="bi bi-box-seam me-2"></i>

                        My Found Reports

                    </h5>

                    <p class="mb-0">

                        Found items you have personally reported.

                    </p>

                </div>


                <span class="badge bg-success">

                    {{ $foundItems->count() }}

                </span>

            </div>


            @if($foundItems->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Item</th>

                                <th>Category</th>

                                <th>Location</th>

                                <th>Date Found</th>

                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($foundItems as $item)

                                <tr>

                                    <td>

                                        <strong>
                                            {{ $item->item_name }}
                                        </strong>

                                    </td>


                                    <td>

                                        {{ $item->category->name ?? 'N/A' }}

                                    </td>


                                    <td>

                                        {{ $item->location->name ?? 'N/A' }}

                                    </td>


                                    <td>

                                        {{ \Carbon\Carbon::parse($item->found_date)->format('M d, Y') }}

                                    </td>


                                    <td>

                                        @if($item->status === 'claimed')

                                            <span class="badge bg-dark">
                                                Claimed
                                            </span>

                                        @elseif($item->status === 'approved')

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        @elseif($item->status === 'received')

                                            <span class="badge bg-info text-dark">
                                                Received
                                            </span>

                                        @elseif($item->status === 'awaiting_surrender')

                                            <span class="badge bg-warning text-dark">
                                                Awaiting Surrender
                                            </span>

                                        @elseif($item->status === 'rejected')

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center p-5">

                    <i
                        class="bi bi-box-seam"
                        style="font-size: 40px; color: #adb5bd;"
                    ></i>

                    <h6 class="mt-3">
                        No found reports yet
                    </h6>

                    <p class="text-muted mb-3">
                        You have not reported any found items.
                    </p>

                    <a
                        href="{{ route('admin.report-found') }}"
                        class="btn btn-success"
                    >

                        <i class="bi bi-plus-circle me-1"></i>

                        Report Found Item

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection