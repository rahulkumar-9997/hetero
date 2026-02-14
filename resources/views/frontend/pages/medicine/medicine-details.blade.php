@php
$metaTitle = $medicineContent->title;
if($medicineContent->content)
{
    $metaDesc = $medicineContent->short_content;
}
else
{
     $metaDesc = $medicineContent->content;
}
$metaDescription = \Illuminate\Support\Str::limit(strip_tags($metaDesc), 160);
@endphp
@extends('frontend.layouts.master')
@section('title', $metaTitle)
@section('description', $metaDescription)
@section('main-content')
@push('styles')
    <link href="{{asset('fronted/assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
@endpush
<section id="breadcrum" class="no-banner">
    <div class="common-container">
        <ol class="breadcrumb" style="margin-top:0px;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Главная</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('lekarstvennye-preparaty') }}">Лекарственные препараты</a>
            </li>
            <li class="breadcrumb-item active">{{  $medicineContent->title }}</li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3>{{  $medicineContent->title }}</h3>
    </div>
</section>
<section class="back-section">
    <div class="common-container wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
        <div class="row common-t-pad">
            <div class="col-lg-12">
                <p class="text-right">
                    <img src="{{ asset('fronted/assets/images/red-left-arrow.png') }}" width="10px">
                    <a href="{{ route('lekarstvennye-preparaty') }}" class="HeteroRed"> Возврат к списку</a>
                </p>
            </div>
        </div>
        <hr>
    </div>
</section>
<section class="ensuring-sec news-details-section">
    <div class="common-container">
        <!-- @if($medicineContent->short_content)
            <h2 class="home-title pruple2 fs24 wow fadeInUp">
                {{ $medicineContent->short_content }}
            </h2>
        @endif -->
        <div class="nws-details">
            <div class="row">               
                <div class="fs22 col-md-7 order-2 order-md-1">
                    <div class="medicine-container">                        
                        @if($medicineContent->short_content)
                            <h5 class="wow fadeInUp">
                                {{ $medicineContent->short_content }}
                            </h5>
                        @endif
                        <div class="medicine-title-other">
                            <div class="legacy-box border-left-blue mt-4">
                                <h2>MHH </h2> 
                                <h3>
                                    {{ $medicineContent->title }}
                                </h3>
                            </div>
                            @if($medicineContent->trade_name)
                                <div class="legacy-box border-left-blue">
                                    <h2>TH </h2> 
                                    <h3>
                                        {{ $medicineContent->trade_name }}
                                    </h3>
                                </div>
                            @endif
                            @if($medicineContent->dosage_form)
                                <div class="legacy-box border-left-blue">
                                    <h2>Форма выпуска </h2> 
                                    <h3>
                                        {{ $medicineContent->dosage_form }}
                                    </h3>
                                </div>
                            @endif
                        </div> 
                        <div class="medicine-content">               
                            {!! $medicineContent->content !!}
                        </div>
                    </div>
                </div>
                @if($medicineContent->image)
                <div class="col-md-5 order-1 order-md-2">
                    <div class="news-image-container wow fadeInRight">
                        <a class="lightbox" title="" data-fancybox="images-1" data-caption="" href="{{ asset('upload/medicine/' . $medicineContent->image) }}">
                            <div class="img-before1 mb-4">
                                <img src="{{ asset('upload/medicine/' . $medicineContent->image) }}" 
                                alt="{{ $medicineContent->title }}" 
                                class="news-detail-image img-radius" width="100%">
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>        
    </div>
</section>

@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('fronted/assets/js/jquery.fancybox.min.js')}}"></script>
<script>
    wow = new WOW({
        mobile: false,
    });
    wow.init();
</script>
@endpush