@extends('backend.layouts.master')
@section('title','Add new Medicine')
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
                    Add new Medicine
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
            <form action="{{ route('manage-medicine.store') }}" method="POST" enctype="multipart/form-data" id="medicineStoreForm">
                @csrf
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <div class="add-newplus">
                                <label class="form-label">
                                    Select Medicine Category
                                    <span class="text-danger ms-1">*</span>
                                </label>
                                <a href="javascript:void(0);"
                                data-title="Add new Medicine Category"
                                data-medicine-category-add="true"
                                data-url="{{ route('medicine-category.create') }}"
                                data-size="lg"
                                data-action="select"
                                >
                                <i data-feather="plus-circle" class="plus-down-add"></i>
                                <span>
                                    Add New</span>
                                </a>
                            </div>
                           
                            <select class="select" name="medicine_category" id="medicine_category">
                                <option value="">-- Select Medicine category --</option>
                                @foreach($MedicineCategories as $MedicineCategory)
                                <option value="{{ $MedicineCategory->id }}"
                                    {{ old('medicine_category') == $MedicineCategory->id ? 'selected' : '' }}>
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
                            <label class="form-label" for="mhh">МНН (International Non-proprietary Name) *</label>
                            <input type="text" class="form-control" name="mhh" id="mhh"
                                value="{{ old('mhh') }}">
                            @error('mhh')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="th">ТН (Trade Name (or Brand Name)) </label>
                            <input type="text" class="form-control" name="th" id="th"
                                value="{{ old('th') }}">
                            @error('th')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="dosage_form">Форма выпуска (Dosage Form / Form of Release) </label>
                            <input type="text" class="form-control" name="dosage_form" id="dosage_form"
                                value="{{ old('dosage_form') }}">
                            @error('dosage_form')
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
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-2">
                            <label class="form-label" for="medicine_short_content">Medicine Short Content</label>
                            <textarea type="text" class="form-control" name="medicine_short_content" id="medicine_short_content">{{ old('medicine_short_content') }}</textarea>
                            @error('medicine_short_content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-1 mt-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1"
                                    {{ old('status', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="medicine_content">Medicine Content</label>
                            <textarea id="content" name="content" class="ckeditor4">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-banner.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/medicine-category.js')}}"></script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor.js') }}"></script>
<script>
    window.CKEDITOR_ROUTES = {
        upload: "{{ route('ckeditor.upload') }}",
        imagelist: "{{ route('ckeditor.imagelist') }}"
    };
</script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor-r-create-config.js') }}"></script>
@endpush