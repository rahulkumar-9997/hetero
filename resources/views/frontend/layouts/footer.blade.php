<section id="footer">
    <div class="common-container">
        <div class="mobile-footer-show">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="footer-logo">
                        <img src="{{asset('fronted/assets/images/Logo.png')}}" width="100px">
                    </div>
                </div>
                @if($footerMenu && $footerMenu->items->count())
                    @foreach($footerMenu->items as $item)
                        <div class="col-lg-2 col-md-2 col-6">
                            <div class="footer-links">
                                <h2>{{ $item->title }}</h2>
                                @if($item->children->count())
                                    <ul>
                                        @foreach($item->children as $child)
                                        <li>
                                            <a href="{{ $child->url }}">
                                               {{ $child->title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div class="row">
                <div class="col-lg-2 col-md-2 col-6 blank-cell"></div>
                <div class="col-md-10">
                    <div class="Caution">
                        <p class="MontserratBold fs14 mb-2">Caution Notice</p>
                        <p class="fs12">Обратите внимание, что Hetero не занимается какой-либо формой онлайн-распространения или розничной торговли лекарствами. Hetero и ее дочерние компании поставляют продукцию по всему миру только через свои эксклюзивные дистрибьюторские сети.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-end">
        <div class="common-container">
            <div class="row">
                <!-- <div class="col-lg-2 col-md-2 col-6 blank-cell"></div> -->
                <div class="col-md-5">
                    <div class="copyright blue fs12 MulishBold">
                        Copyright © 2017-{{ date('Y') }} Hetero. All rights reserved
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="bottom-links">
                        <a href="#">Disclaimer</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#" target="_blank">Terms & Conditions</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <a href="https://www.facebook.com/heteroworld/"
                        target="_blank">
                        <img src="{{asset('fronted/assets/images/facebook.png')}}">
                    </a>
                    <a href="https://www.linkedin.com/company/hetero/" target="_blank">
                        <img src="{{asset('fronted/assets/images/linkin.png')}}">
                    </a>
                    <a href="https://www.youtube.com/channel/UCTvsR0a-IavUR-biF5Lx3kg" target="_blank">
                        <img src="{{asset('fronted/assets/images/youtube.png')}}">
                    </a>
                    <a href="https://twitter.com/heteroofficial" target="_blank">
                        <img src="{{asset('fronted/assets/images/twitter.png')}}">
                    </a>
                    <a href="https://www.instagram.com/hetero_pharma/" target="_blank">
                        <img src="{{asset('fronted/assets/images/instagram.png')}}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>