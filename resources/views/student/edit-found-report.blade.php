@extends('layouts.app')

@section('title', 'Edit Found Report')

@section('content')

<style>

.edit-found-page {
    --edit-teal: #365c5a;
    --edit-teal-dark: #294947;
    --edit-gold: #d6a51d;
    --edit-border: #e4eceb;
    --edit-text: #263b3a;
    --edit-muted: #7b8d8b;
}

.edit-found-page .page-heading {
    margin-bottom: 24px;
}

.edit-found-page .page-label {
    color: var(--edit-gold);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.edit-found-page .page-heading h1 {
    color: var(--edit-text);
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 6px;
}

.edit-found-page .page-heading p {
    color: var(--edit-muted);
    font-size: 14px;
    margin-bottom: 0;
}

.edit-found-card {
    background: #ffffff;
    border: 1px solid var(--edit-border);
    border-radius: 20px;
    box-shadow: 0 5px 18px rgba(41, 73, 71, 0.04);
    overflow: hidden;
}

.edit-found-header {
    padding: 22px 24px;
    border-bottom: 1px solid var(--edit-border);
}

.edit-found-header h5 {
    color: var(--edit-text);
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}

.edit-found-header h5 i {
    color: var(--edit-teal);
}

.edit-found-header p {
    color: var(--edit-muted);
    font-size: 12px;
    margin-bottom: 0;
}

.edit-found-body {
    padding: 24px;
}

.edit-found-form-group {
    margin-bottom: 18px;
}

.edit-found-label {
    display: block;
    color: var(--edit-text);
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 7px;
}

.edit-found-input,
.edit-found-select,
.edit-found-textarea {
    width: 100%;
    border: 1px solid var(--edit-border);
    border-radius: 11px;
    padding: 11px 13px;
    color: var(--edit-text);
    background: #ffffff;
    font-size: 13px;
    outline: none;
    transition: 0.2s ease;
}

.edit-found-input:focus,
.edit-found-select:focus,
.edit-found-textarea:focus {
    border-color: #a9c5c1;
    box-shadow: 0 0 0 3px rgba(54, 92, 90, 0.07);
}

.edit-found-textarea {
    resize: vertical;
    min-height: 125px;
}

.edit-found-input::placeholder,
.edit-found-textarea::placeholder {
    color: #a1aaa9;
}

.edit-found-error {
    color: #bd5555;
    font-size: 11px;
    margin-top: 6px;
}

.edit-found-photo-section {
    background: #f8faf9;
    border: 1px solid var(--edit-border);
    border-radius: 15px;
    padding: 16px;
    margin-bottom: 18px;
}

.edit-found-photo-label {
    color: var(--edit-text);
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px;
}

.edit-found-current-photo {
    width: 100%;
    height: 220px;
    background: #ffffff;
    border: 1px solid var(--edit-border);
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
}

.edit-found-current-photo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.edit-found-file-input {
    width: 100%;
    border: 1px solid var(--edit-border);
    border-radius: 11px;
    padding: 9px;
    background: #ffffff;
    color: var(--edit-text);
    font-size: 12px;
}

.edit-found-file-help {
    color: var(--edit-muted);
    font-size: 10px;
    margin-top: 6px;
}

.edit-found-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    padding-top: 5px;
}

.edit-found-cancel,
.edit-found-save {
    border-radius: 10px;
    padding: 10px 17px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.edit-found-cancel {
    background: #f5f7f7;
    border: 1px solid var(--edit-border);
    color: #66716f;
}

.edit-found-cancel:hover {
    background: #eef2f1;
    color: var(--edit-text);
}

.edit-found-save {
    border: 1px solid var(--edit-teal);
    background: var(--edit-teal);
    color: #ffffff;
}

.edit-found-save:hover {
    background: var(--edit-teal-dark);
    border-color: var(--edit-teal-dark);
    color: #ffffff;
}

@media (max-width: 767px) {

    .edit-found-page .page-heading h1 {
        font-size: 26px;
    }

    .edit-found-header,
    .edit-found-body {
        padding: 18px;
    }

    .edit-found-current-photo {
        height: 200px;
    }

    .edit-found-actions {
        flex-direction: column-reverse;
    }

    .edit-found-cancel,
    .edit-found-save {
        width: 100%;
        text-align: center;
    }

}

</style>


<div class="edit-found-page">

    <div class="page-heading">

        <div class="page-label">
            Found Items
        </div>

        <h1>
            Edit Found Report
        </h1>

        <p>
            Update the details of your found item report.
        </p>

    </div>


    <div class="row justify-content-center">

        <div class="col-12 col-xl-9">

            <div class="edit-found-card">

                <div class="edit-found-header">

                    <h5>
                        <i class="bi bi-pencil me-2"></i>
                        Edit Found Item Information
                    </h5>

                    <p>
                        Update the details below.
                    </p>

                </div>


                <div class="edit-found-body">

                    <form
                        action="{{ route('student.found-report-update', $foundItem->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')


                        <div class="edit-found-form-group">

                            <label class="edit-found-label">
                                Item Name
                            </label>

                            <input
                                type="text"
                                name="item_name"
                                class="edit-found-input"
                                value="{{ old('item_name', $foundItem->item_name) }}"
                                placeholder="Example: Black Wallet"
                                required
                            >

                            @error('item_name')
                                <div class="edit-found-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="edit-found-form-group">

                                    <label class="edit-found-label">
                                        Category
                                    </label>

                                    <select
                                        name="category_id"
                                        class="edit-found-select"
                                        required
                                    >

                                        <option value="">
                                            Select Category
                                        </option>

                                        @foreach($categories as $category)

                                            <option
                                                value="{{ $category->id }}"
                                                {{ old('category_id', $foundItem->category_id) == $category->id ? 'selected' : '' }}
                                            >
                                                {{ $category->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('category_id')
                                        <div class="edit-found-error">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="edit-found-form-group">

                                    <label class="edit-found-label">
                                        Location
                                    </label>

                                    <select
                                        name="location_id"
                                        class="edit-found-select"
                                        required
                                    >

                                        <option value="">
                                            Select Location
                                        </option>

                                        @foreach($locations as $location)

                                            <option
                                                value="{{ $location->id }}"
                                                {{ old('location_id', $foundItem->location_id) == $location->id ? 'selected' : '' }}
                                            >
                                                {{ $location->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('location_id')
                                        <div class="edit-found-error">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        <div class="edit-found-form-group">

                            <label class="edit-found-label">
                                Date Found
                            </label>

                            <input
                                type="date"
                                name="found_date"
                                class="edit-found-input"
                                value="{{ old('found_date', $foundItem->found_date) }}"
                                required
                            >

                            @error('found_date')
                                <div class="edit-found-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="edit-found-form-group">

                            <label class="edit-found-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="edit-found-textarea"
                                placeholder="Describe the item's color, brand, size, identifying marks, and other details."
                                required
                            >{{ old('description', $foundItem->description) }}</textarea>

                            @error('description')
                                <div class="edit-found-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="edit-found-photo-section">

                            <div class="edit-found-photo-label">
                                Current Photo
                            </div>

                            @if($foundItem->image)

                                <div class="edit-found-current-photo">

                                    <img
                                        src="{{ asset('storage/' . $foundItem->image) }}"
                                        alt="{{ $foundItem->item_name }}"
                                    >

                                </div>

                            @else

                                <div class="edit-found-current-photo">

                                    <div class="text-center text-muted">

                                        <i
                                            class="bi bi-image"
                                            style="font-size: 40px;"
                                        ></i>

                                        <div class="mt-2" style="font-size: 11px;">
                                            No photo uploaded
                                        </div>

                                    </div>

                                </div>

                            @endif


                            <div class="edit-found-photo-label">
                                Replace Photo
                            </div>

                            <input
                                type="file"
                                name="image"
                                class="edit-found-file-input"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="edit-found-file-help">
                                Optional. JPG, JPEG, PNG, or WEBP. Maximum size: 5 MB.
                            </div>

                            @error('image')
                                <div class="edit-found-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="edit-found-actions">

                            <a
                                href="{{ route('student.found-report-details', $foundItem->id) }}"
                                class="edit-found-cancel"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="edit-found-save"
                            >

                                <i class="bi bi-save me-1"></i>

                                Save Changes

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection