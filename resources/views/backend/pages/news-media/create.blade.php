@extends('backend.layouts.master')
@section('title','New and media')
@push('styles')
<!-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}"> -->
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Создать страницы</h4>
                <h6>Управление страницами</h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-news-media.index') }}" data-title="Вернуться на предыдущую страницу" data-bs-toggle="tooltip" class="btn btn-sm btn-purple" data-bs-original-title="Вернуться на предыдущую страницу">
                &lt;&lt; Вернуться на предыдущую страницу
            </a>

        </div>
        <div class="accordion-body border-top">
            <form action="{{ route('manage-news-media.store') }}" method="POST" enctype="multipart/form-data" id="create-news-media-form">
                @csrf
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label">Выбрать категорию новостей и медиа</label>
                            <select class="select" name="news_media_categories" id="news_media_categories" onchange="redirectToCategory(this)">
                                <option value="">-- Выбрать категорию новостей и медиа --</option>
                                @foreach($newsMediaCategories as $newsMediaCategory)
                                    <option 
                                        data-slug="{{ $newsMediaCategory->slug }}" 
                                        value="{{ $newsMediaCategory->id }}"
                                        {{ request('newsMediaSlug') == $newsMediaCategory->slug ? 'selected' : '' }}>
                                        {{ $newsMediaCategory->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                @if(request()->has('newsMediaSlug') && request('newsMediaSlug') == 'featured-stories')
                    <!-- Features stories form -->
                    <div class="feature-stories-form">
                        <input type="hidden" name="media-action-type" value="featured-stories">                        
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                
                                <div class="mb-3">
                                    <label class="form-label">Название<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Подзаголовок</label>
                                    <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}">
                                    @error('subtitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="summer-description-box mb-3">
                                    <label class="form-label">
                                        Содержимое
                                        <span class="text-danger">*</span> 
                                    </label>
                                    <textarea id="content" class="form-control ckeditor4" name="content">{{ old('content') }}</textarea>                                    
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>                
                        <div class="row">
                            <div class="col-sm-2 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Статус</label><br>
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
                            <div class="col-sm-5 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Мета-заголовок</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Мета-описание</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('manage-news-media.index') }}" class="btn btn-secondary me-2">Отмена</a>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(request('newsMediaSlug') == 'novosti')
                    <div class="newsroom-form">
                        <input type="hidden" name="media-action-type" value="newsroom">
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Название<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Выбрать год </label>
                                    <select class="select" name="years">
                                        <option>-- Выбрать год --</option>
                                        @foreach($years as $year)
                                        <option value="{{ $year->id }}">
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
                                    <label class="form-label">Дата публикации<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control flatpickr-input" name="post_date" value="{{ old('post_date') }}" placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly">
                                    @error('post_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Местоположение<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Изображения<span class="text-danger ms-1">*</span></label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Статус</label><br>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Активный</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="summer-description-box mb-3">
                                    <label class="form-label">
                                        Содержимое 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="content" name="content" class="form-control ckeditor4">{{ old('content', $page->content ?? '') }}</textarea>
                                   
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Мета-заголовок</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Мета-описание</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('pages.index') }}" class="btn btn-secondary me-2">Отмена</a>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                            </div>
                        </div>                        
                    </div>
                @elseif(request('newsMediaSlug') == 'press-kit')
                    <div class="presskit-form">
                        <input type="hidden" name="media-action-type" value="press-kit">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Заголовок<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Изображение <span class="text-danger ms-1">*</span></label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Скачать PDF файл <span class="text-danger ms-1">*</span></label>
                                    <input type="file" class="form-control" name="pdf_file" value="{{ old('pdf_file') }}">
                                    @error('pdf_file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Статус</label><br>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Активный</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <a href="{{ route('pages.index') }}" class="btn btn-secondary me-2">Отмена</a>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <!-- /product list -->
</div>

@endsection
@push('scripts')

<script>
    function redirectToCategory(select) {
        const selectedOption = select.options[select.selectedIndex];
        const slug = selectedOption.getAttribute('data-slug');
        if (slug) {
            const url = new URL(window.location.href);
            url.searchParams.set('newsMediaSlug', slug);
            window.location.href = url.toString();
        }
    }
</script>
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