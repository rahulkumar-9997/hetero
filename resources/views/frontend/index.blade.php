@extends('frontend.layouts.master')
@section('title','Leading Global Pharmaceutical Company in India | Anti Retroviral Drugs')
@section('description', 'Hetero is the first company in India to launch the generic version of Remdesivir injection, COVIFOR, in India, which is used to treat hospitalization cases of COVID-19. Click here to know more.')
@section('main-content')
@if(isset($data['banners']) && $data['banners']->count() > 0)
<section id="banner">
   <div class="swiper-container bannerSlider">
      <div class="swiper-wrapper">
         @foreach($data['banners'] as $banner)
         <div class="swiper-slide">
            <img src="{{ asset('upload/banner/' . $banner->banner_desktop_img) }}" class="dexImg" width="100%" alt="{{ $banner->banner_heading_name }}">
            <img src="{{ asset('upload/banner/' . $banner->banner_mobile_img) }}" class="mobileBanner" width="100%" alt="{{ $banner->banner_heading_name }}">
            <div class="common-container">
               <div class="bannerTextBox">
                  @if($banner->banner_heading_name)
                  <h3>
                     {{ $banner->banner_heading_name }}
                  </h3>
                  @endif
                  @if($banner->banner_content)
                  <p>
                     {!! $banner->banner_content !!}
                  </p>
                  @endif
                  @if($banner->medicines->count() > 0)
                  <div class="banner-medicine-container" data-view="6-3">
                     @foreach($banner->medicines as $medicine)
                     <div class="banner-item">
                        <a href="{{ $medicine->link ? $medicine->link : '#' }}">
                           <h4>{{ $medicine->title }}</h4>
                        </a>
                     </div>
                     @endforeach
                  </div>
                  @endif
                  @if($banner->banner_link)
                  <a href="{{ $banner->banner_link }}" class="readmore">Читать далее</a>
                  @endif
               </div>
            </div>
         </div>
         @endforeach
      </div>
      <div class="swiper-pagination bannerSlider-pagination"></div>
   </div>
</section>
@endif
<section id="vast-product" class="common-t-pad common-b-pad">
   <div class="common-container">
      <div class="row">
         <div class="col-md-12 wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
            <div class="vast-product-left text-center">
               <h2 class="home-title2 pruple">Области фокуса</h2>
               <p class="MontserratMedium">Разнообразные решения в сфере здравоохранения, основанные на инновациях и опыте.</p>
            </div>
         </div>
         <div class="col-md-12">
            <div class="vast-product-right wow fadeInUp" data-wow-offset="200" data-wow-duration="3s" data-wow-delay="0.1s">
               <div class="swiper-container swiper-vast">
                  <div class="swiper-wrapper">
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:void(0);">
                                 <img src="{{asset('fronted/assets/hetero-img/focus-area/APIs.jpg')}}" width="100%">
                              </a>
                           </div>
                           <a href="javascript:void(0);">
                              <h2>APIs</h2>
                              <p>Высококачественные активные фармацевтические ингредиенты, поддерживающие мировые потребности здравоохранения.</p>
                           </a>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:void(0);">
                                 <img src="{{asset('fronted/assets/hetero-img/focus-area/Global-Generics.jpg')}}" width="100%">
                              </a>
                           </div>
                           <a href="javascript:void(0);">
                              <h2>Глобальные дженерики</h2>
                              <p>Доступные и надёжные дженерические лекарства в различных терапевтических областях.</p>
                           </a>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:void(0);">
                                 <img src="{{asset('fronted/assets/hetero-img/focus-area/Biosimilars.jpg')}}" width="100%">
                              </a>
                           </div>
                           <a href="javascript:void(0);">
                              <h2>Биосимиляры</h2>
                              <p>Инновационные альтернативы для современных биологических терапий.</p>
                           </a>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:void(0);">
                                 <img src="{{asset('fronted/assets/hetero-img/focus-area/Custom-Pharmaceutical.jpg')}}" width="100%">
                              </a>
                           </div>
                           <a href="javascript:void(0);">
                              <h2>Индивидуальные фармацевтические решения</h2>
                              <p>Разработка и производство на заказ для партнёров по всему миру.</p>
                           </a>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:void(0);">
                                 <img src="{{asset('fronted/assets/hetero-img/focus-area/Global-Access.jpg')}}" width="100%">
                              </a>
                           </div>
                           <a href="javascript:void(0);">
                              <h2>Глобальный доступ</h2>
                              <p>Обеспечение доступных решений в сфере здравоохранения для пациентов по всему миру.</p>
                           </a>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:void(0);">
                                 <img src="{{asset('fronted/assets/hetero-img/focus-area/Key-Therapies.jpg')}}" width="100%">
                              </a>
                           </div>
                           <a href="javascript:void(0);">
                              <h2>Ключевые направления терапии</h2>
                              <p>Сфокусированная экспертиза в области ВИЧ, онкологии, сердечно-сосудистых и других важных заболеваний.</p>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- If we need pagination -->
               <div class="swiper-pagination vast-pagination"></div>
               <!-- Add Arrows -->
               <div class="swiper-button-next vast-button-next">
                  <img src="{{asset('fronted/assets/images/slide-next2.png')}}" width="100%">
               </div>
               <div class="swiper-button-prev vast-button-prev">
                  <img src="{{asset('fronted/assets/images/slide-prev2.png')}}" width="100%">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<section id="shaping-a-healthier" class="common-t-pad common-b-pad">
   <div class="common-container">
      <div class="row align-items-center">
         <div class="col-md-6">
            <div class="shaping-left wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.1s">
               <h2 class="home-title HeteroRed mb-4" style="font-weight:600">
                  HETERO Россия
               </h2>
               <p class="MontserratMedium text-justify">
                  На сегодняшний день группа компаний "HETERO" в России ставит перед собой цель - повышение доступности качественного и эффективного лечения для российских больных через выпуск современных лекарственных средств и создание производства полного цикла на базе российских производственных мощностей.
               </p>
               <p class="MontserratMedium text-justify">
                  Основная производственная площадка ГК "HETERO" - ООО "МАКИЗ-ФАРМА" с 2000 года обладает технологической платформой, отвечающей мировым стандартам в области производства лекарственных средств, и находится в Москве.
               </p>
            </div>
            <div class="about-us-body wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.1s">
               <div class="about-body-item">
                  <div class="about-counter">
                     <h2><span class="counter">20</span></h2>
                  </div>
                  <div class="about-counter-content">
                     <p>Годы в России</p>
                  </div>
               </div>
               <div class="about-body-item">
                  <div class="about-counter">
                     <h2><span class="counter">40</span></h2>
                  </div>
                  <div class="about-counter-content">
                     <p>Лекарства</p>
                  </div>
               </div>
            </div>
            <div class="about-us-footer wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.1s">
               <div class="about-us-footer-btn">
                  <a href="/page/o-nas" class="btn-default">Читать далее</a>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="right-pic">
               <img src="{{ asset('fronted/assets/hetero-img/about-us.jpg') }}" width="100%">
            </div>
         </div>
      </div>
   </div>
</section>
<section id="home-counter" class="counter-section common-t-pad common-b-pad">
   <div class="common-container">
      <div class="info-section home-counter-area">
         <div class="row">
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.1s">
                  <h2 class="HeteroWhite"><span class="counter">20</span></h2>
                  <p>Лет в России</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.1s">
                  <h2 class="HeteroWhite"><span class="counter">40</span></h2>
                  <p>Лекарственных препаратов</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.1s">
                  <h2 class="HeteroWhite"><span class="counter">30</span></h2>
                  <p>Антиретровирусных препаратов</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.3s">
                  <h2 class="HeteroWhite"><span class="counter">25</span></h2>
                  <p>Производственных площадок</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.4s">
                  <h2 class="HeteroWhite"><span class="counter">50</span></h2>
                  <p>
                     Партнеров
                  </p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.5s">
                  <h2 class="HeteroWhite"><span class="counter">100</span></h2>
                  <p>Сотрудников</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@if(isset($data['medicineCategories']) && $data['medicineCategories']->count() > 0)
<section id="home-responsibility" class="common-t-pad common-b-pad featured-section-home">
   <div class="common-container">
      <div class="row">
         <div class="col-md-4">
            <div class="home-responsibility-left responsebility_left wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
               <h2 class="home-title2 pruple mb-3">РЛекарства</h2>
               <p class="MontserratMedium">Поставка надежных и высококачественных лекарств по основным терапевтическим направлениям — от ВИЧ/СПИДа и онкологии до сердечно-сосудистого здоровья и общих заболеваний.</p>
            </div>
         </div>
         <div class="col-md-8">
            <div class="home-responsibility-right wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.3s">
               <div class="swiper-container swiper-Responsibility">
                  <div class="swiper-wrapper">
                     @foreach ($data['medicineCategories'] as $medicineCategory)
                        <div class="swiper-slide">
                           <div class="vast-product-box">
                              <div class="product-box-pic">
                                 <a href="{{ route('medicine', ['slug' => $medicineCategory->slug]) }}">
                                    @if($medicineCategory->image)
                                          <img src="{{ asset('upload/medicine-category/' . $medicineCategory->image) }}" width="100%">
                                    @else
                                          <img src="{{ asset('fronted/assets/hetero-img/featured-medicine/Antiretroviral-Drugs.jpg') }}" width="100%">
                                    @endif
                                 </a>
                              </div>
                              <a href="{{ route('medicine', ['slug' => $medicineCategory->slug]) }}">
                                 <h2>{{ $medicineCategory->title }}</h2>
                                 <p>{!! Str::limit(strip_tags($medicineCategory->content), 150) !!}</p>
                              </a>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
               <div class="swiper-pagination Responsibility-pagination"></div>
               <div class="swiper-button-prev Responsibility-button-prev">
                  <img src="{{asset('fronted/assets/images/slide-prev2.png')}}" width="100%">
               </div>
               <div class="swiper-button-next Responsibility-button-next">
                  <img src="{{asset('fronted/assets/images/slide-next2.png')}}" width="100%">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endif
<section id="why-hetero">
   <div class="common-container">
      <div class="page-services page-services-section">
         <div class="row cus-row justify-content-center">
            <div class="col-md-8 wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
               <div class="vast-product-left text-center">
                  <h2 class="home-title2 pruple">Почему HETERO</h2>
                  <p class="MontserratMedium">Надежное имя в мировой здравоохранении, HETERO сочетает инновации, охват и надежность, чтобы доставлять доступные лекарства и современные методы терапии миллионам людей по всему миру.</p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-3">
               <div class="service-item  wow fadeInUp">
                  <div class="icon-box">
                     <img class="why-img" src="{{asset('fronted/assets/hetero-img/why-hetero/global-presence.svg')}}" alt="">
                  </div>
                  <div class="service-item-content">
                     <h3>Глобальное присутствие</h3>
                     <p>деятельность более чем в 126+ странах.</p>
                  </div>
                  <!-- <div class="service-btn">
                     <a href="#" class="readmore-btn">Узнать больше</a>
                  </div> -->
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="service-item wow fadeInUp">
                  <div class="icon-box">
                     <img class="why-img" src="{{asset('fronted/assets/hetero-img/why-hetero/strong-R&D.svg')}}" alt="">
                  </div>
                  <div class="service-item-content">
                     <h3>SСильные НИОКР </h3>
                     <p>постоянные инновации в фармацевтике и биосимилярах.</p>
                  </div>
                  
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="service-item wow fadeInUp">
                  <div class="icon-box">
                     <img class="why-img" src="{{asset('fronted/assets/hetero-img/why-hetero/affordable-medicines.svg')}}" alt="">
                  </div>
                  <div class="service-item-content">
                     <h3>Доступные лекарства</h3>
                     <p> приверженность обеспечению здравоохранения во всем мире.</p>
                  </div>
                  
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="service-item wow fadeInUp">
                  <div class="icon-box">
                     <img class="why-img" src="{{asset('fronted/assets/hetero-img/why-hetero/trusted-partner.svg')}}" alt="">
                  </div>
                  <div class="service-item-content">
                     <h3>Надежный партнер</h3>
                     <p>сотрудничество с ведущими поставщиками здравоохранения</p>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@if(isset($data['newsroom']) && $data['newsroom']->count() > 0)
<section id="home-responsibility" class="common-t-pad common-b-pad home-newsroom-section">
   <div class="common-container">
      <div class="row">
         <div class="col-md-4">
            <div class="home-responsibility-left wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.1s">
               <h2 class="home-title2 pruple mb-3">Новости</h2>
               <p class="MontserratMedium">
                  Последние новости<br>
                  и события в ГК "HETERO"
               </p>
               <a href="{{ route('novosti')}}" class="readmore mt-3">Все новости</a>
            </div>
         </div>
         <div class="col-md-8">
            <div class="row">

               @foreach($data['newsroom'] as $newsRoom)
               <div class="col-md-4 vast-product-box">
                  <div class="new-up-item">
                     <div class="new-img">
                        <div class="position-relative image-file">
                           <a href="{{ route('novosti.detail', $newsRoom->slug) }}">
                              @if($newsRoom->image)
                                 <img class="border-radius" 
                                       src="{{ asset('upload/news-room/' . $newsRoom->image) }}" 
                                       width="100%" 
                                       alt="{{ $newsRoom->title }}">
                              @else
                                 <img class="border-radius" 
                                       src="{{ asset('fronted/assets/hetero-img/product1.jpg') }}" 
                                       width="100%" 
                                       alt="{{ $newsRoom->title }}">
                              @endif

                           </a>
                        </div>
                     </div>
                     <div class="box-date">{{ \Carbon\Carbon::parse($newsRoom->post_date)->format('d-m-Y') }}</div>
                     <div class="box-title">
                        <a href="{{ route('novosti.detail', $newsRoom->slug) }}">
                           {{ $newsRoom->title }}
                        </a>
                     </div>
                  </div>
               </div>

               @endforeach
            </div>
         </div>
      </div>
   </div>
</section>
@endif
<!--<section id="partnership">
   <div class="common-container">
      <div class="partner-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.3s">
         <h2 class="home-title2 white mb-3">Partnerships</h2>
         <p class="white">As a global leader in the industry, we partner with multinational pharmaceutical
            companies, global
            agencies and procurement bodies to ensure access to critical life-saving drugs.
         </p>
         <a href="partnerships.html" class="readmore">Read More</a>
      </div>
   </div>
</section>
-->
@endsection
@push('scripts')
<script>
   var swiper = new Swiper(".bannerSlider", {
      spaceBetween: 30,
      effect: "fade",
      loop: "true",
      speed: 1e3,
      // autoplay: false,
      autoplay: {
         delay: 5e3,
         disableOnInteraction: !1
      },
      pagination: {
         el: ".bannerSlider-pagination",
         clickable: !0
      }
   });
   swiper = new Swiper(".swiper-Shaping", {
         slidesPerView: 1,
         spaceBetween: 30,
         navigation: {
            nextEl: ".Shaping-button-next",
            prevEl: ".Shaping-button-prev"
         }
      }),
      swiper = new Swiper(".swiper-vast", {
         slidesPerView: 4,
         spaceBetween: 30,
         navigation: {
            nextEl: ".vast-button-next",
            prevEl: ".vast-button-prev"
         },
         pagination: {
            el: ".vast-pagination",
            clickable: !0
         },
         autoplay: {
            delay: 4e3,
            disableOnInteraction: !1
         },
         breakpoints: {
            640: {
               slidesPerView: 1,
               spaceBetween: 0
            },
            768: {
               slidesPerView: 1,
               spaceBetween: 0
            }
         }
      }), swiper = new Swiper(".swiper-Responsibility", {
         slidesPerView: 3,
         spaceBetween: 30,
         pagination: {
            el: ".Responsibility-pagination",
            clickable: !0
         },
         navigation: {
            nextEl: ".Responsibility-button-next",
            prevEl: ".Responsibility-button-prev"
         },
         autoplay: {
            delay: 4e3,
            disableOnInteraction: !1
         },
         breakpoints: {
            640: {
               slidesPerView: 1,
               spaceBetween: 0
            },
            768: {
               slidesPerView: 1,
               spaceBetween: 0
            }
         }
      });
   jQuery(document).ready(function(e) {
      e(".counter").counterUp({
         delay: 10,
         time: 2e3
      })
   }), wow = new WOW({
      mobile: !1
   }), wow.init();
   if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('.dexImg').remove()
   } else {
      $('.dexImg').show()
   }
</script>
@endpush