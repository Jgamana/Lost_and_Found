@extends('layouts.app')

@section('title', 'Faculty Requests')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Administration
    </div>

    <h1>
        Faculty Requests
    </h1>

    <p>
        Review faculty account registrations and approve or reject their requests.
    </p>

</div>


@if($errors->any())
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ $errors->first() }}
    </div>
@endif


<div class="modern-card">

    <div class="section-header mb-4">

        <div>

            <h5>
                <i class="bi bi-person-check me-2"></i>
                Pending Faculty Accounts
            </h5>

            <p>
                These faculty accounts are waiting for administrator approval.
            </p>

        </div>

    </div>


    @forelse($faculty as $user)

        <div class="border rounded-3 p-4 mb-3">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h5 class="mb-1">
                        {{ $user->name }}
                    </h5>

                    <p class="text-muted mb-2">
                        {{ $user->email }}
                    </p>

                    <span class="badge bg-warning text-dark">
                        Pending Approval
                    </span>

                    <small class="text-muted ms-2">
                        Registered {{ $user->created_at->format('M d, Y') }}
                    </small>

                </div>


                <div class="col-md-4 mt-3 mt-md-0">

                    <div class="d-flex gap-2 justify-content-md-end">

                        <!-- Approve -->
                        <form
                            action="{{ route('admin.faculty-approve', $user->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to approve this faculty account?');"
                        >

                            @csrf

                            <button type="submit" class="btn btn-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Approve

                            </button>

                        </form>


                        <!-- Reject -->
                        <form
                            action="{{ route('admin.faculty-reject', $user->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to reject this faculty account?');"
                        >

                            @csrf

                            <button type="submit" class="btn btn-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Reject

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>


    @empty

        <div class="text-center py-5">

            <i
                class="bi bi-person-check text-muted"
                style="font-size: 50px;"
            ></i>

            <h5 class="mt-3">
                No Pending Faculty Requests
            </h5>

            <p class="text-muted mb-0">
                There are currently no faculty accounts waiting for approval.
            </p>

        </div>

    @endforelse

</div>

@endsection