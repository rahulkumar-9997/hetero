@extends('frontend.layouts.master')
@section('title','Лекарственные препараты')
@section('description', 'Лекарственные препараты')
@section('main-content')
<section id="breadcrum" class="no-banner">
    <div class="common-container">
        <ol class="breadcrumb" style="margin-top:0px;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Главная</a>
            </li>
            <li class="breadcrumb-item active">Лекарственные препараты</li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3>Лекарственные препараты</h3>
    </div>
</section>
@if(isset($medicineCategories) && $medicineCategories->count() > 0)
    <section id="expertise-overview medicine-categories-section" class="common-b-pad common-t-pad">
        <div class="common-container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills medicine-cate-pills">
                        @foreach ($medicineCategories as $index =>$medicineCategory)
                            <li class="nav-item">
                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" href="javascript:void(0);" data-id="{{ $medicineCategory->id }}">
                                    {{ $medicineCategory->title }}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif
<section class="expertise-overview-section common-b-pad">
    <div class="common-container medicine-list-catewise">
        @if(isset($medicineContents) && $medicineContents->count() > 0)
            @include('frontend.pages.medicine.partials.ajax-medicine-list', [
                'medicineContents' => $medicineContents
            ])
        @endif
    </div>
</section>

@endsection
@push('scripts')
<script>
    var medicineCategoryUrl = "{{ url('medicine-cate-ajax') }}";
</script>
<script type="text/javascript" src="{{asset('fronted/assets/js/pages/medicine-cate.js')}}"></script>
<script>
    wow = new WOW({
        mobile: false,
    });
    wow.init();
</script>
@endpush