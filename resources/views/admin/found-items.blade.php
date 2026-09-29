@extends('layouts.app')

@section('title', 'Manage Found Items')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Manage Found Items
            </h2>

            <p class="text-muted mb-0">
                View, receive, verify, and manage found item reports.
            </p>

        </div>


        <div class="d-flex align-items-center gap-2 no-print">

            <span class="badge bg-dark fs-6 px-3 py-2">
                {{ $foundItems->count() }} Items
            </span>

            <button
                type="button"
                class="btn btn-dark"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Found Items
            </button>

        </div>

    </div>


    <div class="card border-0 shadow-sm rounded-4" id="printArea">

        <div class="card-body p-4">


            {{-- Print Header --}}

            <div class="d-none d-print-block text-center mb-4">

                <h4 class="fw-bold mb-1">
                    MLG COLLEGE OF LEARNING, INC.
                </h4>

                <h5 class="fw-bold mb-1">
                    Web-Based Lost and Found Management System
                </h5>

                <h6 class="fw-bold mb-3">
                    FOUND ITEMS REPORT
                </h6>

                <p class="mb-0">
                    Generated on: {{ now()->format('F d, Y h:i A') }}
                </p>

            </div>


            {{-- Search --}}

            <div class="mb-4 no-print">

                <div class="input-group">

                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        id="foundItemSearch"
                        class="form-control"
                        placeholder="Search found items..."
                    >

                </div>

            </div>


            <div class="d-print-none text-muted mb-3">

                {{ $foundItems->count() }} found item report(s)

            </div>


            <div class="table-responsive">

                <table
                    class="table align-middle"
                    id="foundItemsTable"
                >

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
                                Found Date
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center no-print">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($foundItems as $item)

                            <tr>

                                {{-- Item --}}

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="no-print">

                                            @if($item->image)

                                                <img
                                                    src="{{ asset('storage/' . $item->image) }}"
                                                    alt="{{ $item->item_name }}"
                                                    width="55"
                                                    height="55"
                                                    class="rounded-3"
                                                    style="object-fit: cover;"
                                                >

                                            @else

                                                <div
                                                    class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                                    style="width:55px;height:55px;"
                                                >

                                                    <i class="bi bi-image text-muted fs-4"></i>

                                                </div>

                                            @endif

                                        </div>


                                        <div>

                                            <div class="fw-semibold">
                                                {{ $item->item_name }}
                                            </div>

                                            <small class="text-muted">
                                                #{{ $item->id }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- Reporter --}}

                                <td>
                                    {{ $item->user->name ?? 'Unknown' }}
                                </td>


                                {{-- Category --}}

                                <td>
                                    {{ $item->category->name ?? 'Unknown' }}
                                </td>


                                {{-- Location --}}

                                <td>
                                    {{ $item->location->name ?? 'Unknown' }}
                                </td>


                                {{-- Found Date --}}

                                <td>

                                    {{ \Carbon\Carbon::parse($item->found_date)->format('M d, Y') }}

                                </td>


                                {{-- Status --}}

                                <td>

                                    @if($item->status === 'claimed')

                                        <span class="badge bg-primary">
                                            Claimed
                                        </span>


                                    @elseif($item->status === 'approved')

                                        <span class="badge bg-success">
                                            Available
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


                                {{-- Actions --}}

                                <td class="no-print">

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">


                                        {{-- View Details --}}

                                        <a
                                            href="{{ route('admin.found-item-details', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="View Details"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Receive Item --}}

                                        @if($item->status === 'awaiting_surrender')

                                            <form
                                                action="{{ route('admin.found-item-receive', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Confirm that you have physically received this found item?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-info"
                                                    title="Receive Item"
                                                >

                                                    <i class="bi bi-box-arrow-in-down"></i>

                                                </button>

                                            </form>

                                        @endif


                                        {{-- Approve / Reject --}}

                                        @if($item->status === 'received')

                                            <form
                                                action="{{ route('admin.found-item-approve', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Approve this found item and make it available for claims?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-success"
                                                    title="Approve Item"
                                                >

                                                    <i class="bi bi-check-circle"></i>

                                                </button>

                                            </form>


                                            <form
                                                action="{{ route('admin.found-item-reject', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Reject this found item?');"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Reject Item"
                                                >

                                                    <i class="bi bi-x-circle"></i>

                                                </button>

                                            </form>

                                        @endif


                                        {{-- Delete --}}

                                        <form
                                            action="{{ route('admin.found-item-delete', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this found item report?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5 text-muted"
                                >

                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                    No found item reports available.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Print Footer --}}

            <div class="d-none d-print-block mt-4">

                <p class="mb-1">
                    Total Found Item Reports: {{ $foundItems->count() }}
                </p>

                <p class="mb-0">
                    Report generated by: {{ auth()->user()->name }}
                </p>

            </div>

        </div>

    </div>

</div>


<script>

document
    .getElementById('foundItemSearch')
    .addEventListener('input', function () {

        const search = this.value.toLowerCase();

        document
            .querySelectorAll('#foundItemsTable tbody tr')
            .forEach(function (row) {

                row.style.display =
                    row.innerText
                        .toLowerCase()
                        .includes(search)
                        ? ''
                        : 'none';

            });

    });

</script>


<style>

    @media print {

        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            background: white !important;
        }

        body * {
            visibility: hidden;
        }

        #printArea,
        #printArea * {
            visibility: visible;
        }

        #printArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
            box-shadow: none !important;
            border: none !important;
        }

        .no-print {
            display: none !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 8px !important;
            color: #000 !important;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        .badge {
            color: #000 !important;
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            font-weight: normal !important;
        }

    }

</style>

@endsection