@extends('layouts.app')

@section('title', 'My Reports')
@section('page-title', 'My Reports')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Lost & Found
    </div>

    <h1>My Reports</h1>

    <p>
        View the lost and found items you have reported.
    </p>

</div>


<div class="modern-card p-4">

    {{-- Report Type Buttons --}}
    <div class="d-flex gap-2 mb-4">

        <button
            type="button"
            class="btn btn-dark"
            id="lostBtn"
            onclick="showReports('lost')"
        >
            <i class="bi bi-search me-1"></i>
            Lost
        </button>


        <button
            type="button"
            class="btn btn-outline-dark"
            id="foundBtn"
            onclick="showReports('found')"
        >
            <i class="bi bi-box-seam me-1"></i>
            Found
        </button>

    </div>


    {{-- LOST REPORTS --}}
    <div id="lostReports">

        <div class="section-header mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h5>
                        <i class="bi bi-search me-2"></i>
                        My Lost Item Reports
                    </h5>

                    <p>
                        Here are the items you reported as lost.
                    </p>

                </div>


                {{-- REPORT LOST ITEM BUTTON --}}
                <a
                    href="{{ route('faculty.report-lost') }}"
                    class="btn btn-dark"
                >
                    <i class="bi bi-plus-circle me-1"></i>
                    Report Lost Item
                </a>

            </div>

        </div>


        @if($lostItems->count() > 0)

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
                                Date Lost
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Action
                            </th>

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

                                    @if($item->category)

                                        {{ $item->category->name }}

                                    @elseif($item->custom_category)

                                        {{ $item->custom_category }}

                                    @else

                                        —

                                    @endif

                                </td>


                                <td>

                                    @if($item->location)

                                        {{ $item->location->name }}

                                    @elseif($item->custom_location)

                                        {{ $item->custom_location }}

                                    @else

                                        —

                                    @endif

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

                                    @elseif($item->status === 'claimed')

                                        <span class="badge bg-primary">
                                            Claimed
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <a
                                        href="{{ route('student.report-details', $item->id) }}"
                                        class="btn btn-sm btn-dark"
                                    >

                                        <i class="bi bi-eye me-1"></i>

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

                <i
                    class="bi bi-file-earmark-x"
                    style="font-size: 50px;"
                ></i>


                <h5 class="mt-3">
                    No Lost Reports Yet
                </h5>


                <p class="text-muted">
                    You haven't reported any lost items yet.
                </p>


                <a
                    href="{{ route('faculty.report-lost') }}"
                    class="btn btn-dark px-4"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Report Lost Item

                </a>

            </div>

        @endif

    </div>


    {{-- FOUND REPORTS --}}
    <div
        id="foundReports"
        style="display: none;"
    >

        <div class="section-header mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h5>
                        <i class="bi bi-box-seam me-2"></i>
                        My Found Item Reports
                    </h5>

                    <p>
                        Here are the items you reported as found.
                    </p>

                </div>


                {{-- REPORT FOUND ITEM BUTTON --}}
                <a
                    href="{{ route('faculty.report-found') }}"
                    class="btn btn-dark"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Report Found Item

                </a>

            </div>

        </div>


        @if($foundItems->count() > 0)

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
                                Status
                            </th>

                            <th>
                                Action
                            </th>

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
                                    {{ $item->category->name ?? '—' }}
                                </td>


                                <td>
                                    {{ $item->location->name ?? '—' }}
                                </td>


                                <td>

                                    {{ \Carbon\Carbon::parse($item->found_date)->format('M d, Y') }}

                                </td>


                                <td>

                                    @if($item->status === 'awaiting_surrender')

                                        <span class="badge bg-warning text-dark">
                                            Awaiting Surrender
                                        </span>

                                    @elseif($item->status === 'received')

                                        <span class="badge bg-info text-dark">
                                            Received
                                        </span>

                                    @elseif($item->status === 'approved')

                                        <span class="badge bg-success">
                                            Approved
                                        </span>

                                    @elseif($item->status === 'rejected')

                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>

                                    @elseif($item->status === 'claimed')

                                        <span class="badge bg-primary">
                                            Claimed
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <a
                                        href="{{ route('student.found-report-details', $item->id) }}"
                                        class="btn btn-sm btn-dark"
                                    >

                                        <i class="bi bi-eye me-1"></i>

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

                <i
                    class="bi bi-box-seam"
                    style="font-size: 50px;"
                ></i>


                <h5 class="mt-3">
                    No Found Reports Yet
                </h5>


                <p class="text-muted">
                    You haven't reported any found items yet.
                </p>


                <a
                    href="{{ route('faculty.report-found') }}"
                    class="btn btn-dark px-4"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Report Found Item

                </a>

            </div>

        @endif

    </div>

</div>


{{-- SWITCH BETWEEN LOST AND FOUND --}}
<script>

    function showReports(type) {

        const lostReports =
            document.getElementById('lostReports');

        const foundReports =
            document.getElementById('foundReports');

        const lostBtn =
            document.getElementById('lostBtn');

        const foundBtn =
            document.getElementById('foundBtn');


        if (type === 'lost') {

            lostReports.style.display = 'block';

            foundReports.style.display = 'none';


            lostBtn.classList.remove('btn-outline-dark');

            lostBtn.classList.add('btn-dark');


            foundBtn.classList.remove('btn-dark');

            foundBtn.classList.add('btn-outline-dark');

        } else {

            lostReports.style.display = 'none';

            foundReports.style.display = 'block';


            foundBtn.classList.remove('btn-outline-dark');

            foundBtn.classList.add('btn-dark');


            lostBtn.classList.remove('btn-dark');

            lostBtn.classList.add('btn-outline-dark');

        }

    }

</script>

@endsection