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
    <!--this is the card section--->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <h5>News and Media</h5>
            <div class="filter-search d-flex align-items-center gap-2">
                <h4>Filter</h4>
                <select class="form-select w-auto" id="news-media-category-filter" onchange="redirectToCategory(this)">
                    <option value="">New & Media Category</option>
                    @if(isset($newsMediaCategories) && $newsMediaCategories->count() > 0)
                        @php
                            $firstCategoryId = $newsMediaCategories->first()->id;
                            $selectedCategory = request('newsMediaId', $firstCategoryId);
                        @endphp
                        @foreach($newsMediaCategories as $category)
                            <option data-id="{{ $category->id }}" 
                                    value="{{ $category->id }}"
                                    {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>            
        </div>
        <!--end-->
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="display-newsmedia-category">
                    @if(isset($featuredStories) && $featuredStories->count() > 0)
                        @include('backend.pages.news-media.partials.feature_story_list', ['featuredStories' => $featuredStories])
                    @endif
                    @if(isset($newsRooms) && $newsRooms->count() > 0)                    
                        @include('backend.pages.news-media.partials.news_rooms_list', ['newsRooms' => $newsRooms])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/newAndMediaCategory.js')}}"></script>
<script>
    function redirectToCategory(select) {
        const selectedOption = select.options[select.selectedIndex];
        const id = selectedOption.getAttribute('data-id');
        if (id) {
            const url = new URL(window.location.href);
            url.searchParams.set('newsMediaId', id);
            window.location.href = url.toString();
        }
    }
    $(document).ready(function() {
        $(document).on('click', '.newsroom_show_confirm', function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            Swal.fire({
                title: `Are you sure you want to delete this ${name}?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush