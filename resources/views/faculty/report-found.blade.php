@extends('layouts.app')

@section('title', 'Report Found Item')

@section('content')

<style>

.report-found-page {
    --teal: #365c5a;
    --teal-dark: #294947;
    --gold: #d6a51d;
    --border: #e4eceb;
    --text: #263b3a;
    --muted: #7b8d8b;
}

.report-found-heading {
    margin-bottom: 24px;
}

.report-found-label {
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.report-found-title {
    color: var(--text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.report-found-description {
    color: var(--muted);
    font-size: 14px;
    margin-bottom: 0;
}

.report-found-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.report-found-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 6px 22px rgba(41, 73, 71, 0.045);
    overflow: hidden;
}

.report-found-card-header {
    padding: 22px 24px;
    border-bottom: 1px solid var(--border);
    background: #fbfcfc;
}

.report-found-section {
    display: flex;
    align-items: center;
    gap: 12px;
}

.report-found-section-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: #e8f2f0;
    color: var(--teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.report-found-section-title {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 3px;
}

.report-found-section-text {
    color: var(--muted);
    font-size: 12px;
    margin-bottom: 0;
}

.report-found-card-body {
    padding: 26px 24px;
}

.report-found-form-group {
    margin-bottom: 20px;
}

.report-found-form-label {
    display: block;
    color: var(--text);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 7px;
}

.report-found-form-control,
.report-found-form-select {
    width: 100%;
    min-height: 45px;
    border: 1px solid var(--border);
    border-radius: 11px;
    padding: 10px 13px;
    background: #ffffff;
    color: var(--text);
    font-size: 13px;
    outline: none;
    transition: 0.2s ease;
}

.report-found-form-control::placeholder {
    color: #a1adab;
}

.report-found-form-control:focus,
.report-found-form-select:focus {
    border-color: #a9c5c0;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

textarea.report-found-form-control {
    min-height: 125px;
    resize: vertical;
}

.report-found-file {
    padding: 9px 12px;
}

.report-found-help {
    color: var(--muted);
    font-size: 11px;
    margin-top: 6px;
}

.report-found-error {
    color: #bd5555;
    font-size: 11px;
    margin-top: 6px;
}

.report-found-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    padding-top: 5px;
}

.report-found-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 0 18px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: #f7f9f9;
    color: #687875;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.report-found-cancel:hover {
    background: #eef2f1;
    color: var(--text);
}

.report-found-submit {
    min-height: 42px;
    padding: 0 19px;
    border: none;
    border-radius: 10px;
    background: var(--teal);
    color: #ffffff;
    font-size: 12px;
    font-weight: 600;
    transition: 0.2s ease;
}

.report-found-submit:hover {
    background: var(--teal-dark);
}

.report-found-submit i {
    margin-right: 5px;
}

.report-found-alert {
    border-radius: 11px;
    font-size: 12px;
    margin-bottom: 18px;
}

@media (max-width: 767px) {

    .report-found-title {
        font-size: 26px;
    }

    .report-found-description {
        font-size: 13px;
    }

    .report-found-card-header {
        padding: 19px;
    }

    .report-found-card-body {
        padding: 21px 19px;
    }

    .report-found-actions {
        flex-direction: column-reverse;
    }

    .report-found-cancel,
    .report-found-submit {
        width: 100%;
    }

}

</style>


<div class="report-found-page">

    <div class="report-found-heading">

        <div class="report-found-label">
            Lost & Found
        </div>

        <h1 class="report-found-title">
            Report Found Item
        </h1>

        <p class="report-found-description">
            Provide the details of the item you found so the owner can be identified.
        </p>

    </div>


    @if(session('error'))

        <div class="alert alert-danger report-found-alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
        </div>

    @endif


    @if(session('success'))

        <div class="alert alert-success report-found-alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger report-found-alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            Please correct the following errors:

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="report-found-wrapper">

        <div class="report-found-card">

            <div class="report-found-card-header">

                <div class="report-found-section">

                    <div class="report-found-section-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>

                        <div class="report-found-section-title">
                            Found Item Information
                        </div>

                        <p class="report-found-section-text">
                            Fill in the details below to submit your found item report.
                        </p>

                    </div>

                </div>

            </div>


            <div class="report-found-card-body">

                <form
                    action="{{ auth()->user()->role === 'admin'
                        ? url('/admin/report-found')
                        : url('/faculty/report-found') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    {{-- Item Name --}}

                    <div class="report-found-form-group">

                        <label
                            for="item_name"
                            class="report-found-form-label"
                        >
                            Item Name
                        </label>

                        <input
                            type="text"
                            name="item_name"
                            id="item_name"
                            class="report-found-form-control"
                            placeholder="Example: Black Wallet"
                            value="{{ old('item_name') }}"
                            required
                        >

                        @error('item_name')

                            <div class="report-found-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Category --}}

                    <div class="report-found-form-group">

                        <label
                            for="category_id"
                            class="report-found-form-label"
                        >
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="report-found-form-select"
                            required
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')

                            <div class="report-found-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Location --}}

                    <div class="report-found-form-group">

                        <label
                            for="location_id"
                            class="report-found-form-label"
                        >
                            Location
                        </label>

                        <select
                            name="location_id"
                            id="location_id"
                            class="report-found-form-select"
                            required
                        >

                            <option value="">
                                Select Location
                            </option>

                            @foreach($locations as $location)

                                <option
                                    value="{{ $location->id }}"
                                    {{ old('location_id') == $location->id ? 'selected' : '' }}
                                >
                                    {{ $location->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('location_id')

                            <div class="report-found-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Date Found --}}

                    <div class="report-found-form-group">

                        <label
                            for="found_date"
                            class="report-found-form-label"
                        >
                            Date Found
                        </label>

                        <input
                            type="date"
                            name="found_date"
                            id="found_date"
                            class="report-found-form-control"
                            value="{{ old('found_date') }}"
                            required
                        >

                        @error('found_date')

                            <div class="report-found-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Description --}}

                    <div class="report-found-form-group">

                        <label
                            for="description"
                            class="report-found-form-label"
                        >
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            class="report-found-form-control"
                            placeholder="Describe the item, including its color, brand, or other identifying details."
                            required
                        >{{ old('description') }}</textarea>

                        @error('description')

                            <div class="report-found-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Image --}}

                    <div class="report-found-form-group">

                        <label
                            for="image"
                            class="report-found-form-label"
                        >
                            Item Photo
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="form-control report-found-form-control report-found-file"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="report-found-help">
                            Optional. JPG, JPEG, PNG, or WEBP. Maximum size: 5 MB.
                        </div>

                        @error('image')

                            <div class="report-found-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Buttons --}}

                    <div class="report-found-actions">

                        <a
                            href="{{ auth()->user()->role === 'admin'
                                ? url('/admin/dashboard')
                                : url('/faculty/dashboard') }}"
                            class="report-found-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="report-found-submit"
                        >
                            <i class="bi bi-send"></i>
                            Submit Report
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection