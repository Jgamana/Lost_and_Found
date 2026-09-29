@extends('layouts.app')

@section('title', 'Manage Lost Items')
@section('page-title', 'Manage Lost Items')

@section('content')

<div class="welcome-section">

    <div class="d-flex justify-content-between align-items-start">

        <div>

            <h1 class="welcome-title">
                Manage Lost Items
            </h1>

            <p class="welcome-text">
                View and manage all lost item reports submitted by students and faculty.
            </p>

        </div>

        <button
            type="button"
            class="btn btn-dark no-print"
            onclick="window.print()"
        >
            <i class="bi bi-printer me-1"></i>
            Print Lost Items
        </button>

    </div>

</div>


@if (session('success'))

    <div class="alert alert-success alert-dismissible fade show no-print" role="alert">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


<div class="modern-card" id="printArea">

    <div class="d-none d-print-block text-center mb-4">

        <h4 class="fw-bold mb-1">
            MLG COLLEGE OF LEARNING, INC.
        </h4>

        <h5 class="fw-bold mb-1">
            Web-Based Lost and Found Management System
        </h5>

        <h6 class="fw-bold mb-3">
            LOST ITEMS REPORT
        </h6>

        <p class="mb-0">
            Generated on: {{ now()->format('F d, Y h:i A') }}
        </p>

    </div>


    <div class="d-flex justify-content-between align-items-center mb-4 no-print">

        <div>

            <h5 class="fw-bold mb-1">
                Lost Item Reports
            </h5>

            <p class="text-muted small mb-0">
                {{ $lostItems->count() }} report(s) found.
            </p>

        </div>


        <div style="max-width: 280px; width: 100%;">

            <div class="input-group">

                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    id="lostItemSearch"
                    class="form-control"
                    placeholder="Search lost items..."
                >

            </div>

        </div>

    </div>


    <div class="d-print-none text-muted mb-3">

        {{ $lostItems->count() }} lost item report(s)

    </div>


    <div class="table-responsive">

        <table class="table align-middle" id="lostItemsTable">

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

                    <th class="text-center no-print">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($lostItems as $item)

                    <tr>

                        <td>

                            <div class="d-flex align-items-center gap-2">

                                <div class="no-print">

                                    @if ($item->image)

                                        <img
                                            src="{{ asset('storage/' . $item->image) }}"
                                            alt="{{ $item->item_name }}"
                                            style="
                                                width: 45px;
                                                height: 45px;
                                                object-fit: cover;
                                                border-radius: 10px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="
                                                width: 45px;
                                                height: 45px;
                                                border-radius: 10px;
                                            "
                                        >

                                            <i class="bi bi-image text-muted"></i>

                                        </div>

                                    @endif

                                </div>


                                <strong>
                                    {{ $item->item_name }}
                                </strong>

                            </div>

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


                        <td class="text-center no-print">

                            <div class="d-flex justify-content-center gap-2">

                                <a
                                    href="{{ route('admin.lost-item-details', $item->id) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    title="View details"
                                >

                                    <i class="bi bi-eye"></i>

                                </a>


                                <form
                                    action="{{ route('admin.lost-item-delete', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this lost item report?');"
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


    <div class="d-none d-print-block mt-4">

        <p class="mb-1">
            Total Lost Item Reports: {{ $lostItems->count() }}
        </p>

        <p class="mb-0">
            Report generated by: {{ auth()->user()->name }}
        </p>

    </div>

</div>


<script>

document
    .getElementById('lostItemSearch')
    .addEventListener('keyup', function () {

        const search = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#lostItemsTable tbody tr'
        );

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display =
                text.includes(search) ? '' : 'none';

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