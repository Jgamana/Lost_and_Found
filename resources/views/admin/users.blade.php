@extends('layouts.app')

@section('title', 'User Management')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <div class="d-flex justify-content-between align-items-start">

            <div>

                <h3 class="fw-bold mb-1">
                    User Management
                </h3>

                <p class="text-muted mb-0">
                    View all registered students, faculty, and administrators.
                </p>

            </div>

            <button
                type="button"
                class="btn btn-dark"
                onclick="window.print()"
            >
                <i class="bi bi-printer me-1"></i>
                Print Users
            </button>

        </div>

    </div>


    <div class="modern-card mb-4 no-print">

        <div class="input-group">

            <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
            </span>

            <input
                type="text"
                id="userSearch"
                class="form-control"
                placeholder="Search users by name or email..."
                autocomplete="off"
            >

        </div>

    </div>


    <div class="modern-card" id="printArea">

        <div class="d-none d-print-block text-center mb-4">

            <h4 class="fw-bold mb-1">
                MLG COLLEGE OF LEARNING, INC.
            </h4>

            <h5 class="fw-bold mb-1">
                Web-Based Lost and Found Management System
            </h5>

            <h6 class="fw-bold mb-3">
                USER MANAGEMENT REPORT
            </h6>

            <p class="mb-0">
                Generated on: {{ now()->format('F d, Y h:i A') }}
            </p>

        </div>


        <div class="d-flex justify-content-between align-items-center mb-4 no-print">

            <div>

                <h5 class="fw-bold mb-1">
                    All Users
                </h5>

                <p class="text-muted mb-0">
                    {{ $users->count() }} registered user(s)
                </p>

            </div>

            <div>

                <i
                    class="bi bi-people-fill"
                    style="font-size: 28px; color: #f0786c;"
                ></i>

            </div>

        </div>


        <div class="d-print-none text-muted mb-3">

            {{ $users->count() }} registered user(s)

        </div>


        <div class="table-responsive">

            <table class="table align-middle mb-0">

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

                        <th class="no-print">
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

                                <div class="d-flex align-items-center">

                                    <div
                                        class="d-flex align-items-center justify-content-center me-3 no-print"
                                        style="
                                            width: 40px;
                                            height: 40px;
                                            border-radius: 50%;
                                            background: #f0786c;
                                            color: white;
                                        "
                                    >

                                        <i class="bi bi-person-fill"></i>

                                    </div>


                                    <div>

                                        <div class="fw-semibold">
                                            {{ $user->name }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $user->email }}
                            </td>


                            <td>

                                @if($user->role === 'student')

                                    <span class="badge rounded-pill bg-primary">
                                        Student
                                    </span>

                                @elseif($user->role === 'faculty')

                                    <span class="badge rounded-pill bg-info text-dark">
                                        Faculty
                                    </span>

                                @elseif($user->role === 'admin')

                                    <span class="badge rounded-pill bg-dark">
                                        Admin
                                    </span>

                                @endif

                            </td>


                            <td>

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

                            </td>


                            <td>

                                @if($user->is_active)

                                    <span class="badge rounded-pill bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge rounded-pill bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td>

                                {{ $user->created_at->format('M d, Y') }}

                            </td>


                            <td class="no-print">

                                <a
                                    href="{{ route('admin.user-details', $user->id) }}"
                                    class="btn btn-sm btn-outline-primary mb-1"
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
                                            class="btn btn-sm btn-outline-warning mb-1"
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
                                            class="btn btn-sm btn-outline-success mb-1"
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
                                            class="btn btn-sm btn-outline-danger mb-1"
                                            title="Delete User"
                                            onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <i
                                    class="bi bi-people"
                                    style="font-size: 40px;"
                                ></i>

                                <p class="text-muted mt-3 mb-0">
                                    No users found.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="d-none d-print-block mt-4">

            <p class="mb-1">
                Total Users: {{ $users->count() }}
            </p>

            <p class="mb-0">
                Report generated by: {{ auth()->user()->name }}
            </p>

        </div>

    </div>

</div>


<script>

    const userSearch = document.getElementById('userSearch');

    userSearch.addEventListener('input', function () {

        const searchValue = this.value
            .toLowerCase()
            .trim();

        document
            .querySelectorAll('.user-row')
            .forEach(row => {

                const searchText = row.dataset.search;

                if (searchText.includes(searchValue)) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

    });

</script>


<style>

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

        .table-responsive {
            overflow: visible !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 8px !important;
            color: #000 !important;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        .badge {
            color: #000 !important;
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            font-weight: normal !important;
        }

    }

</style>

@endsection