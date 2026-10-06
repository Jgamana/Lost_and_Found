@extends('layouts.app')

@section('title', 'Report Lost Item')

@section('content')

<style>

.student-report-lost-page {
    --lost-teal: #365c5a;
    --lost-teal-dark: #294947;
    --lost-gold: #d6a51d;
    --lost-border: #e4eceb;
    --lost-text: #263b3a;
    --lost-muted: #7b8d8b;
    --lost-light: #eef5f3;
}

.student-report-lost-page .page-heading {
    margin-bottom: 24px;
}

.student-report-lost-page .page-label {
    color: var(--lost-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-report-lost-page .page-heading h1 {
    color: var(--lost-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-report-lost-page .page-heading p {
    color: var(--lost-muted);
    font-size: 14px;
    margin-bottom: 0;
}

.student-report-lost-card {
    background: #ffffff;
    border: 1px solid var(--lost-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    padding: 25px;
}

.student-report-lost-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding-bottom: 20px;
    margin-bottom: 23px;
    border-bottom: 1px solid var(--lost-border);
}

.student-report-lost-header-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    border-radius: 13px;
    background: var(--lost-light);
    color: var(--lost-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.student-report-lost-title {
    color: var(--lost-text);
    font-size: 17px;
    font-weight: 700;
    margin: 2px 0 4px;
}

.student-report-lost-subtitle {
    color: var(--lost-muted);
    font-size: 12px;
    margin: 0;
}

.student-report-lost-form {
    width: 100%;
}

.student-report-lost-form .form-label {
    color: var(--lost-text);
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 7px;
}

.student-report-lost-form .form-control,
.student-report-lost-form .form-select {
    min-height: 43px;
    border: 1px solid #d8e4e2;
    border-radius: 10px;
    color: var(--lost-text);
    background: #ffffff;
    font-size: 12px;
    padding: 9px 12px;
    box-shadow: none;
    transition: 0.2s ease;
}

.student-report-lost-form .form-control:focus,
.student-report-lost-form .form-select:focus {
    border-color: var(--lost-teal);
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.08);
}

.student-report-lost-form textarea.form-control {
    min-height: 125px;
    resize: vertical;
    line-height: 1.6;
}

.student-report-lost-form .form-control::placeholder {
    color: #a4b1af;
}

.student-report-lost-form .form-text {
    color: var(--lost-muted);
    font-size: 10px;
    margin-top: 6px;
}

.student-report-lost-error {
    color: #bd5555;
    font-size: 10px;
    margin-top: 5px;
}

.lost-form-section {
    margin-bottom: 24px;
}

.lost-form-section:last-of-type {
    margin-bottom: 0;
}

.lost-form-section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--lost-text);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px;
}

.lost-form-section-title i {
    color: var(--lost-teal);
}

.lost-custom-field {
    padding: 11px 13px;
    margin-top: -3px;
    margin-bottom: 15px;
    background: #fbfcfc;
    border: 1px solid var(--lost-border);
    border-radius: 10px;
}

.student-report-lost-compensation {
    padding: 14px;
    background: #fbfcfc;
    border: 1px solid var(--lost-border);
    border-radius: 11px;
}

.student-report-lost-compensation .input-group-text {
    min-width: 42px;
    justify-content: center;
    background: #f1f6f5;
    border-color: #d8e4e2;
    color: var(--lost-teal);
    font-size: 13px;
    font-weight: 700;
}

.student-report-lost-compensation .form-control {
    border-radius: 0 10px 10px 0;
}

.student-report-lost-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    margin-top: 27px;
    padding-top: 20px;
    border-top: 1px solid var(--lost-border);
}

.student-report-lost-cancel,
.student-report-lost-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 40px;
    padding: 0 17px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    transition: 0.2s ease;
}

.student-report-lost-cancel {
    background: #f5f7f7;
    border-color: var(--lost-border);
    color: #64716f;
}

.student-report-lost-cancel:hover {
    background: #edf2f1;
    color: var(--lost-text);
}

.student-report-lost-submit {
    background: var(--lost-teal);
    color: #ffffff;
}

.student-report-lost-submit:hover {
    background: var(--lost-teal-dark);
    color: #ffffff;
}

@media (max-width: 767px) {

    .student-report-lost-page .page-heading h1 {
        font-size: 26px;
    }

    .student-report-lost-card {
        padding: 18px;
    }

    .student-report-lost-actions {
        flex-direction: column-reverse;
    }

    .student-report-lost-cancel,
    .student-report-lost-submit {
        width: 100%;
    }

}

</style>

<div class="student-report-lost-page">

    <div class="page-heading">

        <div class="page-label">
            Lost & Found
        </div>

        <h1>
            Report Lost Item
        </h1>

        <p>
            Provide the details of the item you lost so it can be easier to find.
        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-xl-9">

            <div class="student-report-lost-card">

                <div class="student-report-lost-header">

                    <div class="student-report-lost-header-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>

                        <h5 class="student-report-lost-title">
                            Lost Item Information
                        </h5>

                        <p class="student-report-lost-subtitle">
                            Fill in the details below.
                        </p>

                    </div>

                </div>

                <form
                    action="{{ url('/student/report-lost') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="student-report-lost-form"
                >

                    @csrf

                    <div class="lost-form-section">

                        <div class="lost-form-section-title">
                            <i class="bi bi-box"></i>
                            Item Information
                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Item Name
                            </label>

                            <input
                                type="text"
                                name="item_name"
                                class="form-control"
                                placeholder="Example: Black Wallet"
                                value="{{ old('item_name') }}"
                                required
                            >

                            @error('item_name')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Category
                            </label>

                            <select
                                name="category_id"
                                id="category_id"
                                class="form-select"
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

                                <option
                                    value="custom"
                                    {{ old('category_id') == 'custom' ? 'selected' : '' }}
                                >
                                    Other / Custom Category
                                </option>

                            </select>

                            @error('category_id')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div
                            class="lost-custom-field"
                            id="custom-category-group"
                            style="display: none;"
                        >

                            <label class="form-label">
                                Custom Category
                            </label>

                            <input
                                type="text"
                                name="custom_category"
                                id="custom_category"
                                class="form-control"
                                placeholder="Enter your category"
                                value="{{ old('custom_category') }}"
                            >

                            @error('custom_category')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                    <div class="lost-form-section">

                        <div class="lost-form-section-title">
                            <i class="bi bi-geo-alt"></i>
                            Location & Date
                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Location
                            </label>

                            <select
                                name="location_id"
                                id="location_id"
                                class="form-select"
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

                                <option
                                    value="custom"
                                    {{ old('location_id') == 'custom' ? 'selected' : '' }}
                                >
                                    Other / Custom Location
                                </option>

                            </select>

                            @error('location_id')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div
                            class="lost-custom-field"
                            id="custom-location-group"
                            style="display: none;"
                        >

                            <label class="form-label">
                                Specific Location
                            </label>

                            <input
                                type="text"
                                name="custom_location"
                                id="custom_location"
                                class="form-control"
                                placeholder="Example: 2nd Floor, Room 204"
                                value="{{ old('custom_location') }}"
                            >

                            @error('custom_location')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Date Lost
                            </label>

                            <input
                                type="date"
                                name="lost_date"
                                class="form-control"
                                value="{{ old('lost_date') }}"
                                required
                            >

                            @error('lost_date')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                    <div class="lost-form-section">

                        <div class="lost-form-section-title">
                            <i class="bi bi-card-text"></i>
                            Additional Information
                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                placeholder="Describe the item, including its color, brand, or other identifying details."
                                required
                            >{{ old('description') }}</textarea>

                            @error('description')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="student-report-lost-compensation mb-3">

                            <label class="form-label">
                                Maximum Compensation Willing to Give
                                <span style="color: var(--lost-muted); font-weight: 400;">
                                    (Optional)
                                </span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₱
                                </span>

                                <input
                                    type="number"
                                    name="compensation_offer"
                                    class="form-control"
                                    value="{{ old('compensation_offer') }}"
                                    min="0"
                                    step="0.01"
                                    placeholder="Example: 100.00"
                                >

                            </div>

                            <div class="form-text">
                                Leave blank if you are not willing to offer compensation.
                            </div>

                            @error('compensation_offer')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Item Photo
                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="form-text">
                                Optional. JPG, JPEG, PNG, or WEBP.
                                Maximum size: 5 MB.
                            </div>

                            @error('image')

                                <div class="student-report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                    <div class="student-report-lost-actions">

                        <a
                            href="{{ url('/student/dashboard') }}"
                            class="student-report-lost-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="student-report-lost-submit"
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

<script>

document.addEventListener('DOMContentLoaded', function () {

    const categorySelect =
        document.getElementById('category_id');

    const customCategoryGroup =
        document.getElementById('custom-category-group');

    function toggleCustomCategory() {

        if (!categorySelect || !customCategoryGroup) {
            return;
        }

        if (categorySelect.value === 'custom') {

            customCategoryGroup.style.display = 'block';

        } else {

            customCategoryGroup.style.display = 'none';

        }

    }

    if (categorySelect) {

        categorySelect.addEventListener(
            'change',
            toggleCustomCategory
        );

        toggleCustomCategory();

    }

    const locationSelect =
        document.getElementById('location_id');

    const customLocationGroup =
        document.getElementById('custom-location-group');

    function toggleCustomLocation() {

        if (!locationSelect || !customLocationGroup) {
            return;
        }

        if (locationSelect.value === 'custom') {

            customLocationGroup.style.display = 'block';

        } else {

            customLocationGroup.style.display = 'none';

        }

    }

    if (locationSelect) {

        locationSelect.addEventListener(
            'change',
            toggleCustomLocation
        );

        toggleCustomLocation();

    }

});

</script>

@endsection