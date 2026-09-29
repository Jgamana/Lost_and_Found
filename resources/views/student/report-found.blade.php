@extends('layouts.app')

@section('title', 'Report Found Item')

@section('content')

<div class="page-heading mb-4">

    <div class="page-label">
        Lost & Found
    </div>

    <h1>Report Found Item</h1>

    <p>
        Provide the details of the item you found so the owner can be identified.
    </p>

</div>


<div class="row justify-content-center">

    <div class="col-12 col-xl-9">

        <div class="modern-card p-4">

            <div class="section-header mb-4">

                <div>

                    <h5>
                        <i class="bi bi-box-seam me-2"></i>
                        Found Item Information
                    </h5>

                    <p>
                        Fill in the details below.
                    </p>

                </div>

            </div>


            <form
                action="{{ url('/student/report-found') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- Item Name --}}
                <div class="mb-3">

                    <label
                        for="item_name"
                        class="form-label"
                    >
                        Item Name
                    </label>

                    <input
                        type="text"
                        name="item_name"
                        id="item_name"
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


                {{-- Category --}}
                <div class="mb-3">

                    <label
                        for="category_id"
                        class="form-label"
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

                    </select>

                    @error('category_id')

                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Suggested Compensation --}}
                <div class="mb-3">

                    <label
                        for="suggested_compensation"
                        class="form-label"
                    >
                        Suggested Compensation
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="suggested_compensation"
                            id="suggested_compensation"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="{{ old('suggested_compensation') }}"
                            required
                        >

                    </div>

                    <small
                        id="compensationHelp"
                        class="text-muted"
                    >
                        Select a category to see the compensation range.
                    </small>

                    @error('suggested_compensation')

                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Location --}}
                <div class="mb-3">

                    <label
                        for="location_id"
                        class="form-label"
                    >
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

                    </select>

                    @error('location_id')

                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Date Found --}}
                <div class="mb-3">

                    <label
                        for="found_date"
                        class="form-label"
                    >
                        Date Found
                    </label>

                    <input
                        type="date"
                        name="found_date"
                        id="found_date"
                        class="form-control"
                        value="{{ old('found_date') }}"
                        required
                    >

                    @error('found_date')

                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Description --}}
                <div class="mb-3">

                    <label
                        for="description"
                        class="form-label"
                    >
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
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


                {{-- Image --}}
                <div class="mb-4">

                    <label
                        for="image"
                        class="form-label"
                    >
                        Item Photo
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
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


                {{-- Buttons --}}
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

@endsection


<script>

document.addEventListener('DOMContentLoaded', function () {

    const categorySelect =
        document.getElementById('category_id');

    const compensationInput =
        document.getElementById('suggested_compensation');

    const compensationHelp =
        document.getElementById('compensationHelp');


    if (
        !categorySelect ||
        !compensationInput ||
        !compensationHelp
    ) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | COMPENSATION RULES
    |--------------------------------------------------------------------------
    */

    const limits = {

        @foreach($compensationRules as $rule)

            "{{ $rule->category_id }}": {

                min: {{ $rule->min_amount }},

                max: {{ $rule->max_amount }}

            },

        @endforeach

    };


    /*
    |--------------------------------------------------------------------------
    | UPDATE COMPENSATION RANGE
    |--------------------------------------------------------------------------
    */

    function updateCompensationLimit() {

        const categoryId =
            categorySelect.value;

        const rule =
            limits[categoryId];


        /*
        |--------------------------------------------------------------------------
        | NO RULE
        |--------------------------------------------------------------------------
        */

        if (!rule) {

            compensationInput.min = 0;

            compensationInput.removeAttribute('max');

            compensationHelp.textContent =
                'No compensation rule is set for this category.';

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | SET MINIMUM AND MAXIMUM
        |--------------------------------------------------------------------------
        */

        compensationInput.min =
            rule.min;

        compensationInput.max =
            rule.max;


        /*
        |--------------------------------------------------------------------------
        | DISPLAY COMPENSATION RANGE
        |--------------------------------------------------------------------------
        */

        compensationHelp.textContent =
            'Compensation range: ₱' +
            Number(rule.min).toFixed(2) +
            ' – ₱' +
            Number(rule.max).toFixed(2);


        /*
        |--------------------------------------------------------------------------
        | CORRECT INVALID EXISTING VALUE
        |--------------------------------------------------------------------------
        */

        const currentValue =
            Number(compensationInput.value);


        if (
            compensationInput.value !== '' &&
            currentValue < rule.min
        ) {

            compensationInput.value =
                rule.min;

        }


        if (
            compensationInput.value !== '' &&
            currentValue > rule.max
        ) {

            compensationInput.value =
                rule.max;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | WHEN CATEGORY CHANGES
    |--------------------------------------------------------------------------
    */

    categorySelect.addEventListener(
        'change',
        updateCompensationLimit
    );


    /*
    |--------------------------------------------------------------------------
    | INITIAL LOAD
    |--------------------------------------------------------------------------
    */

    updateCompensationLimit();

});

</script>