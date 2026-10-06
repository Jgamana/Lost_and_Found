@extends('layouts.app')

@section('title', 'Report Found Item')

@section('content')

<style>

.student-report-found-page {
    --found-teal: #365c5a;
    --found-teal-dark: #294947;
    --found-gold: #d6a51d;
    --found-border: #e4eceb;
    --found-text: #263b3a;
    --found-muted: #7b8d8b;
    --found-light: #eef5f3;
}


/* PAGE HEADER */

.student-report-found-page .page-heading {
    margin-bottom: 24px;
}

.student-report-found-page .page-label {
    color: var(--found-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.student-report-found-page .page-heading h1 {
    color: var(--found-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.student-report-found-page .page-heading p {
    color: var(--found-muted);
    font-size: 14px;
    margin-bottom: 0;
}


/* FORM CARD */

.student-report-found-card {
    background: #ffffff;
    border: 1px solid var(--found-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.035);
    padding: 25px;
}

.student-report-found-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding-bottom: 20px;
    margin-bottom: 23px;
    border-bottom: 1px solid var(--found-border);
}

.student-report-found-header-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    border-radius: 13px;
    background: var(--found-light);
    color: var(--found-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.student-report-found-title {
    color: var(--found-text);
    font-size: 17px;
    font-weight: 700;
    margin: 2px 0 4px;
}

.student-report-found-subtitle {
    color: var(--found-muted);
    font-size: 12px;
    margin: 0;
}


/* FORM */

.student-report-found-form {
    width: 100%;
}

.student-report-found-form .form-label {
    color: var(--found-text);
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 7px;
}

.student-report-found-form .form-control,
.student-report-found-form .form-select {
    min-height: 43px;
    border: 1px solid #d8e4e2;
    border-radius: 10px;
    color: var(--found-text);
    background: #ffffff;
    font-size: 12px;
    padding: 9px 12px;
    box-shadow: none;
    transition: 0.2s ease;
}

.student-report-found-form .form-control:focus,
.student-report-found-form .form-select:focus {
    border-color: var(--found-teal);
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.08);
}

.student-report-found-form textarea.form-control {
    min-height: 125px;
    resize: vertical;
    line-height: 1.6;
}

.student-report-found-form .form-control::placeholder {
    color: #a4b1af;
}

.student-report-found-form .form-text {
    color: var(--found-muted);
    font-size: 10px;
    margin-top: 6px;
}

.student-report-found-form .input-group-text {
    min-height: 43px;
    background: var(--found-light);
    border: 1px solid #d8e4e2;
    border-right: none;
    border-radius: 10px 0 0 10px;
    color: var(--found-teal);
    font-size: 13px;
    font-weight: 700;
}

.student-report-found-form .input-group .form-control {
    border-radius: 0 10px 10px 0;
}

.student-report-found-error {
    color: #bd5555;
    font-size: 10px;
    margin-top: 5px;
}


/* SECTION DIVIDERS */

.found-form-section {
    margin-bottom: 24px;
}

.found-form-section:last-of-type {
    margin-bottom: 0;
}

.found-form-section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--found-text);
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 14px;
}

.found-form-section-title i {
    color: var(--found-teal);
}


/* COMPENSATION */

.student-compensation-help {
    display: block;
    color: var(--found-muted);
    background: #fbf8ed;
    border: 1px solid #eee4c4;
    border-radius: 9px;
    padding: 8px 10px;
    font-size: 10px;
    line-height: 1.5;
    margin-top: 7px;
}


/* ACTIONS */

.student-report-found-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    margin-top: 27px;
    padding-top: 20px;
    border-top: 1px solid var(--found-border);
}

.student-report-found-cancel,
.student-report-found-submit {
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

.student-report-found-cancel {
    background: #f5f7f7;
    border-color: var(--found-border);
    color: #64716f;
}

.student-report-found-cancel:hover {
    background: #edf2f1;
    color: var(--found-text);
}

.student-report-found-submit {
    background: var(--found-teal);
    color: #ffffff;
}

.student-report-found-submit:hover {
    background: var(--found-teal-dark);
    color: #ffffff;
}


/* RESPONSIVE */

@media (max-width: 767px) {

    .student-report-found-page .page-heading h1 {
        font-size: 26px;
    }

    .student-report-found-card {
        padding: 18px;
    }

    .student-report-found-actions {
        flex-direction: column-reverse;
    }

    .student-report-found-cancel,
    .student-report-found-submit {
        width: 100%;
    }

}

</style>


<div class="student-report-found-page">

    {{-- PAGE HEADER --}}

    <div class="page-heading">

        <div class="page-label">
            Lost & Found
        </div>

        <h1>
            Report Found Item
        </h1>

        <p>
            Provide the details of the item you found so the owner can be identified.
        </p>

    </div>


    <div class="row justify-content-center">

        <div class="col-12 col-xl-9">

            <div class="student-report-found-card">

                {{-- CARD HEADER --}}

                <div class="student-report-found-header">

                    <div class="student-report-found-header-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>

                        <h5 class="student-report-found-title">
                            Found Item Information
                        </h5>

                        <p class="student-report-found-subtitle">
                            Fill in the details below.
                        </p>

                    </div>

                </div>


                {{-- FORM --}}

                <form
                    action="{{ url('/student/report-found') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="student-report-found-form"
                >

                    @csrf


                    {{-- ITEM INFORMATION --}}

                    <div class="found-form-section">

                        <div class="found-form-section-title">
                            <i class="bi bi-box"></i>
                            Item Information
                        </div>


                        {{-- ITEM NAME --}}

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

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- CATEGORY --}}

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

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- COMPENSATION --}}

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
                                class="student-compensation-help"
                            >
                                Select a category to see the compensation range.
                            </small>

                            @error('suggested_compensation')

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- FOUND DETAILS --}}

                    <div class="found-form-section">

                        <div class="found-form-section-title">
                            <i class="bi bi-geo-alt"></i>
                            Found Details
                        </div>


                        {{-- LOCATION --}}

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

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DATE FOUND --}}

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

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DESCRIPTION --}}

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

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- IMAGE --}}

                        <div class="mb-3">

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

                                <div class="student-report-found-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ACTIONS --}}

                    <div class="student-report-found-actions">

                        <a
                            href="{{ url('/student/dashboard') }}"
                            class="student-report-found-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="student-report-found-submit"
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


    const limits = {

        @foreach($compensationRules as $rule)

            "{{ $rule->category_id }}": {
                min: {{ $rule->min_amount }},
                max: {{ $rule->max_amount }}
            },

        @endforeach

    };


    function updateCompensationLimit() {

        const categoryId =
            categorySelect.value;

        const rule =
            limits[categoryId];


        if (!rule) {

            compensationInput.min = 0;

            compensationInput.removeAttribute('max');

            compensationHelp.textContent =
                'No compensation rule is set for this category.';

            return;

        }


        compensationInput.min =
            rule.min;

        compensationInput.max =
            rule.max;


        compensationHelp.textContent =
            'Compensation range: ₱' +
            Number(rule.min).toFixed(2) +
            ' – ₱' +
            Number(rule.max).toFixed(2);


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


    categorySelect.addEventListener(
        'change',
        updateCompensationLimit
    );


    updateCompensationLimit();

});

</script>

@endsection