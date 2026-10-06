@extends('layouts.app')

@section('title', 'Faculty Requests')
@section('page-title', 'Faculty Requests')

@section('content')

<style>

.admin-faculty-page {
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

.admin-request-count {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #fbf2d7;
    color: #967414;
    border: 1px solid #eee1b8;
    border-radius: 11px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 700;
}

.admin-alert {
    border: none;
    border-radius: 13px;
    font-size: 13px;
    margin-bottom: 20px;
}

.admin-request-card {
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 20px;
    padding: 23px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
}

.admin-section-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 21px;
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

.admin-faculty-request {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 19px;
    background: #fafcfb;
    border: 1px solid #e8efed;
    border-radius: 16px;
    margin-bottom: 12px;
    transition: 0.2s ease;
}

.admin-faculty-request:last-child {
    margin-bottom: 0;
}

.admin-faculty-request:hover {
    background: #f6faf9;
    border-color: #dce8e5;
}

.admin-faculty-info {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.admin-faculty-avatar {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: #e7f0ee;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.admin-faculty-name {
    color: var(--admin-text);
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 3px;
}

.admin-faculty-email {
    color: var(--admin-muted);
    font-size: 12px;
    margin-bottom: 8px;
    word-break: break-word;
}

.admin-faculty-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}

.admin-pending-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 9px;
    border-radius: 7px;
    background: #fbf2d7;
    color: #967414;
    font-size: 10px;
    font-weight: 700;
}

.admin-registration-date {
    color: var(--admin-muted);
    font-size: 11px;
}

.admin-request-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.admin-approve-button,
.admin-reject-button {
    border: none;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.admin-approve-button {
    background: #e5f3ea;
    color: #43835a;
}

.admin-approve-button:hover {
    background: #43835a;
    color: white;
}

.admin-reject-button {
    background: #fff0f0;
    color: #bd5555;
}

.admin-reject-button:hover {
    background: #bd5555;
    color: white;
}

.admin-empty-state {
    text-align: center;
    padding: 55px 20px;
}

.admin-empty-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    background: #eef5f3;
    color: var(--admin-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 28px;
}

.admin-empty-title {
    color: var(--admin-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 6px;
}

.admin-empty-description {
    color: var(--admin-muted);
    font-size: 13px;
    margin-bottom: 0;
}

@media (max-width: 768px) {

    .admin-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-page-title {
        font-size: 26px;
    }

    .admin-request-card {
        padding: 18px;
        border-radius: 17px;
    }

    .admin-faculty-request {
        align-items: flex-start;
        flex-direction: column;
    }

    .admin-request-actions {
        width: 100%;
    }

    .admin-approve-button,
    .admin-reject-button {
        flex: 1;
    }

}

</style>


<div class="admin-faculty-page">

    <div class="admin-page-header">

        <div>

            <div class="admin-page-label">
                <i class="bi bi-person-check me-1"></i>
                Administration
            </div>

            <h1 class="admin-page-title">
                Faculty Requests
            </h1>

            <p class="admin-page-description">
                Review faculty account registrations and approve or reject their requests.
            </p>

        </div>


        <div class="admin-request-count">

            <i class="bi bi-hourglass-split"></i>

            {{ $faculty->count() }}
            {{ $faculty->count() === 1 ? 'Pending Request' : 'Pending Requests' }}

        </div>

    </div>


    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show admin-alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ $errors->first() }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="admin-request-card">

        <div class="admin-section-header">

            <div class="admin-section-icon">
                <i class="bi bi-person-check"></i>
            </div>

            <div>

                <h5 class="admin-section-title">
                    Pending Faculty Accounts
                </h5>

                <p class="admin-section-description">
                    These faculty accounts are waiting for administrator approval.
                </p>

            </div>

        </div>


        @forelse($faculty as $user)

            <div class="admin-faculty-request">

                <div class="admin-faculty-info">

                    <div class="admin-faculty-avatar">

                        <i class="bi bi-person"></i>

                    </div>


                    <div>

                        <div class="admin-faculty-name">
                            {{ $user->name }}
                        </div>

                        <div class="admin-faculty-email">
                            {{ $user->email }}
                        </div>


                        <div class="admin-faculty-meta">

                            <span class="admin-pending-badge">
                                <i class="bi bi-clock me-1"></i>
                                Pending Approval
                            </span>

                            <span class="admin-registration-date">
                                Registered
                                {{ $user->created_at->format('M d, Y') }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="admin-request-actions">

                    <form
                        action="{{ route('admin.faculty-approve', $user->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to approve this faculty account?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="admin-approve-button"
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Approve

                        </button>

                    </form>


                    <form
                        action="{{ route('admin.faculty-reject', $user->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to reject this faculty account?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="admin-reject-button"
                        >

                            <i class="bi bi-x-circle me-1"></i>

                            Reject

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="admin-empty-state">

                <div class="admin-empty-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <h5 class="admin-empty-title">
                    No Pending Faculty Requests
                </h5>

                <p class="admin-empty-description">
                    There are currently no faculty accounts waiting for approval.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection