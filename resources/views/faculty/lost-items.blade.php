@extends('layouts.app')

@section('title', 'Lost Items')
@section('page-title', 'Lost Items')

@section('content')

<style>

.faculty-lost-items-page {
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
    white-space: nowrap;
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

.faculty-section-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.faculty-table-heading {
    display: flex;
    align-items: center;
    gap: 13px;
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
    min-width: 850px;
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

.faculty-status {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.faculty-status-reported {
    background: #fbf2d7;
    color: #967414;
}

.faculty-status-resolved {
    background: #e5f3ea;
    color: #43835a;
}

.faculty-status-claimed {
    background: #e8eef8;
    color: #42628f;
}

.faculty-status-default {
    background: #eef2f1;
    color: #64716f;
}

.faculty-date {
    color: var(--text);
    font-size: 11px;
    white-space: nowrap;
}

.faculty-empty-state {
    padding: 65px 25px;
    text-align: center;
}

.faculty-empty-icon {
    width: 66px;
    height: 66px;
    margin: 0 auto 17px;
    border-radius: 18px;
    background: #eef5f3;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 29px;
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
        padding: 18px;
    }

    .faculty-table {
        min-width: 850px;
    }

}

</style>


<div class="faculty-lost-items-page">

    <div class="faculty-page-header">

        <div>

            <div class="faculty-page-label">
                <i class="bi bi-search me-1"></i>
                Lost & Found
            </div>

            <h1 class="faculty-page-title">
                Reported Lost Items
            </h1>

            <p class="faculty-page-description">
                Browse all lost item reports submitted by students and faculty.
            </p>

        </div>


        <div class="faculty-count-badge">

            <i class="bi bi-file-earmark-text"></i>

            {{ $lostItems->count() }}
            Report{{ $lostItems->count() !== 1 ? 's' : '' }}

        </div>

    </div>


    <div class="faculty-table-card">

        <div class="faculty-table-header">

            <div class="faculty-table-heading">

                <div class="faculty-section-icon">
                    <i class="bi bi-search"></i>
                </div>

                <div>

                    <h5 class="faculty-table-title">
                        Lost Item Reports
                    </h5>

                    <p class="faculty-table-description">
                        {{ $lostItems->count() }}
                        report{{ $lostItems->count() !== 1 ? 's' : '' }}
                        found.
                    </p>

                </div>

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

                    @forelse($lostItems as $item)

                        <tr>

                            <td>

                                <div class="faculty-item-wrapper">

                                    <div class="faculty-item-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </div>

                                    <div>

                                        <div class="faculty-primary-text">
                                            {{ $item->item_name }}
                                        </div>

                                        <div class="faculty-secondary-text">
                                            Report #{{ $item->id }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <div class="faculty-primary-text">
                                    {{ $item->user->name ?? 'Unknown' }}
                                </div>

                            </td>


                            <td>

                                <span class="faculty-primary-text">
                                    {{ $item->custom_category ?? $item->category->name ?? 'Unknown' }}
                                </span>

                            </td>


                            <td>

                                <span class="faculty-primary-text">
                                    {{ $item->custom_location ?? $item->location->name ?? 'Unknown' }}
                                </span>

                            </td>


                            <td>

                                <span class="faculty-date">

                                    {{ \Carbon\Carbon::parse(
                                        $item->lost_date
                                    )->format('F d, Y') }}

                                </span>

                            </td>


                            <td>

                                @if($item->status === 'reported')

                                    <span class="faculty-status faculty-status-reported">
                                        <i class="bi bi-clock me-1"></i>
                                        Reported
                                    </span>

                                @elseif($item->status === 'resolved')

                                    <span class="faculty-status faculty-status-resolved">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Resolved
                                    </span>

                                @elseif($item->status === 'claimed')

                                    <span class="faculty-status faculty-status-claimed">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>
                                        Claimed
                                    </span>

                                @else

                                    <span class="faculty-status faculty-status-default">
                                        {{ ucfirst($item->status) }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="faculty-empty-state">

                                    <div class="faculty-empty-icon">
                                        <i class="bi bi-search"></i>
                                    </div>

                                    <h5 class="faculty-empty-title">
                                        No Lost Item Reports
                                    </h5>

                                    <p class="faculty-empty-text">
                                        There are currently no lost item reports available.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection