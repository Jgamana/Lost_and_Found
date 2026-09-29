@extends('layouts.app')

@section('title', 'Edit Found Report')

@section('content')

<div class="page-heading mb-4">
    <div class="page-label">Found Items</div>
    <h1>Edit Found Report</h1>
    <p>Update the details of your found item report.</p>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-xl-9">

        <div class="modern-card p-4">

            <div class="section-header mb-4">
                <div>
                    <h5>
                        <i class="bi bi-pencil me-2"></i>
                        Edit Found Item Information
                    </h5>
                    <p>Update the details below.</p>
                </div>
            </div>

            <form
                action="{{ route('student.found-report-update', $foundItem->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                {{-- Item Name --}}
                <div class="mb-3">
                    <label class="form-label">Item Name</label>

                    <input
                        type="text"
                        name="item_name"
                        class="form-control"
                        value="{{ old('item_name', $foundItem->item_name) }}"
                        required
                    >

                    @error('item_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Category</label>

                    <select
                        name="category_id"
                        class="form-select"
                        required
                    >
                        <option value="">Select Category</option>

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
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Location --}}
                <div class="mb-3">
                    <label class="form-label">Location</label>

                    <select
                        name="location_id"
                        class="form-select"
                        required
                    >
                        <option value="">Select Location</option>

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
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date Found --}}
                <div class="mb-3">
                    <label class="form-label">Date Found</label>

                    <input
                        type="date"
                        name="found_date"
                        class="form-control"
                        value="{{ old('found_date', $foundItem->found_date) }}"
                        required
                    >

                    @error('found_date')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="5"
                        required
                    >{{ old('description', $foundItem->description) }}</textarea>

                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Current Photo --}}
                @if($foundItem->image)
                    <div class="mb-3">
                        <label class="form-label">Current Photo</label>

                        <div>
                            <img
                                src="{{ asset('storage/' . $foundItem->image) }}"
                                alt="{{ $foundItem->item_name }}"
                                style="
                                    max-width: 250px;
                                    max-height: 200px;
                                    object-fit: contain;
                                    border-radius: 10px;
                                "
                            >
                        </div>
                    </div>
                @endif

                {{-- New Photo --}}
                <div class="mb-4">
                    <label class="form-label">Replace Photo</label>

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
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2 justify-content-end">

                    <a
                        href="{{ route('student.found-report-details', $foundItem->id) }}"
                        class="btn btn-light px-4"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-dark px-4"
                    >
                        <i class="bi bi-save me-1"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection