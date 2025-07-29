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
<section>
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
                <div class="col-lg-12">
                    @if($medicineContent->image)
                    <div class="col-md-6 news-img">
                        <div class="news-image-container wow fadeInRight">
                            <div class="img-before">
                                <img src="{{ asset('upload/medicine/' . $medicineContent->image) }}" 
                                alt="{{ $medicineContent->title }}" 
                                class="news-detail-image img-radius" width="100%">
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($medicineContent->short_content)
                        <h4 class="home-title pruple2 fs24 wow fadeInUp">
                            {{ $medicineContent->short_content }}
                        </h4>
                    @endif                
                    {!! $medicineContent->content !!}              
                    
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