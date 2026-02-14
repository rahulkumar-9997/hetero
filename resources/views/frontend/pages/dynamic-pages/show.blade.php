@php
$metaTitle = $page->meta_title ?? $page->title. ' | Hetero World';
$metaDesc = $page->meta_description ?? $page->short_content ?? $page->content;
$metaDescription = \Illuminate\Support\Str::limit(strip_tags($metaDesc), 160);
@endphp

@extends('frontend.layouts.master')
@section('title', $metaTitle)
@section('description', $metaDescription)
@section('main-content')
<section id="breadcrum" class="no-banner">
    <div class="common-container">
        <ol class="breadcrumb" style="margin-top:0px;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Главная</a>
            </li>
            <li class="breadcrumb-item active">
                {{ $page->title }}
            </li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3> {{ $page->title }}</h3>
    </div>
</section>
<section id="main-content" class="common-t-pad common-b-pad page-display">
    <div class="common-container">
        @php            
            $hasPageImage = !empty($page->main_image);
            $contentClass = $hasPageImage ? 'col-lg-6' : 'col-lg-12';
        @endphp
        <div class="row" id="pageRow">
            <div class="{{ $contentClass }} mb-4" id="pageContent">
                @if($page->short_content)
                    <h2 class="home-title MulishExtrabold fs24">
                        {!! $page->short_content !!}
                    </h2>
                @endif
                <div class="page-content-area">
                    <div class="left-content page-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
            @if($hasPageImage)
                <div class="col-lg-6 mb-2 mt-5" id="pageImageCol">
                    <div class="news-image-container-page" id="stickyImageContainer">
                        <div class="img-before">
                            <img src="{{ asset('upload/page/'.$page->main_image) }}" 
                                class="img-fluid img-radius news-detail-image" 
                                alt="{{ $page->title }}" 
                                loading="lazy">
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @php
            $hasSidebar = isset($sidebarPages) && $sidebarPages->isNotEmpty();
        @endphp
        @if($hasSidebar)
            <div class="row common-t-pad">
                @php
                    $count = $sidebarPages->count();
                    $colClass = 'col-lg-4';
                    if ($count == 2) $colClass = 'col-lg-6';
                    if ($count == 1) $colClass = 'col-lg-6';
                @endphp

                @foreach($sidebarPages as $sidebarPage)
                    <div class="{{ $colClass }} mb-4">
                        <div class="api-box h-100 text-center p-0 shadow-sm rounded">
                            <a href="{{ route('page.show', $sidebarPage->slug) }}" class="d-block mb-2">
                                <div class="image-file">
                                    @if($sidebarPage->main_image)
                                        <img src="{{ asset('upload/page/'.$sidebarPage->main_image) }}" 
                                            class="img-fluid rounded" alt="{{ $sidebarPage->title }}">
                                    @else
                                        <img src="{{ asset('fronted/assets/images/Logo.png') }}" 
                                            class="img-fluid rounded" alt="Default">
                                    @endif
                                </div>
                                <div class="card-footr">
                                    @if($sidebarPage->page_label_name)
                                        <h5>{{ $sidebarPage->page_label_name }}</h5>
                                    @endif
                                    <h2 class="h5">{{ $sidebarPage->title }}</h2>
                                    @if($sidebarPage->short_content)
                                        <p class="fs14 MulishRegular px-3">                                    
                                        {!! (Str::limit(strip_tags($sidebarPage->short_content), 200)) !!}</p>
                                    @endif
                                </div>
                            </a>
                            <a href="{{ route('page.show', $sidebarPage->slug) }}" class="readmore">
                                Read more
                            </a>
                            
                        </div>
                    </div>
                @endforeach                
            </div>
        @endif
    </div>
</section>

@endsection
@push('scripts')

@endpush