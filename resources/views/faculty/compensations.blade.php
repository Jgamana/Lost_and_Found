@extends('layouts.app')

@section('title', 'Compensations')
@section('page-title', 'Compensations')

@section('content')

<style>

.faculty-compensation-page {
    --teal: #365c5a;
    --teal-dark: #294947;
    --gold: #d6a51d;
    --border: #e4eceb;
    --text: #263b3a;
    --muted: #7b8d8b;
}

.faculty-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.faculty-page-label {
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.faculty-page-title {
    color: var(--text);
    font-size: 30px;
    font-weight: 700;
    margin: 0 0 6px;
}

.faculty-page-description {
    color: var(--muted);
    font-size: 14px;
    margin: 0;
}

.faculty-count-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #eef5f3;
    color: var(--teal);
    border: 1px solid #dce9e6;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
}

.faculty-table-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.faculty-table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 20px 22px;
    border-bottom: 1px solid var(--border);
}

.faculty-table-title {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    margin: 0 0 4px;
}

.faculty-table-description {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

.faculty-table-wrapper {
    overflow-x: auto;
}

.faculty-table {
    width: 100%;
    min-width: 900px;
    margin: 0;
    border-collapse: collapse;
}

.faculty-table thead th {
    background: #f4f8f7;
    color: var(--text);
    border-bottom: 1px solid var(--border);
    padding: 14px 15px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-table tbody td {
    color: var(--text);
    border-bottom: 1px solid #edf2f1;
    padding: 15px;
    font-size: 12px;
    vertical-align: middle;
}

.faculty-table tbody tr:last-child td {
    border-bottom: none;
}

.faculty-table tbody tr:hover {
    background: #fafcfc;
}

.faculty-item-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
}

.faculty-item-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.faculty-primary-text {
    color: var(--text);
    font-size: 12px;
    font-weight: 700;
}

.faculty-secondary-text {
    color: var(--muted);
    font-size: 10px;
    margin-top: 2px;
}

.faculty-amount {
    color: var(--teal);
    font-size: 13px;
    font-weight: 700;
}

.faculty-status {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-status-paid {
    background: #e5f3ea;
    color: #43835a;
}

.faculty-status-unpaid {
    background: #fbf2d7;
    color: #967414;
}

.faculty-paid-date {
    color: var(--text);
    font-size: 11px;
}

.faculty-no-date {
    color: #a0aaa8;
    font-size: 12px;
}

.faculty-action-button {
    min-height: 35px;
    border: 1px solid #c8dfcf;
    background: #edf8f0;
    color: #43835a;
    border-radius: 9px;
    padding: 7px 11px;
    font-size: 10px;
    font-weight: 600;
    transition: 0.2s ease;
    white-space: nowrap;
}

.faculty-action-button:hover {
    background: #43835a;
    border-color: #43835a;
    color: #ffffff;
}

.faculty-completed {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    color: #43835a;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.faculty-empty-state {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    padding: 60px 25px;
    text-align: center;
}

.faculty-empty-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.faculty-empty-title {
    color: var(--text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 7px;
}

.faculty-empty-text {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

@media (max-width: 768px) {

    .faculty-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .faculty-page-title {
        font-size: 26px;
    }

    .faculty-count-badge {
        width: 100%;
        justify-content: center;
    }

    .faculty-table-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 18px;
    }

    .faculty-table {
        min-width: 900px;
    }

}

</style>


<div class="faculty-compensation-page">

    <div class="faculty-page-header">

        <div>

            <div class="faculty-page-label">
                <i class="bi bi-cash-stack me-1"></i>
                Claim Management
            </div>

            <h1 class="faculty-page-title">
                Compensations
            </h1>

            <p class="faculty-page-description">
                Manage compensation records for claimed items.
            </p>

        </div>


        @if(!$compensations->isEmpty())

            <div class="faculty-count-badge">

                <i class="bi bi-receipt"></i>

                {{ $compensations->count() }} Record{{ $compensations->count() !== 1 ? 's' : '' }}

            </div>

        @endif

    </div>


    @if($compensations->isEmpty())

        <div class="faculty-empty-state">

            <div class="faculty-empty-icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <h5 class="faculty-empty-title">
                No Compensation Records
            </h5>

            <p class="faculty-empty-text">
                Compensation records will appear here after a claim is approved.
            </p>

        </div>

    @else

        <div class="faculty-table-card">

            <div class="faculty-table-header">

                <div>

                    <h5 class="faculty-table-title">
                        Compensation Records
                    </h5>

                    <p class="faculty-table-description">
                        Review compensation status and confirm completed payments.
                    </p>

                </div>

            </div>


            <div class="faculty-table-wrapper">

                <table class="faculty-table">

                    <thead>

                        <tr>

                            <th>
                                Item
                            </th>

                            <th>
                                Finder
                            </th>

                            <th>
                                Claimant
                            </th>

                            <th>
                                Amount
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Paid At
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($compensations as $compensation)

                            <tr>

                                <td>

                                    <div class="faculty-item-wrapper">

                                        <div class="faculty-item-icon">
                                            <i class="bi bi-box-seam"></i>
                                        </div>

                                        <div>

                                            <div class="faculty-primary-text">
                                                {{ $compensation->claim?->foundItem?->item_name ?? 'Unknown Item' }}
                                            </div>

                                            @if($compensation->claim_id)

                                                <div class="faculty-secondary-text">
                                                    Claim #{{ $compensation->claim_id }}
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <div class="faculty-primary-text">
                                        {{ $compensation->finder?->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="faculty-primary-text">
                                        {{ $compensation->claimant?->name ?? 'Unknown' }}
                                    </div>

                                </td>


                                <td>

                                    <span class="faculty-amount">
                                        ₱{{ number_format($compensation->amount, 2) }}
                                    </span>

                                </td>


                                <td>

                                    @if($compensation->status === 'paid')

                                        <span class="faculty-status faculty-status-paid">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Paid
                                        </span>

                                    @else

                                        <span class="faculty-status faculty-status-unpaid">
                                            <i class="bi bi-clock me-1"></i>
                                            Unpaid
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($compensation->paid_at)

                                        <span class="faculty-paid-date">
                                            {{ $compensation->paid_at->format('M d, Y h:i A') }}
                                        </span>

                                    @else

                                        <span class="faculty-no-date">
                                            —
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($compensation->status === 'unpaid')

                                        <form
                                            action="{{ route(
                                                'faculty.compensation-paid',
                                                $compensation->id
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="faculty-action-button"
                                                onclick="return confirm('Confirm that the finder has received the compensation?')"
                                            >

                                                <i class="bi bi-check-circle me-1"></i>

                                                Mark as Paid

                                            </button>

                                        </form>

                                    @else

                                        <span class="faculty-completed">

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

    @endif

</div>

@endsection