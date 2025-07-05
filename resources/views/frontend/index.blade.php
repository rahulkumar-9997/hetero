@extends('frontend.layouts.master')
@section('title','Leading Global Pharmaceutical Company in India | Anti Retroviral Drugs')
@section('description', 'Hetero is the first company in India to launch the generic version of Remdesivir injection, COVIFOR, in India, which is used to treat hospitalization cases of COVID-19. Click here to know more.')
@section('main-content')
<section id="banner">
   <div class="swiper-container bannerSlider">
      <div class="swiper-wrapper">
         <div class="swiper-slide">
            <img src="{{asset('fronted/assets/images/desktop%20version.png')}}" class="dexImg" width="100%" alt="">
            <img src="{{asset('fronted/assets/images/480x304%20%281%29.png')}}" class="mobileBanner" width="100%" alt="">
            <div class="common-container">
               <div class="bannerTextBox">
                  <h3><span style="font-size:60px;"><b>30</b></span><br> <i>feels</i> <b>GREAT!</b></h3>
                  <p>Celebrating three decades of<br> inclusive pharmaceutical excellence.</p>
                  <p style="padding-top:15px;">Thank you for all the encouragement and <br> unwavering
                     support.
                  </p>
                  <p style="padding-top:25px;">#Hetero30</p>
               </div>
            </div>
         </div>
         <div class="swiper-slide">
            <img src="{{asset('fronted/assets/images/home-banner1.jpg')}}" class="dexImg" width="100%" alt="Doctor in Pharma Lab">
            <img src="{{asset('fronted/assets/images/mobile-banner1.jpg')}}" class="mobileBanner" width="100%" alt="Doctor in Pharma Lab">
            <div class="common-container">
               <div class="bannerTextBox">
                  <h3 class="white">Combining R&D expertise with state-of-the-art infrastructure.</h3>
                  <a href="expertise-overview.html" class="readmore">Read More</a>
               </div>
            </div>
         </div>
         <div class="swiper-slide">
            <img src="{{asset('fronted/assets/images/home-banner2.jpg')}}" class="dexImg" width="100%" alt="Doctor in Pharma Lab">
            <img src="{{asset('fronted/assets/images/mobile-banner3.jpg')}}" class="mobileBanner" width="100%" alt="medicine in Hand">
            <div class="common-container">
               <div class="bannerTextBox">
                  <h3>United against COVID-19</h3>
                  <p>By asserting our role as a responsible corporate citizen, the entire team of Hetero is
                     playing their part in helping the world to cope with the pandemic
                  </p>
                  <a href="covid-19.html" class="readmore">Read More</a>
               </div>
            </div>
         </div>
         <div class="swiper-slide">
            <img src="{{asset('fronted/assets/images/banner3.jpg')}}" class="dexImg" width="100%" alt="medicine in Hand">
            <img src="{{asset('fronted/assets/images/mobile-banner3.jpg')}}" class="mobileBanner" width="100%" alt="medicine in Hand">
            <div class="common-container">
               <div class="bannerTextBox">
                  <h3>Wide range of innovations; diverse and differentiated product portfolio</h3>
                  <!-- <p>Hetero has Asia’s largest API manufacturing complex in Visakhapatnam, Andhra Pradesh</p> -->
                  <a href="focus-areas-overview.html" class="readmore">Read More</a>
               </div>
            </div>
         </div>
      </div>
      <div class="swiper-pagination bannerSlider-pagination"></div>
   </div>
</section>
<section id="shaping-a-healthier" class="common-t-pad common-b-pad">
   <div class="common-container">
      <div class="row">
         <div class="col-md-6">
            <div class="shaping-left wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.1s">
               <h2 class="home-title HeteroRed mb-4" style="font-weight:600">At Hetero, our every action seeks
                  to inspire human belief in accessibility and affordability of life-saving medicines across
                  the world.
               </h2>
               <p class="MontserratMedium">
                  With unparalleled strengths in pharmaceutical research,
                  manufacturing, and marketing, we are
                  positioned to serve people regardless of geographies. Our new identity embodies this drive
                  to expand
                  our reach and capabilities in order to respond with agility to the world’s evolving health
                  needs. Our
                  every action seeks to inspire human belief in accessibility and affordability of life-saving
                  medicines
                  across the world.
               </p>
            </div>
         </div>
         <div class="col-md-6">
            <div class="shaping-right">
               <div class="swiper-container swiper-Shaping wow fadeInUp" data-wow-offset="250"
                  data-wow-duration="1s" data-wow-delay="0.2s">
                  <div class="swiper-wrapper">
                     <div class="swiper-slide">
                        <div class="shaping-right-box">
                           <div class="shaping-top">
                              <h2>Partnering with MPP to expand access of nirmatrelvir & ritonavir
                                 generics for COVID-19 treatment
                              </h2>
                              <p>To ensure significant increase in access to COVID-19 treatments for all
                                 people, particularly those living in
                                 the poorest parts of the world.
                              </p>
                              <a href="press-release-2022-2.html" class="readmore">Read More</a>
                           </div>
                           <div class="shaping-img">
                              <img src="{{asset('fronted/assets/images/shaping1.jpg')}}" width="100%">
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="shaping-right-box">
                           <div class="shaping-top">
                              <h2>Positive results in Phase III trials of Hetero’s Movfor (Molnupiravir)
                              </h2>
                              <p>Demonstrated that Molnupiravir along with Standard of Care (SOC) reduced
                                 the risk of hospitalization
                                 by over 65% compared to SOC alone.
                              </p>
                              <a href="pdf/Hetero_Molnupiravir%20trials_Press%20Release_Final.pdf"
                                 class="readmore" target="_blank">Read More</a>
                           </div>
                           <div class="shaping-img">
                              <img src="{{asset('fronted/assets/images/shaping2.jpg')}}" width="100%">
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Add Arrows -->
                  <div class="swiper-button-next Shaping-button-next">
                     <img src="{{asset('fronted/assets/images/white-slide-next.png')}}" width="100%">
                  </div>
                  <div class="swiper-button-prev Shaping-button-prev">
                     <img src="{{asset('fronted/assets/images/white-slide-prev.png')}}" width="100%">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="info-section common-t-pad">
         <div class="row">
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.1s">
                  <h2 class="HeteroRed"><span class="counter">30</span></h2>
                  <p>Years of Service</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.1s">
                  <h2 class="HeteroRed"><span class="counter">300</span>+</h2>
                  <p>APIs</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.1s">
                  <h2 class="HeteroRed"><span class="counter">200</span>+</h2>
                  <p>FDFs</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.3s">
                  <h2 class="HeteroRed"><span class="counter">140</span>+</h2>
                  <p>Countries</p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.4s">
                  <h2 class="HeteroRed"><span class="counter">36</span>+</h2>
                  <p>State-of-the-art
                     manufacturing facilities
                  </p>
               </div>
            </div>
            <div class="col-md-2 col-xs-6">
               <div class="info-box wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
                  data-wow-delay="0.5s">
                  <h2 class="HeteroRed"><span class="counter">30</span>,000+</h2>
                  <p>Employees globally</p>
               </div>
            </div>
         </div>
      </div>
      <a href="who-we-are.html" class="readmore mt-4">Read More</a>
   </div>
</section>
<section id="vast-product" class="common-t-pad common-b-pad">
   <div class="common-container">
      <div class="row">
         <div class="col-md-4 wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
            <div class="vast-product-left">
               <h2 class="home-title2 pruple">Focus areas</h2>
               <p class="MontserratMedium">Vast product portfolio<br> backed by robust R&D</p>
               <a href="focus-areas-overview.html" class="readmore mt-3">Read More</a>
            </div>
         </div>
         <div class="col-md-8">
            <div class="vast-product-right wow fadeInUp" data-wow-offset="200" data-wow-duration="3s"
               data-wow-delay="0.1s">
               <div class="swiper-container swiper-vast">
                  <div class="swiper-wrapper">
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="APIs.html">
                                 <img src="{{asset('fronted/assets/images/product7.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>APIs</h2>
                           <p>The path to serving patients better</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="global-generics.html">
                                 <img src="{{asset('fronted/assets/images/product1.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Global Generics</h2>
                           <p>World-class and differentiated portfolio in chronic therapy areas</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="biosimilars.html">
                                 <img src="{{asset('fronted/assets/images/product2.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Biosimilars</h2>
                           <p>Achieving a sustainable health equity</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="CPS.html">
                                 <img src="{{asset('fronted/assets/images/product3.jpg')}}"
                                    width="100%">
                              </a>
                           </div>
                           <h2>Custom Pharmaceutical Services(CPS)</h2>
                           <p>Fully integrated services across the value chain</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="global-access.html">
                                 <img src="{{asset('fronted/assets/images/product4.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Global Access</h2>
                           <p>Committed to transforming Standards of care</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="key-therapies.html">
                                 <img src="{{asset('fronted/assets/images/product5.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Key Therapies</h2>
                           <p>Researching areas of unmet medical need</p>
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
<section id="home-people" class="common-t-pad common-b-pad">
   <div class="common-container">
      <div class="row">
         <div class="col-md-8 wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.1s">
            <div class="home-people-pic">
               <img src="{{asset('fronted/assets/images/home-people1.jpg')}}" width="100%">
            </div>
         </div>
         <div class="col-md-4 wow fadeInUp" data-wow-offset="200" data-wow-duration="1s" data-wow-delay="0.3s">
            <div class="home-people-right">
               <h2 class="home-title2 HeteroRed mb-3">People</h2>
               <p class="MontserratMedium">Hetero is an equal opportunity employer. Our people reinforce our
                  mission.
               </p>
               <div class="home-people-pic-mobile">
                  <img src="{{asset('fronted/assets/images/home-people1.jpg')}}" width="100%">
               </div>
               <p class="MontserratMedium HeteroRed">Strive to make a difference, be a part of an enterprising
                  team.
               </p>
               <a href="life-at-hetero.html" target="_blank" class="readmore mt-3">Read More</a>
            </div>
         </div>
      </div>
   </div>
</section>
<section id="home-responsibility" class="common-t-pad common-b-pad">
   <div class="common-container">
      <div class="row">
         <div class="col-md-4">
            <div class="home-responsibility-left wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.1s">
               <h2 class="home-title2 pruple mb-3">Responsibility</h2>
               <p class="MontserratMedium">As a responsible corporate citizen, we conduct our business with
                  complete respect for the environment and community
               </p>
               <a href="community.html" class="readmore mt-3">Read More</a>
            </div>
         </div>
         <div class="col-md-8">
            <div class="home-responsibility-right wow fadeInUp" data-wow-offset="200" data-wow-duration="1s"
               data-wow-delay="0.3s">
               <div class="swiper-container swiper-Responsibility">
                  <div class="swiper-wrapper">
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:;">
                                 <img src="{{asset('fronted/assets/images/responsibility-1.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Education</h2>
                           <p>Power to nurture talent</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:;">
                                 <img src="{{asset('fronted/assets/images/responsibility-2.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Healthcare</h2>
                           <p>Spreading smiles with good health</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:;">
                                 <img src="{{asset('fronted/assets/images/responsibility-3.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Infrastructure</h2>
                           <p>Connecting communities with development</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:;">
                                 <img src="{{asset('fronted/assets/images/responsibility-4.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Drinking Water</h2>
                           <p>Ensuring access to safe drinking water</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:;">
                                 <img src="{{asset('fronted/assets/images/responsibility-5.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Eyecare</h2>
                           <p>Spreading the light to sight</p>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="vast-product-box">
                           <div class="product-box-pic">
                              <a href="javascript:;">
                                 <img src="{{asset('fronted/assets/images/responsibility-6.jpg')}}" width="100%">
                              </a>
                           </div>
                           <h2>Green Initiative</h2>
                           <p>Greening our world</p>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- If we need pagination -->
               <div class="swiper-pagination Responsibility-pagination"></div>
               <!-- If we need navigation buttons -->
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
<section id="partnership">
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
@endsection
@push('scripts')
<script>
   var swiper = new Swiper(".bannerSlider", {
      spaceBetween: 30,
      effect: "fade",
      loop: "true",
      speed: 1e3,
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
   }), swiper = new Swiper(".swiper-vast", {
      slidesPerView: 3,
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