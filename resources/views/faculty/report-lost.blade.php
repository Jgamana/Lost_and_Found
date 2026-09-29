@extends('layouts.app')

@section('title', 'Report Lost Item')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Lost & Found
    </div>

    <h1>
        Report Lost Item
    </h1>

    <p>
        Report an item you have lost so it can be monitored and matched with found items.
    </p>

</div>


{{-- ERROR MESSAGE --}}
@if($errors->any())

    <div class="alert alert-danger">

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


<div class="modern-card p-4">

    <div class="section-header mb-4">

        <div>

            <h5>
                <i class="bi bi-search me-2"></i>
                Lost Item Information
            </h5>

            <p>
                Provide accurate details about the item you lost.
            </p>

        </div>

    </div>


    <form
        action="{{ auth()->user()->role === 'admin' ? url('/admin/report-lost') : url('/faculty/report-lost') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- ITEM NAME --}}
        <div class="mb-3">

            <label
                for="item_name"
                class="form-label fw-semibold"
            >
                Item Name
            </label>

            <input
                type="text"
                name="item_name"
                id="item_name"
                class="form-control"
                value="{{ old('item_name') }}"
                placeholder="Example: Black Wallet"
                required
            >

        </div>


        {{-- CATEGORY --}}
        <div class="mb-3">

            <label
                for="category_id"
                class="form-label fw-semibold"
            >
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

                <option value="custom">
                    Other / Custom Category
                </option>

            </select>

        </div>


        {{-- CUSTOM CATEGORY --}}
        <div
            class="mb-3"
            id="custom-category-container"
            style="display: none;"
        >

            <label
                for="custom_category"
                class="form-label fw-semibold"
            >
                Custom Category
            </label>

            <input
                type="text"
                name="custom_category"
                id="custom_category"
                class="form-control"
                value="{{ old('custom_category') }}"
                placeholder="Enter your category"
            >

        </div>


        {{-- LOCATION --}}
        <div class="mb-3">

            <label
                for="location_id"
                class="form-label fw-semibold"
            >
                Location Where Item Was Lost
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

            </select>

        </div>


        {{-- LOST DATE --}}
        <div class="mb-3">

            <label
                for="lost_date"
                class="form-label fw-semibold"
            >
                Date Lost
            </label>

            <input
                type="date"
                name="lost_date"
                id="lost_date"
                class="form-control"
                value="{{ old('lost_date') }}"
                required
            >

        </div>


        {{-- DESCRIPTION --}}
        <div class="mb-3">

            <label
                for="description"
                class="form-label fw-semibold"
            >
                Description
            </label>

            <textarea
                name="description"
                id="description"
                rows="5"
                class="form-control"
                placeholder="Describe the item's color, brand, size, identifying marks, and other details."
                required
            >{{ old('description') }}</textarea>

        </div>


        {{-- IMAGE --}}
        <div class="mb-4">

            <label
                for="image"
                class="form-label fw-semibold"
            >
                Item Image

                <span class="text-muted fw-normal">
                    (Optional)
                </span>

            </label>

            <input
                type="file"
                name="image"
                id="image"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <small class="text-muted">
                Accepted formats: JPG, JPEG, PNG, WEBP. Maximum size: 5MB.
            </small>

        </div>


        {{-- BUTTONS --}}
        <div class="d-flex gap-2">

            <a
                href="{{ auth()->user()->role === 'admin' ? url('/admin/dashboard') : url('/faculty/dashboard') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Cancel
            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="bi bi-send me-1"></i>
                Submit Lost Report
            </button>

        </div>


    </form>

</div>


{{-- CUSTOM CATEGORY SCRIPT --}}
@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const categorySelect =
            document.getElementById('category_id');

        const customCategoryContainer =
            document.getElementById('custom-category-container');

        const customCategoryInput =
            document.getElementById('custom_category');


        function toggleCustomCategory() {

            if (categorySelect.value === 'custom') {

                customCategoryContainer.style.display = 'block';

                customCategoryInput.required = true;

            } else {

                customCategoryContainer.style.display = 'none';

                customCategoryInput.required = false;

                customCategoryInput.value = '';

            }

        }


        categorySelect.addEventListener(
            'change',
            toggleCustomCategory
        );


        toggleCustomCategory();

    });

</script>

@endpush

@endsection