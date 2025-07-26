@extends('frontend.layouts.master')
@section('title','Новости')
@section('description', 'Новости')
@section('main-content')
<section id="breadcrum" class="no-banner">
    <div class="common-container">
        <ol class="breadcrumb" style="margin-top:0px;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Главная</a>
            </li>
            <li class="breadcrumb-item active">Новости</li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3>Новости</h3>
    </div>
</section>
<section id="newsroom" class="common-b-pad common-t-pad">
    <div class="common-container">
        @if(isset($years) && $years->count() > 0)
            @foreach($years as $year)
                <div class="row wow fadeInUp">
                    <div class="col-md-12">
                        <div class="pr-card">
                            <h2 class="card-ttle">{{ $year->title }}</h2>
                            <div class="card-desc-bx">
                                <ul>
                                    @foreach($year->newsRooms as $news)
                                        <li class="view-report">
                                            <div class="locationDate">
                                                @if($news->location)
                                                    {{ $news->location }}; 
                                                @endif
                                                {{ \Carbon\Carbon::parse($news->post_date)->format('j F, Y') }}
                                            </div>
                                            <a href="{{ route('novosti.detail', $news->slug) }}">
                                                {{ $news->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
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