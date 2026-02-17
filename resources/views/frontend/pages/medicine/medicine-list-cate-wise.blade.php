@extends('frontend.layouts.master')
@section('title', ($medicineCategory->title ?? 'Category') . ' | Hetero World')
@section('description', Str::limit(strip_tags($medicineCategory->content ?? ''), 150))
@section('main-content')
<section id="breadcrum" class="no-banner">
    <div class="common-container">
        <ol class="breadcrumb" style="margin-top:0px;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Главная</a>
            </li>
            <li class="breadcrumb-item active">{{ $medicineCategory->title ?? 'Category' }}</li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3>{{ $medicineCategory->title ?? 'Category' }}</h3>
    </div>
</section>
<section id="expertise-overview medicine-categories-section" class="common-b-pad common-t-pad">
    <div class="common-container">
        <div class="row justify-content-md-center">
            @if($medicineContent->count() > 0)
                @foreach($medicineContent as $index => $content)
                <div class="col-md-4 mb-3 wow1 fadeInUp" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
                    <div class="expertise-box medicine-list exp-bg{{ ($index % 4) + 1 }}">
                        <div class="exp-pic">
                            <a href="{{ route('lekarstvennye-preparaty.detail', ['slug' => $content->slug]) }}">
                                @if($content->image && file_exists(public_path('upload/medicine/' . $content->image)))
                                <img src="{{ asset('upload/medicine/' . $content->image) }}" width="100%" alt="{{ $content->title }}">
                                @else
                                <img src="{{ asset('fronted/assets/images/default-medicine.jpg') }}" width="100%" alt="{{ $content->title }}">
                                @endif
                            </a>
                        </div>
                        <div class="exp-desc">
                            <h3 class="sub-ttl">{{ $content->title }}</h3>
                            <h5 class="exp-info 
                                @if($index % 4 == 0) pruple
                                @elseif($index % 4 == 1) sky-blue
                                @elseif($index % 4 == 2) pruple2
                                @else blue
                                @endif MulishBold">
                                {!! Str::limit(strip_tags($content->short_content), 150) !!}
                            </h5>
                            <div class="mt-3">
                                <a href="{{ route('lekarstvennye-preparaty.detail', ['slug' => $content->slug]) }}"
                                    class="readmore exp-read{{ ($index % 4) + 1 }}">
                                    Читать далее
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection
@push('scripts')

@endpush