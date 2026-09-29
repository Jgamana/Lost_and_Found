@extends('layouts.app')

@section('title', 'My Found Reports')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

<div class="page-heading mb-4">
    <div class="page-label">Found Items</div>
    <h1>My Found Reports</h1>
    <p>View the items you have reported as found.</p>
</div>

<div class="modern-card p-4">

    <div class="section-header mb-4">
        <div>
            <h5>
                <i class="bi bi-box-seam me-2"></i>
                Found Item Reports
            </h5>
            <p>List of your submitted found item reports.</p>
        </div>
    </div>

    @if($foundItems->count() > 0)

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Date Found</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($foundItems as $item)
                        <tr>

                            <td>
                                <strong>{{ $item->item_name }}</strong>
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
                                <span class="badge bg-secondary">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('student.found-report-details', $item->id) }}"
                                class="btn btn-sm btn-dark">
                                    <i class="bi bi-eye"></i>
                                    View
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else

        <div class="text-center py-5">

            <i class="bi bi-box-seam"
               style="font-size: 45px; color: #aaa;"></i>

            <h5 class="mt-3">No Found Reports Yet</h5>

            <p class="text-muted">
                You have not reported any found items yet.
            </p>

            <a href="{{ url('/student/report-found') }}"
               class="btn btn-dark">
                <i class="bi bi-plus-circle me-1"></i>
                Report Found Item
            </a>

        </div>

    @endif

</div>

@endsection