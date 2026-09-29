@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">Administration</div>
    <h1>Activity Logs</h1>
    <p>View the activities performed by users throughout the system.</p>
</div>

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

            <div>
                <h5 class="mb-1">
                    <i class="bi bi-clock-history me-2"></i>
                    System Activity
                </h5>

                <p class="text-muted mb-0">
                    Login, logout, and other system activities.
                </p>
            </div>

        </div>

        {{-- Logs Table --}}
        <div class="table-responsive">

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($logs as $log)

                        <tr>

                            {{-- User --}}
                            <td>
                                @if($log->user)

                                    <div class="fw-semibold">
                                        {{ $log->user->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ ucfirst($log->user->role) }}
                                    </small>

                                @else

                                    <span class="text-muted">
                                        Unknown User
                                    </span>

                                @endif
                            </td>

                            {{-- Action --}}
                            <td>

                                @if($log->action === 'Login')

                                    <span class="badge bg-success">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>
                                        Login
                                    </span>

                                @elseif($log->action === 'Logout')

                                    <span class="badge bg-secondary">
                                        <i class="bi bi-box-arrow-right me-1"></i>
                                        Logout
                                    </span>

                                @elseif($log->action === 'Failed Login')

                                    <span class="badge bg-danger">
                                        <i class="bi bi-shield-exclamation me-1"></i>
                                        Failed Login
                                    </span>

                                @else

                                    <span class="badge bg-primary">
                                        {{ $log->action }}
                                    </span>

                                @endif

                            </td>

                            {{-- Description --}}
                            <td>
                                {{ $log->description ?? '—' }}
                            </td>

                            {{-- IP Address --}}
                            <td>
                                {{ $log->ip_address ?? '—' }}
                            </td>

                            {{-- Date & Time --}}
                            <td>
                                <div>
                                    {{ $log->created_at->format('M d, Y') }}
                                </div>

                                <small class="text-muted">
                                    {{ $log->created_at->format('h:i A') }}
                                </small>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-clock-history fs-1 d-block mb-3"></i>

                                    <h6>No activity logs yet.</h6>

                                    <p class="mb-0">
                                        User activities will appear here.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())

            <div class="mt-4">
                {{ $logs->links() }}
            </div>

        @endif

    </div>

</div>

@endsection