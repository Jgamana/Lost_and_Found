@extends('layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('content')

<style>

.admin-users-page {
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

.admin-page-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.admin-print-button {
    border: none;
    background: var(--admin-teal);
    color: white;
    border-radius: 11px;
    padding: 10px 15px;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-print-button:hover {
    background: var(--admin-teal-dark);
    color: white;
}

.admin-user-count {
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

.admin-search-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 16px;
    padding: 15px;
    margin-bottom: 18px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.admin-search-wrapper {
    position: relative;
}

.admin-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--admin-muted);
    font-size: 15px;
    z-index: 2;
}

.admin-search-input {
    width: 100%;
    border: 1px solid var(--admin-border);
    border-radius: 11px;
    padding: 11px 14px 11px 40px;
    color: var(--admin-text);
    font-size: 13px;
    outline: none;
    transition: 0.2s ease;
}

.admin-search-input:focus {
    border-color: #b8d0cc;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

.admin-table-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}

.admin-table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 20px 22px;
    border-bottom: 1px solid var(--admin-border);
}

.admin-table-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 4px;
}

.admin-table-description {
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
    padding: 14px 15px;
    vertical-align: middle;
}

.admin-table tbody tr:last-child td {
    border-bottom: none;
}

.admin-table tbody tr:hover {
    background: #fafcfc;
}

.admin-user-wrapper {
    display: flex;
    align-items: center;
    gap: 11px;
}

.admin-user-avatar {
    width: 39px;
    height: 39px;
    border-radius: 11px;
    background: #e7f0ee;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.admin-user-name {
    color: var(--admin-text);
    font-size: 13px;
    font-weight: 700;
}

.admin-user-email {
    color: var(--admin-muted);
    font-size: 11px;
    margin-top: 2px;
}

.admin-primary-text {
    color: var(--admin-text);
    font-weight: 600;
}

.admin-secondary-text {
    color: var(--admin-muted);
    font-size: 12px;
}

.admin-role,
.admin-status,
.admin-account-status {
    display: inline-flex;
    align-items: center;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.admin-role-student {
    background: #e7f0ee;
    color: var(--admin-teal);
}

.admin-role-faculty {
    background: #fbf2d7;
    color: #967414;
}

.admin-role-admin {
    background: #e8ecec;
    color: var(--admin-teal-dark);
}

.admin-status-approved,
.admin-account-active {
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

.admin-status-default,
.admin-account-inactive {
    background: #eef2f1;
    color: #64716f;
}

.admin-action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.admin-action-button {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    font-size: 13px;
    transition: 0.2s ease;
}

.admin-view-button {
    border: 1px solid #cbdedb;
    background: #eef5f3;
    color: var(--admin-teal);
}

.admin-view-button:hover {
    background: var(--admin-teal);
    border-color: var(--admin-teal);
    color: white;
}

.admin-deactivate-button {
    border: 1px solid #ead8a5;
    background: #fff8df;
    color: #967414;
}

.admin-deactivate-button:hover {
    background: #d6a51d;
    border-color: #d6a51d;
    color: white;
}

.admin-reactivate-button {
    border: 1px solid #c8dfcf;
    background: #edf8f0;
    color: #43835a;
}

.admin-reactivate-button:hover {
    background: #43835a;
    border-color: #43835a;
    color: white;
}

.admin-delete-button {
    border: 1px solid #efcaca;
    background: #fff0f0;
    color: #bd5555;
}

.admin-delete-button:hover {
    background: #bd5555;
    border-color: #bd5555;
    color: white;
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

.admin-print-header,
.admin-print-footer {
    display: none;
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-page-actions {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }

    .admin-print-button {
        width: 100%;
    }

    .admin-user-count {
        justify-content: center;
    }

    .admin-table {
        min-width: 1050px;
    }

}

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

    .admin-print-header {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }

    .admin-print-header h4 {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .admin-print-header h5 {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .admin-print-header h6 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .admin-print-header p {
        font-size: 9px;
        margin-bottom: 0;
    }

    .admin-table-card {
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        overflow: visible !important;
    }

    .admin-table-header {
        display: none !important;
    }

    .admin-table-wrapper {
        overflow: visible !important;
    }

    .admin-table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .admin-table thead {
        display: table-header-group;
    }

    .admin-table thead th {
        background: white !important;
        color: #000 !important;
        border: 1px solid #000 !important;
        font-size: 9px !important;
        padding: 7px !important;
    }

    .admin-table tbody td {
        color: #000 !important;
        border: 1px solid #000 !important;
        font-size: 9px !important;
        padding: 7px !important;
    }

    .admin-user-avatar {
        display: none !important;
    }

    .admin-user-name,
    .admin-user-email,
    .admin-primary-text,
    .admin-secondary-text {
        color: #000 !important;
    }

    .admin-user-name {
        font-size: 9px !important;
    }

    .admin-user-email,
    .admin-secondary-text {
        font-size: 8px !important;
    }

    .admin-role,
    .admin-status,
    .admin-account-status {
        background: transparent !important;
        color: #000 !important;
        border: none !important;
        padding: 0 !important;
        font-size: 9px !important;
        font-weight: normal !important;
    }

    .admin-action-group {
        display: none !important;
    }

    .admin-print-footer {
        display: flex !important;
        justify-content: space-between;
        margin-top: 18px;
        padding-top: 9px;
        border-top: 1px solid #000;
        font-size: 9px;
        color: #000 !important;
    }

}

</style>


<div class="admin-users-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-people me-1"></i>
                User Management
            </div>

            <h1 class="admin-page-title">
                User Management
            </h1>

            <p class="admin-page-description">
                View all registered students, faculty, and administrators.
            </p>

        </div>


        <div class="admin-page-actions">

            <div class="admin-user-count">
                <i class="bi bi-people-fill"></i>
                {{ $users->count() }}
                {{ $users->count() === 1 ? 'User' : 'Users' }}
            </div>

            <button
                type="button"
                class="admin-print-button no-print"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Users
            </button>

        </div>

    </div>


    <div class="admin-search-card no-print">

        <div class="admin-search-wrapper">

            <i class="bi bi-search admin-search-icon"></i>

            <input
                type="text"
                id="userSearch"
                class="admin-search-input"
                placeholder="Search users by name or email..."
                autocomplete="off"
            >

        </div>

    </div>


    <div
        class="admin-table-card"
        id="printArea"
    >

        <div class="admin-print-header">

            <h4>
                MLG COLLEGE OF LEARNING, INC.
            </h4>

            <h5>
                Web-Based Lost and Found Management System
            </h5>

            <h6>
                USER MANAGEMENT REPORT
            </h6>

            <p>
                Generated on:
                {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="admin-table-header no-print">

            <div>

                <h5 class="admin-table-title">
                    All Users
                </h5>

                <p class="admin-table-description">
                    {{ $users->count() }}
                    registered
                    {{ $users->count() === 1 ? 'user' : 'users' }}
                </p>

            </div>

        </div>


        <div class="admin-table-wrapper">

            <table class="table admin-table align-middle">

                <thead>

                    <tr>

                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Account
                        </th>

                        <th>
                            Registered
                        </th>

                        <th class="no-print text-center">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr
                            class="user-row"
                            data-search="{{ strtolower($user->name . ' ' . $user->email) }}"
                        >

                            <td>

                                <div class="admin-user-wrapper">

                                    <div class="admin-user-avatar no-print">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <div>

                                        <div class="admin-user-name">
                                            {{ $user->name }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <div class="admin-primary-text">
                                    {{ $user->email }}
                                </div>

                            </td>


                            <td>

                                @if($user->role === 'student')

                                    <span class="admin-role admin-role-student">
                                        Student
                                    </span>

                                @elseif($user->role === 'faculty')

                                    <span class="admin-role admin-role-faculty">
                                        Faculty
                                    </span>

                                @elseif($user->role === 'admin')

                                    <span class="admin-role admin-role-admin">
                                        Admin
                                    </span>

                                @else

                                    <span class="admin-role admin-status-default">
                                        {{ ucfirst($user->role) }}
                                    </span>

                                @endif

                            </td>


                            <td>

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

                            </td>


                            <td>

                                @if($user->is_active)

                                    <span class="admin-account-status admin-account-active">
                                        Active
                                    </span>

                                @else

                                    <span class="admin-account-status admin-account-inactive">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="admin-secondary-text">
                                    {{ $user->created_at->format('M d, Y') }}
                                </div>

                            </td>


                            <td class="no-print">

                                <div class="admin-action-group">

                                    <a
                                        href="{{ route('admin.user-details', $user->id) }}"
                                        class="admin-action-button admin-view-button"
                                        title="View User"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    @if($user->is_active)

                                        <form
                                            action="{{ route('admin.user-deactivate', $user->id) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="admin-action-button admin-deactivate-button"
                                                title="Deactivate User"
                                                onclick="return confirm('Are you sure you want to deactivate this user?')"
                                            >
                                                <i class="bi bi-person-slash"></i>
                                            </button>

                                        </form>

                                    @else

                                        <form
                                            action="{{ route('admin.user-reactivate', $user->id) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="admin-action-button admin-reactivate-button"
                                                title="Reactivate User"
                                            >
                                                <i class="bi bi-person-check"></i>
                                            </button>

                                        </form>

                                    @endif


                                    @if($user->id !== auth()->id())

                                        <form
                                            action="{{ route('admin.user-delete', $user->id) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="admin-action-button admin-delete-button"
                                                title="Delete User"
                                                onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="admin-empty-state"
                            >

                                <div class="admin-empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>

                                <div class="admin-empty-title">
                                    No Users Found
                                </div>

                                <p class="admin-empty-text">
                                    There are currently no registered users.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="admin-print-footer">

            <div>
                <strong>Total Users:</strong>
                {{ $users->count() }}
            </div>

            <div>
                <strong>Report Generated By:</strong>
                {{ auth()->user()->name }}
            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const userSearch = document.getElementById('userSearch');

    if (!userSearch) {
        return;
    }

    userSearch.addEventListener('input', function () {

        const searchValue = this.value
            .toLowerCase()
            .trim();

        document
            .querySelectorAll('.user-row')
            .forEach(function (row) {

                const searchText = row.dataset.search.toLowerCase();

                row.style.display =
                    searchText.includes(searchValue)
                        ? ''
                        : 'none';

            });

    });

});

</script>

@endsection