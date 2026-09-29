@extends('layouts.app')

@section('title', 'Report Lost Item')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">Lost & Found</div>

    <h1>Report Lost Item</h1>

    <p>
        Provide the details of the item you lost so it can be easier to find.
    </p>

</div>


<div class="row justify-content-center">

    <div class="col-12 col-xl-9">

        <div class="modern-card p-4">

            <div class="section-header mb-4">

                <div>

                    <h5>
                        <i class="bi bi-search me-2"></i>
                        Lost Item Information
                    </h5>

                    <p>
                        Fill in the details below.
                    </p>

                </div>

            </div>


            <form
                action="{{ url('/student/report-lost') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- ITEM NAME --}}
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- CATEGORY --}}
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- CUSTOM CATEGORY --}}
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
                        value="{{ old('custom_category') }}"
                    >

                    @error('custom_category')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- LOCATION --}}
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- CUSTOM LOCATION --}}
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
                        placeholder="Example: 2nd Floor, Room 204"
                        value="{{ old('custom_location') }}"
                    >

                    @error('custom_location')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DATE --}}
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- IMAGE --}}
                <div class="mb-4">

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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- BUTTONS --}}
                <div class="d-flex gap-2 justify-content-end">

                    <a
                        href="{{ url('/student/dashboard') }}"
                        class="btn btn-light px-4"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-dark px-4"
                    >

                        <i class="bi bi-send me-1"></i>
                        Submit Report

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- CUSTOM CATEGORY / LOCATION SCRIPT --}}
<script>

    // -----------------------------
    // CUSTOM CATEGORY
    // -----------------------------

    const categorySelect =
        document.getElementById('category_id');

    const customCategoryGroup =
        document.getElementById('custom-category-group');

    function toggleCustomCategory() {

        if (categorySelect.value === 'custom') {

            customCategoryGroup.style.display = 'block';

        } else {

            customCategoryGroup.style.display = 'none';

        }

    }

    categorySelect.addEventListener(
        'change',
        toggleCustomCategory
    );

    // Show again after validation error
    toggleCustomCategory();


    // -----------------------------
    // CUSTOM LOCATION
    // -----------------------------

    const locationSelect =
        document.getElementById('location_id');

    const customLocationGroup =
        document.getElementById('custom-location-group');

    function toggleCustomLocation() {

        if (locationSelect.value === 'custom') {

            customLocationGroup.style.display = 'block';

        } else {

            customLocationGroup.style.display = 'none';

        }

    }

    locationSelect.addEventListener(
        'change',
        toggleCustomLocation
    );

    // Show again after validation error
    toggleCustomLocation();

</script>

@endsection