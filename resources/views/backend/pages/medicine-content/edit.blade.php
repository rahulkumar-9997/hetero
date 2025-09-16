@extends('backend.layouts.master')
@section('title','Edit Medicine')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">

@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>
                    Edit Medicine
                </h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-medicine.index') }}" data-title="Go Back to Previous Page" data-bs-toggle="tooltip" class="btn btn-sm btn-pink" data-bs-original-title="Go Back to Previous Page">
                <i class="ti ti-arrow-left me-1"></i>
                Go Back to Previous Page
            </a>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('manage-medicine.update', $medicine_row->id) }}" method="POST" enctype="multipart/form-data" id="medicineUpdateForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label">Select Medicine Category *</label>
                            <select class="select" name="medicine_category" id="medicine_category">
                                <option value="">-- Select Medicine category --</option>
                                @foreach($MedicineCategories as $MedicineCategory)
                                <option value="{{ $MedicineCategory->id }}"
                                    {{ old('medicine_category', $medicine_row->medicine_category_id) == $MedicineCategory->id ? 'selected' : '' }}>
                                    {{ $MedicineCategory->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('medicine_category')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="medicine_name">Medicine Name *</label>
                            <input type="text" class="form-control" name="medicine_name" id="medicine_name"
                                value="{{ old('medicine_name', $medicine_row->title) }}">
                            @error('medicine_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="medicine_image">Medicine Image</label>
                            <input type="file" class="form-control" name="medicine_image" id="medicine_image">
                            @error('medicine_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if($medicine_row->image)
                            <div class="mt-2">
                                <img src="{{ asset('upload/medicine/' . $medicine_row->image) }}" width="100" class="img-thumbnail">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                    <label class="form-check-label text-danger" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                                <input type="hidden" name="current_image" value="{{ $medicine_row->image }}">
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="medicine_short_content">Medicine Short Content</label>
                            <textarea type="text" class="form-control" name="medicine_short_content" id="medicine_short_content">{{ old('medicine_short_content', $medicine_row->short_content) }}</textarea>
                            @error('medicine_short_content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3 mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1"
                                    {{ old('status', $medicine_row->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="medicine_content">Medicine Content</label>
                            <textarea id="content" name="content" class="ckeditor4">{{ old('content', $medicine_row->content) }}</textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-medicine.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor.js') }}"></script>
<script>
    document.querySelectorAll('.ckeditor4').forEach(function(el) {
        CKEDITOR.replace(el, {
            removePlugins: 'exportpdf'
        });
    });
</script>
@endpush