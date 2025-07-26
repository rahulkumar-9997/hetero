@php
$metaTitle = $newsRoom->title;
$metaDescription = \Illuminate\Support\Str::limit(strip_tags($newsRoom->content), 160);
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
            <li class="breadcrumb-item">
                <a href="{{ route('novosti') }}">Новости</a>
            </li>
            <li class="breadcrumb-item active">
                {{ $newsRoom->title }}
            </li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3>{{ $newsRoom->title }}</h3>
    </div>
</section>
<section>
    <div class="common-container wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
        <div class="row common-t-pad">
            <div class="col-lg-12">
                <p class="text-right">
                    <img src="{{ asset('fronted/assets/images/red-left-arrow.png') }}" width="10px">
                    <a href="{{ route('novosti') }}" class="HeteroRed"> Возврат к списку</a>
                </p>
            </div>
        </div>
        <hr>
    </div>
</section>
<section class="ensuring-sec news-details-section">
    <div class="common-container">
        <h2 class="home-title pruple2 fs24 wow fadeInUp">
            {{ $newsRoom->title }}
        </h2>
        <div class="nws-details">
            <div class="row">
                <div class="col-lg-12">
                    @if($newsRoom->image)
                    <div class="col-md-6 news-img">
                        <div class="news-image-container wow fadeInRight">
                            <div class="img-before">
                                <img src="{{ asset('upload/news-room/' . $newsRoom->image) }}" 
                                alt="{{ $newsRoom->title }}" 
                                class="news-detail-image img-radius" width="100%">
                            </div>
                        </div>
                    </div>
                    @endif                
                    {!! $newsRoom->content !!}              
                    
                </div>
            </div>
        </div>        
    </div>
</section>

@endsection
@push('scripts')
<script>
    wow = new WOW({
        mobile: false,
    });
    wow.init();
</script>
@endpush