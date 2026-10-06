@extends('layouts.app')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')

@section('content')

<style>

.admin-logs-page {
    --admin-teal: #365c5a;
    --admin-teal-dark: #294947;
    --admin-gold: #d6a51d;
    --admin-border: #e4eceb;
    --admin-text: #263b3a;
    --admin-muted: #7b8d8b;
}

.admin-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.admin-page-label {
    color: var(--admin-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.admin-page-title {
    color: var(--admin-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.admin-page-description {
    color: var(--admin-muted);
    font-size: 14px;
    margin-bottom: 0;
}

.admin-log-count {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #eef5f3;
    color: var(--admin-teal);
    border: 1px solid #dce9e6;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
}

.admin-logs-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-logs-body {
    padding: 22px;
}

.admin-section-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 22px;
}

.admin-section-icon {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}

.admin-section-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-section-description {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.admin-table-wrapper {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    margin-bottom: 0;
}

.admin-table thead th {
    background: #f4f8f7;
    color: var(--admin-text);
    border-bottom: 1px solid var(--admin-border);
    font-size: 12px;
    font-weight: 700;
    padding: 14px 15px;
    white-space: nowrap;
}

.admin-table tbody td {
    color: var(--admin-text);
    border-bottom: 1px solid #edf2f1;
    font-size: 13px;
    padding: 15px;
    vertical-align: middle;
}

.admin-table tbody tr:last-child td {
    border-bottom: none;
}

.admin-table tbody tr:hover {
    background: #fafcfc;
}

.admin-user-name {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 3px;
}

.admin-user-role {
    color: var(--admin-muted);
    font-size: 11px;
}

.admin-description {
    color: var(--admin-text);
    font-size: 13px;
    line-height: 1.5;
    min-width: 260px;
}

.admin-ip {
    color: var(--admin-muted);
    font-size: 12px;
    font-family: monospace;
}

.admin-date {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
}

.admin-time {
    color: var(--admin-muted);
    font-size: 11px;
    margin-top: 3px;
}

.admin-action-badge {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.admin-action-login {
    background: #e5f3ea;
    color: #43835a;
}

.admin-action-logout {
    background: #eef2f1;
    color: #64716f;
}

.admin-action-failed {
    background: #fff0f0;
    color: #bd5555;
}

.admin-action-default {
    background: #e7f0ee;
    color: var(--admin-teal);
}

.admin-empty-state {
    text-align: center;
    padding: 60px 20px !important;
}

.admin-empty-icon {
    width: 62px;
    height: 62px;
    border-radius: 17px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 27px;
}

.admin-empty-title {
    color: var(--admin-text);
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 6px;
}

.admin-empty-text {
    color: var(--admin-muted);
    font-size: 13px;
    margin-bottom: 0;
}

.admin-pagination {
    margin-top: 22px;
}

.admin-pagination .pagination {
    margin-bottom: 0;
}

.admin-pagination .page-link {
    color: var(--admin-teal);
    border-color: var(--admin-border);
    font-size: 12px;
}

.admin-pagination .page-item.active .page-link {
    background: var(--admin-teal);
    border-color: var(--admin-teal);
    color: white;
}

.admin-pagination .page-link:hover {
    background: #eef5f3;
    color: var(--admin-teal-dark);
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-logs-body {
        padding: 16px;
    }

    .admin-table {
        min-width: 900px;
    }

    .admin-table thead th {
        font-size: 11px;
    }

    .admin-table tbody td {
        font-size: 12px;
        padding: 12px;
    }

}

</style>


<div class="admin-logs-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-clock-history me-1"></i>
                Administration
            </div>

            <h1 class="admin-page-title">
                Activity Logs
            </h1>

            <p class="admin-page-description">
                View the activities performed by users throughout the system.
            </p>

        </div>


        <div class="admin-log-count">

            <i class="bi bi-list-check"></i>

            {{ $logs->total() }}

            {{ $logs->total() === 1 ? 'Activity' : 'Activities' }}

        </div>

    </div>


    <div class="admin-logs-card">

        <div class="admin-logs-body">

            <div class="admin-section-header">

                <div class="admin-section-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div>

                    <h5 class="admin-section-title">
                        System Activity
                    </h5>

                    <p class="admin-section-description">
                        Login, logout, and other system activities.
                    </p>

                </div>

            </div>


            <div class="admin-table-wrapper">

                <table class="table admin-table align-middle">

                    <thead>

                        <tr>

                            <th>
                                User
                            </th>

                            <th>
                                Action
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                IP Address
                            </th>

                            <th>
                                Date & Time
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($logs as $log)

                            <tr>

                                <td>

                                    @if($log->user)

                                        <div class="admin-user-name">
                                            {{ $log->user->name }}
                                        </div>

                                        <div class="admin-user-role">
                                            {{ ucfirst($log->user->role) }}
                                        </div>

                                    @else

                                        <span class="admin-user-role">
                                            Unknown User
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($log->action === 'Login')

                                        <span class="admin-action-badge admin-action-login">

                                            <i class="bi bi-box-arrow-in-right me-1"></i>

                                            Login

                                        </span>

                                    @elseif($log->action === 'Logout')

                                        <span class="admin-action-badge admin-action-logout">

                                            <i class="bi bi-box-arrow-right me-1"></i>

                                            Logout

                                        </span>

                                    @elseif($log->action === 'Failed Login')

                                        <span class="admin-action-badge admin-action-failed">

                                            <i class="bi bi-shield-exclamation me-1"></i>

                                            Failed Login

                                        </span>

                                    @else

                                        <span class="admin-action-badge admin-action-default">

                                            {{ $log->action }}

                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="admin-description">

                                        {{ $log->description ?? '—' }}

                                    </div>

                                </td>


                                <td>

                                    <div class="admin-ip">

                                        {{ $log->ip_address ?? '—' }}

                                    </div>

                                </td>


                                <td>

                                    <div class="admin-date">

                                        {{ $log->created_at->format('M d, Y') }}

                                    </div>

                                    <div class="admin-time">

                                        {{ $log->created_at->format('h:i A') }}

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="admin-empty-state"
                                >

                                    <div class="admin-empty-icon">

                                        <i class="bi bi-clock-history"></i>

                                    </div>

                                    <div class="admin-empty-title">
                                        No Activity Logs Yet
                                    </div>

                                    <p class="admin-empty-text">
                                        User activities will appear here.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            @if($logs->hasPages())

                <div class="admin-pagination">

                    {{ $logs->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection