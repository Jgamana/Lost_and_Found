@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<style>

.student-notifications-page {
    --notification-teal: #365c5a;
    --notification-teal-dark: #294947;
    --notification-gold: #d6a51d;
    --notification-border: #e4eceb;
    --notification-text: #263b3a;
    --notification-muted: #7b8d8b;
    --notification-light: #eef5f3;
}


/* PAGE HEADER */

.student-notifications-page .page-heading {
    margin-bottom: 24px;
}

.student-notifications-page .page-label {
    color: var(--notification-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-notifications-page .page-heading h1 {
    color: var(--notification-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-notifications-page .page-heading p {
    color: var(--notification-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* MAIN CARD */

.student-notifications-card {
    background: #ffffff;
    border: 1px solid var(--notification-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    overflow: hidden;
}


/* CARD HEADER */

.student-notifications-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding: 22px 24px;
    border-bottom: 1px solid var(--notification-border);
}

.student-notifications-header-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 12px;
    background: var(--notification-light);
    color: var(--notification-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.student-notifications-title {
    color: var(--notification-text);
    font-size: 17px;
    font-weight: 700;
    margin: 1px 0 4px;
}

.student-notifications-description {
    color: var(--notification-muted);
    font-size: 12px;
    margin: 0;
}


/* NOTIFICATION LIST */

.student-notification-list {
    padding: 8px 20px;
}


/* NOTIFICATION ITEM */

.student-notification-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 17px 5px;
    border-bottom: 1px solid #edf2f1;
    transition: 0.2s ease;
}

.student-notification-item:last-child {
    border-bottom: none;
}

.student-notification-item:hover {
    background: #fafcfc;
    border-radius: 12px;
    padding-left: 12px;
    padding-right: 12px;
}


/* UNREAD */

.student-notification-item.unread {
    margin: 5px 0;
    padding: 15px 12px;
    background: #fffaf0;
    border: 1px solid #f1e5c2;
    border-radius: 12px;
}

.student-notification-item.unread:hover {
    background: #fff8e9;
}


/* ICON */

.student-notification-icon {
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.student-notification-icon.claim {
    background: #fff5d8;
    color: #b58a16;
}

.student-notification-icon.general {
    background: var(--notification-light);
    color: var(--notification-teal);
}


/* CONTENT */

.student-notification-content {
    flex: 1;
    min-width: 0;
}

.student-notification-title-row {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 5px;
}

.student-notification-title {
    color: var(--notification-text);
    font-size: 13px;
    font-weight: 700;
    margin: 0;
}

.student-notification-message {
    color: #61716f;
    font-size: 12px;
    line-height: 1.55;
    margin: 0 0 6px;
}

.student-notification-time {
    color: var(--notification-muted);
    font-size: 10px;
}


/* NEW BADGE */

.student-notification-new {
    display: inline-flex;
    align-items: center;
    padding: 4px 7px;
    border-radius: 6px;
    background: #fff0f0;
    color: #bd5555;
    font-size: 9px;
    font-weight: 700;
}


/* MARK AS READ */

.student-notification-action {
    flex-shrink: 0;
}

.student-notification-read-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-height: 34px;
    padding: 0 11px;
    border: 1px solid var(--notification-border);
    border-radius: 9px;
    background: #ffffff;
    color: var(--notification-teal);
    font-size: 10px;
    font-weight: 600;
    transition: 0.2s ease;
}

.student-notification-read-button:hover {
    background: var(--notification-teal);
    border-color: var(--notification-teal);
    color: #ffffff;
}


/* EMPTY STATE */

.student-notifications-empty {
    text-align: center;
    padding: 60px 25px;
}

.student-notifications-empty-icon {
    width: 68px;
    height: 68px;
    margin: 0 auto 17px;
    border-radius: 19px;
    background: var(--notification-light);
    color: var(--notification-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 29px;
}

.student-notifications-empty h5 {
    color: var(--notification-text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 7px;
}

.student-notifications-empty p {
    color: var(--notification-muted);
    font-size: 12px;
    margin: 0;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-notifications-page .page-heading h1 {
        font-size: 26px;
    }

    .student-notifications-header {
        padding: 19px;
    }

    .student-notification-list {
        padding: 7px 13px;
    }

    .student-notification-item {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .student-notification-content {
        width: calc(100% - 58px);
    }

    .student-notification-action {
        width: 100%;
        margin-left: 57px;
    }

    .student-notification-read-button {
        width: calc(100% - 57px);
    }

    .student-notifications-empty {
        padding: 50px 20px;
    }

}

</style>


<div class="student-notifications-page">

    {{-- PAGE HEADER --}}

    <div class="page-heading">

        <div class="page-label">
            Updates
        </div>

        <h1>
            Notifications
        </h1>

        <p>
            View your latest system notifications.
        </p>

    </div>


    {{-- NOTIFICATIONS CARD --}}

    <div class="student-notifications-card">

        <div class="student-notifications-header">

            <div class="student-notifications-header-icon">
                <i class="bi bi-bell"></i>
            </div>

            <div>

                <h5 class="student-notifications-title">
                    Your Notifications
                </h5>

                <p class="student-notifications-description">
                    Stay updated with your reports and claims.
                </p>

            </div>

        </div>


        @forelse($notifications as $notification)

            <div class="student-notification-list">

                <div
                    class="student-notification-item {{ !$notification->is_read ? 'unread' : '' }}"
                >

                    {{-- ICON --}}

                    <div
                        class="student-notification-icon
                        {{ $notification->type === 'claim' ? 'claim' : 'general' }}"
                    >

                        @if($notification->type === 'claim')

                            <i class="bi bi-clipboard-check"></i>

                        @else

                            <i class="bi bi-bell"></i>

                        @endif

                    </div>


                    {{-- CONTENT --}}

                    <div class="student-notification-content">

                        <div class="student-notification-title-row">

                            <h6 class="student-notification-title">
                                {{ $notification->title }}
                            </h6>

                            @if(!$notification->is_read)

                                <span class="student-notification-new">
                                    New
                                </span>

                            @endif

                        </div>


                        <p class="student-notification-message">
                            {{ $notification->message }}
                        </p>


                        <span class="student-notification-time">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>

                    </div>


                    {{-- MARK AS READ --}}

                    @if(!$notification->is_read)

                        <div class="student-notification-action">

                            <form
                                action="{{ route(
                                    'notification-read',
                                    $notification->id
                                ) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="student-notification-read-button"
                                >

                                    <i class="bi bi-check2"></i>

                                    Mark as read

                                </button>

                            </form>

                        </div>

                    @endif

                </div>

            </div>

        @empty

            <div class="student-notifications-empty">

                <div class="student-notifications-empty-icon">

                    <i class="bi bi-bell-slash"></i>

                </div>

                <h5>
                    No Notifications
                </h5>

                <p>
                    You don't have any notifications yet.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection