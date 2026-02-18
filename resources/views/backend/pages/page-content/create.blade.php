@extends('backend.layouts.master')
@section('title','Create Pages')
@push('styles')
<!-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"> -->
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
    
    <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('pages.index') }}" data-title="Вернуться на предыдущую страницу" data-bs-toggle="tooltip" class="btn btn-sm btn-purple" data-bs-original-title="Вернуться на предыдущую страницу">
                &lt;&lt; Вернуться на предыдущую страницу
            </a>

        </div>
        <div class="accordion-body border-top">
            <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data" id="createPageForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger ms-1">*</span> Заголовок страницы</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $page->title ?? '') }}">
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label">Название метки страницы</label>
                            <input type="text" class="form-control" name="page_label_name" value="{{ old('page_label_name', $page->page_label_name ?? '') }}">
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label">Название маршрута</label>
                            <input type="text" class="form-control" name="route_name" value="{{ old('route_name', $page->route_name ?? '') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Основное изображение</label>
                            <input type="file" class="form-control" name="main_image">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="page_short_content">Краткое содержание страницы</label>
                            <textarea type="text" class="form-control" name="page_short_content" id="page_short_content"></textarea>
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="summer-description-box mb-3">
                            <label class="form-label">Содержимое страницы *</label>
                            <textarea id="content" name="content" class="ckeditor4">{{ old('content', $page->content ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label">Родительская страница</label>
                            <select class="select" name="parent_id">
                                <option value="">-- Без родительской страницы --</option>
                                @foreach($parentPages as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id', $page->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="mb-3">
                            <label class="form-label">Порядок</label>
                            <input type="number" class="form-control" name="order" value="{{ old('order', $page->order ?? 0) }}">
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
                                    {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Активный</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-12">
                        <div class="mb-3">
                            <label class="form-label">Показывать в боковой панели</label><br>
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="show_in_sidebar"
                                    id="show_in_sidebar"
                                    value="1"
                                    {{ old('show_in_sidebar', $page->show_in_sidebar ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Include in Sidebar</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label">Мета-заголовок</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label">Мета-описание</label>
                            <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('pages.index') }}" class="btn btn-secondary me-2">Отмена</a>
                            <button type="submit" class="btn btn-primary">{{ isset($page) ? 'Update Page' : 'Добавить страницу' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /product list -->
</div>

@endsection
@push('scripts')

<script src="{{ asset('backend/assets/js/pages/pages.js') }}?v={{ env('ASSET_VERSION', '1.0') }}"></script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor.js') }}?v={{ env('ASSET_VERSION', '1.0') }}"></script>
<script>
    window.CKEDITOR_ROUTES = {
        upload: "{{ route('ckeditor.upload') }}",
        imagelist: "{{ route('ckeditor.imagelist') }}"
    };
</script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor-r-create-config.js') }}?v={{ env('ASSET_VERSION', '1.0') }}"></script>
@endpush