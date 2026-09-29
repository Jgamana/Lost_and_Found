@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">Updates</div>
    <h1>Notifications</h1>
    <p>View your latest system notifications.</p>
</div>

<div class="modern-card notification-card">

    <div class="section-header mb-3">
        <div>
            <h5>
                <i class="bi bi-bell me-2"></i>
                Your Notifications
            </h5>

            <p>
                Stay updated with your reports and claims.
            </p>
        </div>
    </div>

    @forelse($notifications as $notification)

        <div class="notification-item"
             style="{{ !$notification->is_read ? 'background:#fffaf7; padding-left:12px; padding-right:12px; border-radius:10px;' : '' }}">

            <div class="notification-icon
                {{ $notification->type === 'claim' ? 'yellow' : 'green' }}">

                @if($notification->type === 'claim')
                    <i class="bi bi-clipboard-check"></i>
                @else
                    <i class="bi bi-bell"></i>
                @endif

            </div>

            <div class="flex-grow-1">

                <h6>
                    {{ $notification->title }}

                    @if(!$notification->is_read)
                        <span class="badge bg-danger ms-2">
                            New
                        </span>
                    @endif
                </h6>

                <p>
                    {{ $notification->message }}
                </p>

                <span class="notification-time">
                    {{ $notification->created_at->diffForHumans() }}
                </span>

            </div>

            @if(!$notification->is_read)

                <form
                    action="{{ route('notification-read', $notification->id) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-sm btn-light"
                    >
                        Mark as read
                    </button>
                </form>

            @endif

        </div>

    @empty

        <div class="text-center py-5">

            <i
                class="bi bi-bell-slash text-muted"
                style="font-size:50px;"
            ></i>

            <h5 class="mt-3">
                No Notifications
            </h5>

            <p class="text-muted mb-0">
                You don't have any notifications yet.
            </p>

        </div>

    @endforelse

</div>

@endsection