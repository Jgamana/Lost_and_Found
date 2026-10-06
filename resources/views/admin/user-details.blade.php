@extends('layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')

<style>

.admin-user-details-page {
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

.admin-back-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: white;
    color: var(--admin-teal);
    border: 1px solid var(--admin-border);
    border-radius: 11px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.admin-back-button:hover {
    background: #eef5f3;
    color: var(--admin-teal-dark);
    border-color: #cbdedb;
}

.admin-user-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-user-profile {
    padding: 30px 25px;
    text-align: center;
    border-bottom: 1px solid var(--admin-border);
}

.admin-user-avatar {
    width: 86px;
    height: 86px;
    margin: 0 auto 16px;
    border-radius: 22px;
    background: #e7f0ee;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
}

.admin-user-name {
    color: var(--admin-text);
    font-size: 23px;
    font-weight: 700;
    margin-bottom: 5px;
}

.admin-user-email {
    color: var(--admin-muted);
    font-size: 13px;
    margin-bottom: 0;
}

.admin-details-body {
    padding: 25px;
}

.admin-details-header {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 22px;
}

.admin-details-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.admin-details-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-details-description {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.admin-detail-item {
    height: 100%;
    background: #f8faf9;
    border: 1px solid #edf2f1;
    border-radius: 13px;
    padding: 15px;
}

.admin-detail-label {
    display: block;
    color: var(--admin-muted);
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 7px;
}

.admin-detail-value {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 600;
    word-break: break-word;
}

.admin-role-badge,
.admin-status {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
}

.admin-role-badge {
    background: #e7f0ee;
    color: var(--admin-teal);
}

.admin-status-approved {
    background: #e5f3ea;
    color: #43835a;
}

.admin-status-pending {
    background: #fbf2d7;
    color: #967414;
}

.admin-status-rejected {
    background: #fff0f0;
    color: #bd5555;
}

.admin-status-default {
    background: #eef2f1;
    color: #64716f;
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-back-button {
        width: 100%;
        justify-content: center;
    }

    .admin-user-profile {
        padding: 25px 18px;
    }

    .admin-details-body {
        padding: 18px;
    }

}

</style>


<div class="admin-user-details-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-person-lines-fill me-1"></i>
                User Management
            </div>

            <h1 class="admin-page-title">
                User Details
            </h1>

            <p class="admin-page-description">
                View the account information of this registered user.
            </p>

        </div>


        <a
            href="{{ route('admin.users') }}"
            class="admin-back-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Users
        </a>

    </div>


    <div class="admin-user-card">

        <div class="admin-user-profile">

            <div class="admin-user-avatar">

                <i class="bi bi-person-fill"></i>

            </div>


            <h2 class="admin-user-name">
                {{ $user->name }}
            </h2>


            <p class="admin-user-email">
                {{ $user->email }}
            </p>

        </div>


        <div class="admin-details-body">

            <div class="admin-details-header">

                <div class="admin-details-icon">

                    <i class="bi bi-person-lines-fill"></i>

                </div>

                <div>

                    <h5 class="admin-details-title">
                        Account Information
                    </h5>

                    <p class="admin-details-description">
                        Basic information about this user account.
                    </p>

                </div>

            </div>


            <div class="row g-3">

                <div class="col-md-4">

                    <div class="admin-detail-item">

                        <span class="admin-detail-label">
                            Account Type
                        </span>

                        <span class="admin-role-badge">
                            {{ ucfirst($user->role) }}
                        </span>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="admin-detail-item">

                        <span class="admin-detail-label">
                            Account Status
                        </span>


                        @if($user->status === 'approved')

                            <span class="admin-status admin-status-approved">
                                Approved
                            </span>

                        @elseif($user->status === 'pending')

                            <span class="admin-status admin-status-pending">
                                Pending
                            </span>

                        @elseif($user->status === 'rejected')

                            <span class="admin-status admin-status-rejected">
                                Rejected
                            </span>

                        @else

                            <span class="admin-status admin-status-default">
                                {{ ucfirst($user->status ?? 'Unknown') }}
                            </span>

                        @endif

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="admin-detail-item">

                        <span class="admin-detail-label">
                            Account
                        </span>


                        @if($user->is_active)

                            <span class="admin-status admin-status-approved">
                                Active
                            </span>

                        @else

                            <span class="admin-status admin-status-default">
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="admin-detail-item">

                        <span class="admin-detail-label">
                            Contact Number
                        </span>

                        <div class="admin-detail-value">

                            {{ $user->contact_number ?? 'Not provided' }}

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="admin-detail-item">

                        <span class="admin-detail-label">
                            Email Address
                        </span>

                        <div class="admin-detail-value">

                            {{ $user->email }}

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="admin-detail-item">

                        <span class="admin-detail-label">
                            Member Since
                        </span>

                        <div class="admin-detail-value">

                            {{ $user->created_at->format('F d, Y') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection