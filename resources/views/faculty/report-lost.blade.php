@extends('layouts.app')

@section('title', 'Report Lost Item')

@section('content')

<style>
.report-lost-page {
    --teal: #365c5a;
    --teal-dark: #294947;
    --gold: #d6a51d;
    --border: #e4eceb;
    --text: #263b3a;
    --muted: #7b8d8b;
}

.report-lost-heading {
    margin-bottom: 24px;
}

.report-lost-label {
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.report-lost-title {
    color: var(--text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.report-lost-description {
    color: var(--muted);
    font-size: 14px;
    margin-bottom: 0;
}

.report-lost-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.report-lost-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 6px 22px rgba(41, 73, 71, 0.045);
    overflow: hidden;
}

.report-lost-card-header {
    padding: 22px 24px;
    border-bottom: 1px solid var(--border);
    background: #fbfcfc;
}

.report-lost-section {
    display: flex;
    align-items: center;
    gap: 12px;
}

.report-lost-section-icon {
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

.report-lost-section-title {
    color: var(--text);
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 3px;
}

.report-lost-section-text {
    color: var(--muted);
    font-size: 12px;
    margin-bottom: 0;
}

.report-lost-card-body {
    padding: 26px 24px;
}

.report-lost-form-group {
    margin-bottom: 20px;
}

.report-lost-form-label {
    display: block;
    color: var(--text);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 7px;
}

.report-lost-form-control,
.report-lost-form-select {
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

.report-lost-form-control::placeholder {
    color: #a1adab;
}

.report-lost-form-control:focus,
.report-lost-form-select:focus {
    border-color: #a9c5c0;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

textarea.report-lost-form-control {
    min-height: 125px;
    resize: vertical;
}

.report-lost-file {
    padding: 9px 12px;
}

.report-lost-help {
    color: var(--muted);
    font-size: 11px;
    margin-top: 6px;
}

.report-lost-error {
    color: #bd5555;
    font-size: 11px;
    margin-top: 6px;
}

.report-lost-alert {
    border-radius: 11px;
    font-size: 12px;
    margin-bottom: 18px;
}

.report-lost-compensation {
    padding: 14px;
    background: #fbfcfc;
    border: 1px solid var(--border);
    border-radius: 11px;
}

.report-lost-compensation-input {
    display: flex;
    align-items: stretch;
}

.report-lost-currency {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    padding: 0 13px;
    background: #f1f6f5;
    border: 1px solid var(--border);
    border-right: none;
    border-radius: 11px 0 0 11px;
    color: var(--teal);
    font-size: 13px;
    font-weight: 700;
}

.report-lost-compensation-input .report-lost-form-control {
    border-radius: 0 11px 11px 0;
}

.report-lost-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    padding-top: 5px;
}

.report-lost-cancel {
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

.report-lost-cancel:hover {
    background: #eef2f1;
    color: var(--text);
}

.report-lost-submit {
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

.report-lost-submit:hover {
    background: var(--teal-dark);
}

.report-lost-submit i {
    margin-right: 5px;
}

.report-lost-custom {
    display: none;
}

@media (max-width: 767px) {
    .report-lost-title {
        font-size: 26px;
    }

    .report-lost-description {
        font-size: 13px;
    }

    .report-lost-card-header {
        padding: 19px;
    }

    .report-lost-card-body {
        padding: 21px 19px;
    }

    .report-lost-actions {
        flex-direction: column-reverse;
    }

    .report-lost-cancel,
    .report-lost-submit {
        width: 100%;
    }
}
</style>

<div class="report-lost-page">

    <div class="report-lost-heading">

        <div class="report-lost-label">
            Lost & Found
        </div>

        <h1 class="report-lost-title">
            Report Lost Item
        </h1>

        <p class="report-lost-description">
            Report an item you have lost so it can be monitored and matched with found items.
        </p>

    </div>

    @if($errors->any())

        <div class="alert alert-danger report-lost-alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            <strong>Please check the following:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="report-lost-wrapper">

        <div class="report-lost-card">

            <div class="report-lost-card-header">

                <div class="report-lost-section">

                    <div class="report-lost-section-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>

                        <div class="report-lost-section-title">
                            Lost Item Information
                        </div>

                        <p class="report-lost-section-text">
                            Provide accurate details about the item you lost.
                        </p>

                    </div>

                </div>

            </div>

            <div class="report-lost-card-body">

                <form
                    action="{{ auth()->user()->role === 'admin'
                        ? url('/admin/report-lost')
                        : url('/faculty/report-lost') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="report-lost-form-group">

                        <label
                            for="item_name"
                            class="report-lost-form-label"
                        >
                            Item Name
                        </label>

                        <input
                            type="text"
                            name="item_name"
                            id="item_name"
                            class="report-lost-form-control"
                            value="{{ old('item_name') }}"
                            placeholder="Example: Black Wallet"
                            required
                        >

                        @error('item_name')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="report-lost-form-group">

                        <label
                            for="category_id"
                            class="report-lost-form-label"
                        >
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="report-lost-form-select"
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
                                {{ old('category_id') === 'custom' ? 'selected' : '' }}
                            >
                                Other / Custom Category
                            </option>

                        </select>

                        @error('category_id')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div
                        class="report-lost-form-group report-lost-custom"
                        id="custom-category-container"
                    >

                        <label
                            for="custom_category"
                            class="report-lost-form-label"
                        >
                            Custom Category
                        </label>

                        <input
                            type="text"
                            name="custom_category"
                            id="custom_category"
                            class="report-lost-form-control"
                            value="{{ old('custom_category') }}"
                            placeholder="Example: Calculator"
                        >

                        <div class="report-lost-help">
                            Enter the category if it is not available in the list.
                        </div>

                        @error('custom_category')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="report-lost-form-group">

                        <label
                            for="location_id"
                            class="report-lost-form-label"
                        >
                            Location Where Item Was Lost
                        </label>

                        <select
                            name="location_id"
                            id="location_id"
                            class="report-lost-form-select"
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
                                {{ old('location_id') === 'custom' ? 'selected' : '' }}
                            >
                                Other / Custom Location
                            </option>

                        </select>

                        @error('location_id')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div
                        class="report-lost-form-group report-lost-custom"
                        id="custom-location-container"
                    >

                        <label
                            for="custom_location"
                            class="report-lost-form-label"
                        >
                            Specific Location
                        </label>

                        <input
                            type="text"
                            name="custom_location"
                            id="custom_location"
                            class="report-lost-form-control"
                            value="{{ old('custom_location') }}"
                            placeholder="Example: 2nd Floor, Room 204"
                        >

                        <div class="report-lost-help">
                            Enter the specific location if it is not available in the list.
                        </div>

                        @error('custom_location')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="report-lost-form-group">

                        <label
                            for="lost_date"
                            class="report-lost-form-label"
                        >
                            Date Lost
                        </label>

                        <input
                            type="date"
                            name="lost_date"
                            id="lost_date"
                            class="report-lost-form-control"
                            value="{{ old('lost_date') }}"
                            required
                        >

                        @error('lost_date')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="report-lost-form-group">

                        <label
                            for="description"
                            class="report-lost-form-label"
                        >
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="report-lost-form-control"
                            placeholder="Describe the item's color, brand, size, identifying marks, and other details."
                            required
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="report-lost-form-group">

                        <div class="report-lost-compensation">

                            <label
                                for="compensation_offer"
                                class="report-lost-form-label"
                            >
                                Maximum Compensation Willing to Give

                                <span style="color: var(--muted); font-weight: 400;">
                                    (Optional)
                                </span>

                            </label>

                            <div class="report-lost-compensation-input">

                                <span class="report-lost-currency">
                                    ₱
                                </span>

                                <input
                                    type="number"
                                    name="compensation_offer"
                                    id="compensation_offer"
                                    class="report-lost-form-control"
                                    value="{{ old('compensation_offer') }}"
                                    min="0"
                                    step="0.01"
                                    placeholder="Example: 100.00"
                                >

                            </div>

                            <div class="report-lost-help">
                                Leave blank if you are not willing to offer compensation.
                            </div>

                            @error('compensation_offer')

                                <div class="report-lost-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <div class="report-lost-form-group">

                        <label
                            for="image"
                            class="report-lost-form-label"
                        >
                            Item Image

                            <span style="color: var(--muted); font-weight: 400;">
                                (Optional)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="form-control report-lost-form-control report-lost-file"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="report-lost-help">
                            Accepted formats: JPG, JPEG, PNG, WEBP. Maximum size: 5MB.
                        </div>

                        @error('image')
                            <div class="report-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="report-lost-actions">

                        <a
                            href="{{ auth()->user()->role === 'admin'
                                ? url('/admin/dashboard')
                                : url('/faculty/dashboard') }}"
                            class="report-lost-cancel"
                        >
                            <i class="bi bi-arrow-left me-1"></i>
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="report-lost-submit"
                        >
                            <i class="bi bi-send"></i>
                            Submit Lost Report
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category_id');
    const customCategoryContainer = document.getElementById('custom-category-container');
    const customCategoryInput = document.getElementById('custom_category');

    const locationSelect = document.getElementById('location_id');
    const customLocationContainer = document.getElementById('custom-location-container');
    const customLocationInput = document.getElementById('custom_location');


    function toggleCustomCategory() {

        if (!categorySelect || !customCategoryContainer || !customCategoryInput) {
            return;
        }

        if (categorySelect.value === 'custom') {

            customCategoryContainer.style.display = 'block';
            customCategoryInput.required = true;

        } else {

            customCategoryContainer.style.display = 'none';
            customCategoryInput.required = false;

        }
    }


    function toggleCustomLocation() {

        if (!locationSelect || !customLocationContainer || !customLocationInput) {
            return;
        }

        if (locationSelect.value === 'custom') {

            customLocationContainer.style.display = 'block';
            customLocationInput.required = true;

        } else {

            customLocationContainer.style.display = 'none';
            customLocationInput.required = false;

        }
    }


    if (categorySelect) {

        categorySelect.addEventListener(
            'change',
            toggleCustomCategory
        );

        toggleCustomCategory();

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