@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Compensations</h2>
            <p class="text-muted mb-0">
                Manage compensation records for claimed items.
            </p>
        </div>
    </div>

    @if($compensations->isEmpty())

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">

                <i class="bi bi-cash-stack fs-1 text-muted"></i>

                <h5 class="mt-3">No Compensation Records</h5>

                <p class="text-muted mb-0">
                    Compensation records will appear here after a claim is approved.
                </p>

            </div>
        </div>

    @else

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Item</th>
                                <th>Finder</th>
                                <th>Claimant</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Paid At</th>
                                <th class="text-end px-4">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($compensations as $compensation)

                                <tr>

                                    <td class="px-4">
                                        <strong>
                                            {{ $compensation->claim?->foundItem?->item_name ?? 'Unknown Item' }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $compensation->finder?->name ?? 'Unknown' }}
                                    </td>

                                    <td>
                                        {{ $compensation->claimant?->name ?? 'Unknown' }}
                                    </td>

                                    <td>
                                        <strong>
                                            ₱{{ number_format($compensation->amount, 2) }}
                                        </strong>
                                    </td>

                                    <td>

                                        @if($compensation->status === 'paid')

                                            <span class="badge bg-success">
                                                Paid
                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">
                                                Unpaid
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($compensation->paid_at)
                                            {{ $compensation->paid_at->format('M d, Y h:i A') }}
                                        @else
                                            —
                                        @endif

                                    </td>

                                    <td class="text-end px-4">

                                        @if($compensation->status === 'unpaid')

                                            <form
                                                action="{{ route('faculty.compensation-paid', $compensation->id) }}"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-success"
                                                    onclick="return confirm('Confirm that the finder has received the compensation?')"
                                                >
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Mark as Paid
                                                </button>

                                            </form>

                                        @else

                                            <span class="text-success">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Completed
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection