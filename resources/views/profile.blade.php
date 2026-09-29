@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<style>

.faculty-profile {
    --teal: #365c5a;
    --teal-dark: #294947;
    --gold: #d6a51d;
    --gold-light: #fbf2d7;
    --border: #e4eceb;
    --text: #263b3a;
    --muted: #7b8d8b;
}

.faculty-profile .profile-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
}

.faculty-profile .profile-header-card {
    position: relative;
    overflow: hidden;
    background: var(--teal);
    color: white;
    border: none;
    border-radius: 22px;
    padding: 28px;
}

.faculty-profile .profile-header-card::before {
    content: "";
    position: absolute;
    width: 210px;
    height: 210px;
    right: -70px;
    top: -100px;
    border-radius: 50%;
    background: rgba(214,165,29,0.22);
}

.faculty-profile .profile-header-content {
    position: relative;
    z-index: 2;
}

.faculty-profile .profile-avatar {
    width: 82px;
    height: 82px;
    border-radius: 50%;
    background: rgba(255,255,255,0.14);
    border: 2px solid rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 32px;
    margin-bottom: 15px;
}

.faculty-profile .profile-name {
    font-size: 25px;
    font-weight: 700;
    margin-bottom: 4px;
}

.faculty-profile .profile-email {
    color: rgba(255,255,255,0.72);
    font-size: 13px;
    margin-bottom: 6px;
}

.faculty-profile .profile-contact {
    color: rgba(255,255,255,0.72);
    font-size: 13px;
    margin-bottom: 16px;
}

.faculty-profile .profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 13px;
    border-radius: 50px;
    background: rgba(255,255,255,0.13);
    border: 1px solid rgba(255,255,255,0.16);
    color: white;
    font-size: 12px;
    font-weight: 600;
}

.faculty-profile .approved-badge {
    background: rgba(67,131,90,0.9);
}

.faculty-profile .pending-badge {
    background: rgba(214,165,29,0.9);
}

.faculty-profile .rejected-badge {
    background: rgba(190,70,70,0.9);
}

.faculty-profile .section-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px;
}

.faculty-profile .section-header h5 {
    color: var(--text);
    font-weight: 700;
    margin-bottom: 4px;
}

.faculty-profile .section-header p {
    color: var(--muted);
    font-size: 12px;
    margin-bottom: 0;
}

.faculty-profile .section-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 12px;
    background: #e4f0ef;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
}

.faculty-profile .section-icon.gold {
    background: var(--gold-light);
    color: #b68b13;
}

.faculty-profile .account-detail {
    padding: 13px 0;
    border-bottom: 1px solid #edf1f0;
}

.faculty-profile .account-detail:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.faculty-profile .detail-label {
    color: var(--muted);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .5px;
    font-weight: 700;
    margin-bottom: 4px;
}

.faculty-profile .detail-value {
    color: var(--text);
    font-size: 14px;
    font-weight: 600;
}

.faculty-profile .form-label {
    color: var(--text);
    font-size: 13px;
}

.faculty-profile .input-group-text {
    border-color: var(--border);
    color: var(--teal);
    min-width: 43px;
    justify-content: center;
}

.faculty-profile .form-control {
    border-color: var(--border);
    padding: 10px 12px;
    font-size: 13px;
}

.faculty-profile .form-control:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 .2rem rgba(54,92,90,.10);
}

.faculty-profile .save-button {
    background: var(--teal);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
}

.faculty-profile .save-button:hover {
    background: var(--teal-dark);
    color: white;
}

.faculty-profile .password-button {
    background: var(--gold);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
}

.faculty-profile .password-button:hover {
    background: #bd9015;
    color: white;
}

.faculty-profile .security-note {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    background: #f7faf9;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 20px;
}

.faculty-profile .security-note i {
    color: var(--teal);
    font-size: 17px;
}

.faculty-profile .security-note span {
    color: var(--muted);
    font-size: 11px;
    line-height: 1.5;
}

@media (max-width: 768px) {

    .faculty-profile .profile-card {
        padding: 19px;
        border-radius: 17px;
    }

    .faculty-profile .profile-header-card {
        padding: 23px;
        border-radius: 19px;
    }

    .faculty-profile .section-header {
        flex-direction: column;
    }

}

</style>


<div class="faculty-profile">


    <div class="page-heading mb-4">

        <div class="page-label">
            Account
        </div>

        <h1>
            My Profile
        </h1>

        <p>
            Manage your account information and password.
        </p>

    </div>


    <div class="row g-4">


        <div class="col-lg-4">


            <div class="profile-header-card">

                <div class="profile-header-content">

                    <div class="profile-avatar">

                        <i class="bi bi-person-badge"></i>

                    </div>


                    <div class="profile-name">

                        {{ $user->name }}

                    </div>


                    <div class="profile-email">

                        <i class="bi bi-envelope me-1"></i>

                        {{ $user->email }}

                    </div>


                    <div class="profile-contact">

                        <i class="bi bi-telephone me-1"></i>

                        {{ $user->contact_number ?: 'No contact number added' }}

                    </div>


                    <div class="d-flex flex-wrap gap-2">


                        <span class="profile-badge">

                            <i class="bi bi-person-badge"></i>

                            {{ ucfirst($user->role) }}

                        </span>


                        @if($user->status === 'approved')

                            <span class="profile-badge approved-badge">

                                <i class="bi bi-check-circle"></i>

                                Approved

                            </span>

                        @elseif($user->status === 'pending')

                            <span class="profile-badge pending-badge">

                                <i class="bi bi-clock"></i>

                                Pending

                            </span>

                        @elseif($user->status === 'rejected')

                            <span class="profile-badge rejected-badge">

                                <i class="bi bi-x-circle"></i>

                                Rejected

                            </span>

                        @endif


                    </div>

                </div>

            </div>


            <div class="profile-card mt-4">


                <div class="section-header">

                    <div>

                        <h5>
                            Account Information
                        </h5>

                        <p>
                            Your account details.
                        </p>

                    </div>


                    <div class="section-icon">

                        <i class="bi bi-info-circle"></i>

                    </div>

                </div>


                <div class="account-detail">

                    <div class="detail-label">
                        Full Name
                    </div>

                    <div class="detail-value">
                        {{ $user->name }}
                    </div>

                </div>


                <div class="account-detail">

                    <div class="detail-label">
                        Email Address
                    </div>

                    <div class="detail-value">
                        {{ $user->email }}
                    </div>

                </div>


                <div class="account-detail">

                    <div class="detail-label">
                        Contact Number
                    </div>

                    <div class="detail-value">

                        {{ $user->contact_number ?: 'Not provided' }}

                    </div>

                </div>


                <div class="account-detail">

                    <div class="detail-label">
                        Account Type
                    </div>

                    <div class="detail-value">
                        {{ ucfirst($user->role) }}
                    </div>

                </div>


                <div class="account-detail">

                    <div class="detail-label">
                        Account Status
                    </div>

                    <div class="detail-value">
                        {{ ucfirst($user->status) }}
                    </div>

                </div>


                <div class="account-detail">

                    <div class="detail-label">
                        Member Since
                    </div>

                    <div class="detail-value">
                        {{ $user->created_at->format('F d, Y') }}
                    </div>

                </div>


            </div>


        </div>


        <div class="col-lg-8">


            <div class="profile-card mb-4">


                <div class="section-header">

                    <div>

                        <h5>
                            Edit Profile
                        </h5>

                        <p>
                            Update your personal information and contact details.
                        </p>

                    </div>


                    <div class="section-icon">

                        <i class="bi bi-person-gear"></i>

                    </div>

                </div>


                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="mb-4">

                        <label
                            for="name"
                            class="form-label fw-semibold"
                        >
                            Full Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-person"></i>

                            </span>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}"
                                required
                            >

                        </div>

                    </div>


                    <div class="mb-4">

                        <label
                            for="email"
                            class="form-label fw-semibold"
                        >
                            Email Address
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-envelope"></i>

                            </span>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required
                            >

                        </div>

                    </div>


                    <div class="mb-4">

                        <label
                            for="contact_number"
                            class="form-label fw-semibold"
                        >
                            Contact Number
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-telephone"></i>

                            </span>

                            <input
                                type="text"
                                name="contact_number"
                                class="form-control"
                                value="{{ old(
                                    'contact_number',
                                    $user->contact_number
                                ) }}"
                                placeholder="Enter your contact number"
                                maxlength="20"
                            >

                        </div>

                        <small class="text-muted">
                            Provide an active contact number for Lost and Found communication.
                        </small>

                    </div>


                    <button
                        type="submit"
                        class="btn save-button"
                    >

                        <i class="bi bi-save me-2"></i>

                        Save Changes

                    </button>


                </form>


            </div>


            <div class="profile-card">


                <div class="section-header">

                    <div>

                        <h5>
                            Change Password
                        </h5>

                        <p>
                            Keep your account secure with a strong password.
                        </p>

                    </div>


                    <div class="section-icon gold">

                        <i class="bi bi-shield-lock"></i>

                    </div>

                </div>


                <div class="security-note">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Use a strong password with at least 8 characters
                        and avoid using easily guessed information.
                    </span>

                </div>


                <form
                    action="{{ route('profile.password') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="mb-4">

                        <label
                            for="current_password"
                            class="form-label fw-semibold"
                        >
                            Current Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-lock"></i>

                            </span>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control"
                                required
                            >

                        </div>

                    </div>


                    <div class="mb-4">

                        <label
                            for="password"
                            class="form-label fw-semibold"
                        >
                            New Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-shield-lock"></i>

                            </span>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <small class="text-muted">
                            Password must be at least 8 characters.
                        </small>

                    </div>


                    <div class="mb-4">

                        <label
                            for="password_confirmation"
                            class="form-label fw-semibold"
                        >
                            Confirm New Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-shield-check"></i>

                            </span>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required
                            >

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn password-button"
                    >

                        <i class="bi bi-key me-2"></i>

                        Change Password

                    </button>


                </form>


            </div>


        </div>


    </div>


</div>

@endsection