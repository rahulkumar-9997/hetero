@extends('backend.layouts.master')
@section('title','Edit News Media')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">

@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Pages</h4>
                <h6>Manage Pages</h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-news-media.index') }}" data-title="Go Back to Category" data-bs-toggle="tooltip" class="btn btn-sm btn-purple" data-bs-original-title="Go Back to Previous Page">
                &lt;&lt; Go Back to Previous Page
            </a>

        </div>
        <div class="accordion-body border-top">
            @if(request()->has('action') && request('action') == 'newsroom')
                <form action="{{ route('news-room.update', $newsRoom->id) }}" method="POST" enctype="multipart/form-data" id="create-news-media-form">
                    @csrf
                    @method('post')
                    <div class="newsroom-form">
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Select news and media category</label>
                                    <select class="select" name="news_media_categories_display" id="news_media_categories" disabled>
                                        <option value="">-- Select news and media category --</option>
                                        @foreach($newsMediaCategories as $newsMediaCategory)
                                            <option 
                                                data-slug="{{ $newsMediaCategory->slug }}" 
                                                value="{{ $newsMediaCategory->id }}"
                                                {{ $newsRoom->new_and_media_category_id == $newsMediaCategory->id ? 'selected' : '' }}>
                                                {{ $newsMediaCategory->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="news_media_categories" value="{{ $newsRoom->new_and_media_category_id }}">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Title<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $newsRoom->title ?? '') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Select year </label>
                                    <select class="select" name="years">
                                        <option>-- Select year --</option>
                                        @foreach($years as $year)
                                        <option 
                                        value="{{ $year->id }}"
                                        {{ $newsRoom->year_id == $year->id ? 'selected' : '' }}
                                        >
                                            {{ $year->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('years')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Post Date<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control flatpickr-input" 
                                    name="post_date" 
                                    value="{{ old('post_date', isset($newsRoom->post_date) ? \Carbon\Carbon::parse($newsRoom->post_date)->format('Y-m-d') : '') }}" 
                                    placeholder="YYYY-MM-DD" 
                                    id="flatpickr-date" 
                                    readonly="readonly">

                                    @error('post_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Location<span class="text-danger ms-1"></label>
                                    <input type="text" class="form-control" name="location" value="{{ old('location', $newsRoom->location ?? '') }}">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Images<span class="text-danger ms-1"></label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if($newsRoom->image)
                                        <div style="width: 100px; height: 70px; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
                                            <img src="{{ asset('upload/news-room/' . $newsRoom->image) }}" 
                                                style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                                >
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Status</label><br>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="summer-description-box mb-3">
                                    <label class="form-label">
                                        Content 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="content" name="content" class="form-control ckeditor4">{{ old('content', $newsRoom->content ?? '') }}</textarea>                                    
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $newsRoom->meta_title ?? '') }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description', $newsRoom->meta_description ?? '') }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('pages.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </form>
            @endif
            
        </div>
    </div>
    <!-- /product list -->
</div>

@endsection
@push('scripts')
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor.js') }}"></script>
<script>
    window.CKEDITOR_ROUTES = {
        upload: "{{ route('ckeditor.upload') }}",
        imagelist: "{{ route('ckeditor.imagelist') }}"
    };
</script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor-r-create-config.js') }}"></script>

@endpush