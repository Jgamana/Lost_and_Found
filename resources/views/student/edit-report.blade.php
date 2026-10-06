@extends('layouts.app')

@section('title', 'Edit Report')

@section('page-title', 'Edit Lost Item Report')

@section('content')

<style>
    .edit-lost-page {
        --teal: #365c5a;
        --teal-dark: #294947;
        --gold: #d6a51d;
        --border: #e4eceb;
        --text: #263b3a;
        --muted: #7b8d8b;
    }

    .edit-lost-header {
        margin-bottom: 24px;
    }

    .edit-lost-label {
        color: var(--gold);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .edit-lost-title {
        color: var(--text);
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .edit-lost-description {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 0;
    }

    .edit-lost-card {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 6px 20px rgba(41, 73, 71, 0.04);
    }

    .edit-lost-section-header {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding-bottom: 20px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--border);
    }

    .edit-lost-section-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #eef5f3;
        color: var(--teal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .edit-lost-section-title {
        color: var(--text);
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .edit-lost-section-text {
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 0;
    }

    .edit-lost-form .form-label {
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .edit-lost-form .form-control,
    .edit-lost-form .form-select {
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        font-size: 13px;
        padding: 11px 13px;
        box-shadow: none;
    }

    .edit-lost-form .form-control:focus,
    .edit-lost-form .form-select:focus {
        border-color: #b8d0cc;
        box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
    }

    .edit-lost-form textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }

    .edit-lost-form .form-text {
        color: var(--muted);
        font-size: 11px;
        margin-top: 6px;
    }

    .edit-lost-error {
        color: #bd5555;
        font-size: 11px;
        margin-top: 5px;
    }

    .edit-lost-current-photo {
        margin-top: 4px;
        padding: 14px;
        background: #f7faf9;
        border: 1px solid var(--border);
        border-radius: 14px;
        width: fit-content;
        max-width: 100%;
    }

    .edit-lost-current-photo img {
        display: block;
        width: 220px;
        height: 180px;
        max-width: 100%;
        object-fit: contain;
        border-radius: 10px;
        background: #ffffff;
    }

    .edit-lost-divider {
        height: 1px;
        background: var(--border);
        margin: 24px 0;
    }

    .edit-lost-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        padding-top: 4px;
    }

    .edit-lost-cancel {
        border: 1px solid var(--border);
        background: #f7f9f9;
        color: #667574;
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 600;
    }

    .edit-lost-cancel:hover {
        background: #eef2f1;
        color: var(--text);
    }

    .edit-lost-submit {
        border: none;
        background: var(--teal);
        color: #ffffff;
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .edit-lost-submit:hover {
        background: var(--teal-dark);
        color: #ffffff;
    }

    @media (max-width: 768px) {
        .edit-lost-title {
            font-size: 26px;
        }

        .edit-lost-card {
            padding: 20px;
            border-radius: 17px;
        }

        .edit-lost-actions {
            flex-direction: column-reverse;
        }

        .edit-lost-cancel,
        .edit-lost-submit {
            width: 100%;
        }
    }
</style>

<div class="edit-lost-page">

    <div class="edit-lost-header">
        <div class="edit-lost-label">
            Lost & Found
        </div>

        <h1 class="edit-lost-title">
            Edit Lost Item Report
        </h1>

        <p class="edit-lost-description">
            Update the details of your lost item report.
        </p>
    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-xl-9">

            <div class="edit-lost-card">

                <div class="edit-lost-section-header">

                    <div class="edit-lost-section-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>
                        <h5 class="edit-lost-section-title">
                            Edit Item Information
                        </h5>

                        <p class="edit-lost-section-text">
                            Update the information below.
                        </p>
                    </div>

                </div>

                <form
                    action="{{ route('student.report-update', $lostItem->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="edit-lost-form"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">
                            Item Name
                        </label>

                        <input
                            type="text"
                            name="item_name"
                            class="form-control"
                            value="{{ old('item_name', $lostItem->item_name) }}"
                            required
                        >

                        @error('item_name')
                            <div class="edit-lost-error">
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
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $lostItem->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                            <option
                                value="custom"
                                {{ old('category_id', $lostItem->custom_category ? 'custom' : '') == 'custom' ? 'selected' : '' }}
                            >
                                Other / Custom Category
                            </option>

                        </select>

                        @error('category_id')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div
                        class="mb-3"
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
                            value="{{ old('custom_category', $lostItem->custom_category) }}"
                        >

                        @error('custom_category')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Location
                        </label>

                        <select
                            name="location_id"
                            id="location_id"
                            class="form-select"
                        >

                            <option value="">
                                Select Location
                            </option>

                            @foreach($locations as $location)

                                <option
                                    value="{{ $location->id }}"
                                    {{ old('location_id', $lostItem->location_id) == $location->id ? 'selected' : '' }}
                                >
                                    {{ $location->name }}
                                </option>

                            @endforeach

                            <option
                                value="custom"
                                {{ old('location_id', $lostItem->custom_location ? 'custom' : '') == 'custom' ? 'selected' : '' }}
                            >
                                Other / Custom Location
                            </option>

                        </select>

                        @error('location_id')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div
                        class="mb-3"
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
                            placeholder="Enter the specific location"
                            value="{{ old('custom_location', $lostItem->custom_location) }}"
                        >

                        @error('custom_location')
                            <div class="edit-lost-error">
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
                            value="{{ old('lost_date', optional($lostItem->lost_date)->format('Y-m-d')) }}"
                            required
                        >

                        @error('lost_date')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="5"
                            required
                        >{{ old('description', $lostItem->description) }}</textarea>

                        @error('description')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Maximum Compensation Willing to Give
                            <span style="color: var(--muted); font-weight: 400;">
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
                                value="{{ old('compensation_offer', $lostItem->compensation_offer) }}"
                                min="0"
                                step="0.01"
                                placeholder="Example: 100.00"
                            >

                        </div>

                        <div class="form-text">
                            Leave blank if you are not willing to offer compensation.
                        </div>

                        @error('compensation_offer')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    @if($lostItem->image)

                        <div class="mb-3">

                            <label class="form-label">
                                Current Photo
                            </label>

                            <div class="edit-lost-current-photo">

                                <img
                                    src="{{ asset('storage/' . $lostItem->image) }}"
                                    alt="{{ $lostItem->item_name }}"
                                >

                            </div>

                        </div>

                    @endif

                    <div class="mb-4">

                        <label class="form-label">
                            Replace Photo
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="form-text">
                            Optional. Leave empty to keep the current photo.
                            Maximum size: 5 MB.
                        </div>

                        @error('image')
                            <div class="edit-lost-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="edit-lost-divider"></div>

                    <div class="edit-lost-actions">

                        <a
                            href="{{ route('student.report-details', $lostItem->id) }}"
                            class="btn edit-lost-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn edit-lost-submit"
                        >
                            <i class="bi bi-check-lg me-1"></i>
                            Update Report
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

    const customCategoryInput =
        document.getElementById('custom_category');

    const locationSelect =
        document.getElementById('location_id');

    const customLocationGroup =
        document.getElementById('custom-location-group');

    const customLocationInput =
        document.getElementById('custom_location');

    function toggleCustomCategory() {

        if (!categorySelect || !customCategoryGroup) {
            return;
        }

        if (categorySelect.value === 'custom') {

            customCategoryGroup.style.display = 'block';

            if (customCategoryInput) {
                customCategoryInput.required = true;
            }

        } else {

            customCategoryGroup.style.display = 'none';

            if (customCategoryInput) {
                customCategoryInput.required = false;
            }
        }
    }

    function toggleCustomLocation() {

        if (!locationSelect || !customLocationGroup) {
            return;
        }

        if (locationSelect.value === 'custom') {

            customLocationGroup.style.display = 'block';

            if (customLocationInput) {
                customLocationInput.required = true;
            }

        } else {

            customLocationGroup.style.display = 'none';

            if (customLocationInput) {
                customLocationInput.required = false;
            }
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