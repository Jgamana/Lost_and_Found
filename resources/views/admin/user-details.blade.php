@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <a
            href="{{ route('admin.users') }}"
            class="text-decoration-none"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back to Users
        </a>
    </div>

    <div class="modern-card">

        <div class="text-center mb-4">

            <div
                class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                style="
                    width: 90px;
                    height: 90px;
                    border-radius: 50%;
                    background: #f0786c;
                    color: white;
                    font-size: 36px;
                "
            >
                <i class="bi bi-person-fill"></i>
            </div>

            <h3 class="fw-bold mb-1">
                {{ $user->name }}
            </h3>

            <p class="text-muted mb-0">
                {{ $user->email }}
            </p>

        </div>

        <hr>

        <div class="row g-4 mt-2">

            <div class="col-md-4">
                <small class="text-muted d-block">
                    Account Type
                </small>

                <strong>
                    {{ ucfirst($user->role) }}
                </strong>
            </div>

            <div class="col-md-4">
                <small class="text-muted d-block">
                    Account Status
                </small>

                @if($user->status === 'approved')

                    <span class="badge rounded-pill bg-success">
                        Approved
                    </span>

                @elseif($user->status === 'pending')

                    <span class="badge rounded-pill bg-warning text-dark">
                        Pending
                    </span>

                @elseif($user->status === 'rejected')

                    <span class="badge rounded-pill bg-danger">
                        Rejected
                    </span>

                @endif
            </div>

            <div class="col-md-4">
                <small class="text-muted d-block">
                    Member Since
                </small>

                <strong>
                    {{ $user->created_at->format('F d, Y') }}
                </strong>
            </div>

        </div>

    </div>

</div>

@endsection