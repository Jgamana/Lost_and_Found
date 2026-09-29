@extends('layouts.app')

@section('title', 'Edit Report')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">
        Lost & Found
    </div>

    <h1>Edit Lost Item Report</h1>

    <p>
        Update the details of your lost item report.
    </p>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-xl-9">

        <div class="modern-card p-4">

            <div class="section-header mb-4">
                <div>
                    <h5>
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Item Information
                    </h5>

                    <p>
                        Update the information below.
                    </p>
                </div>
            </div>

            <form
                action="{{ route('student.report-update', $lostItem->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <!-- ITEM NAME -->
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- CATEGORY -->
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- CUSTOM CATEGORY -->
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- LOCATION -->
                <div class="mb-3">

                    <label class="form-label">
                        Location
                    </label>

                    <select
                        name="location_id"
                        class="form-select"
                        required
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

                    </select>

                    @error('location_id')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- DATE -->
                <div class="mb-3">

                    <label class="form-label">
                        Date Lost
                    </label>

                    <input
                        type="date"
                        name="lost_date"
                        class="form-control"
                        value="{{ old('lost_date', $lostItem->lost_date) }}"
                        required
                    >

                    @error('lost_date')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- DESCRIPTION -->
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- CURRENT IMAGE -->
                @if($lostItem->image)

                    <div class="mb-3">

                        <label class="form-label">
                            Current Photo
                        </label>

                        <div>
                            <img
                                src="{{ asset('storage/' . $lostItem->image) }}"
                                alt="{{ $lostItem->item_name }}"
                                style="width: 180px; height: 180px; object-fit: cover; border-radius: 12px;"
                            >
                        </div>

                    </div>

                @endif


                <!-- NEW IMAGE -->
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
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- BUTTONS -->
                <div class="d-flex gap-2 justify-content-end">

                    <a
                        href="{{ route('student.report-details', $lostItem->id) }}"
                        class="btn btn-light px-4"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-dark px-4"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Update Report
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


<!-- CUSTOM CATEGORY SCRIPT -->
<script>

    const categorySelect =
        document.getElementById('category_id');

    const customCategoryGroup =
        document.getElementById('custom-category-group');


    function toggleCustomCategory()
    {
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


    toggleCustomCategory();

</script>

@endsection