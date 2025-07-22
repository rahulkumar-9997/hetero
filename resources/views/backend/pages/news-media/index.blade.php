@extends('backend.layouts.master')
@section('title','News and Media')
@push('styles')

<link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>News and Media</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('manage-news-media.create') }}" class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
                Create News and Media
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <h5>News and Media</h5>
            <div class="filter-search d-flex align-items-center gap-2">
                <h4>Filter</h4>
                <select class="form-select w-auto" id="news-media-category-filter">
                    <option value="">New & Media Category</option>
                    @if(isset($newsMediaCategories) && $newsMediaCategories->count() > 0)
                        @foreach($newsMediaCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>            
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="display-newsmedia-category">
                    @if(isset($newsMediaCategories) && $newsMediaCategories->count() > 0)
                        @include('backend.pages.news-media.partials.new_media_list', ['newsMediaCategories' => $newsMediaCategories])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/newAndMediaCategory.js')}}"></script>

@endpush