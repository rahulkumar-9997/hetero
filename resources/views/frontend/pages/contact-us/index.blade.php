@extends('frontend.layouts.master')
@section('title','Контакты')
@section('description', '109029, Россия, г. Москва, Автомобильный проезд, д. 6/5 Телефон: +7 495 981 00 88 E-mail: InfoRussia@hetero.com')
@section('main-content')
<section id="breadcrum" class="no-banner">
    <div class="common-container">
        <ol class="breadcrumb" style="margin-top:0px;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Главная</a>
            </li>
            <li class="breadcrumb-item active">Контакты</li>
        </ol>
    </div>
</section>
<section id="inner-patch-banner" class="Bg-sky-blue common-b-pad common-t-pad">
    <div class="common-container">
        <h3>Контакты</h3>
    </div>
</section>
<section id="main-content" class="common-t-pad common-b-pad">
    <div class="common-container">
        <div class="page-contact-us">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-info-box">
                        <div class="contact-info-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('fronted/assets/hetero-img/icon-phone-primary.svg') }}" alt="phone" loading="lazy">
                            </div>
                            <div class="contact-info-content">
                                <h3>Телефон</h3>
                                <p><a href="tel:++74959810088">+7 495 981 00 88</a></p>
                            </div>
                        </div>
                        <div class="contact-info-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('fronted/assets/hetero-img/icon-mail.svg') }}" alt="mail" loading="lazy">
                            </div>
                            <div class="contact-info-content">
                                <h3>E-mail</h3>
                                <p><a href="mailto:InfoRussia@hetero.com">InfoRussia@hetero.com</a></p>
                            </div>
                        </div>
                        <div class="contact-info-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{ asset('fronted/assets/hetero-img/icon-location.svg') }}" alt="loation" loading="lazy">
                            </div>
                            <div class="contact-info-content">
                                <h3>Главный офис</h3>
                                <p>109029, Россия, г. Москва, Автомобильный проезд, д. 6/5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-4">
                <h2 class="home-title2 pruple pb-3">Обратная связь</h2>
                <div class="form_block side_form ask_form ajaxform" id="right_feedback">
                    <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">ФИО:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">E-Mail:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="message">Текст сообщения:</label>
                                <textarea class="form-control" id="message" name="message">{{ old('message') }}</textarea>
                                @error('message') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-6">
                                <input type="text" class="form-control" name="captcha" placeholder="Введите код с картинки" id="captcha">
                                @error('captcha') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6 mb-6 contact-captcha">
                                <div class="d-flex align-items-center">
                                    <span class="captcha-img">{!! captcha_img('flat') !!}</span>
                                    <button type="button" class="btn btn-link ml-4 p-0" id="refresh-captcha">Обновить</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" style="background:#FF0000;">Отправить заявку</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="location-map">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d4493.245775095045!2d37.6959058!3d55.7303056!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNTXCsDQzJzQ5LjEiTiAzN8KwNDInMDMuOCJF!5e0!3m2!1sen!2sin!4v1758525277077!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
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
<script>
document.getElementById('refresh-captcha').addEventListener('click', function() {
    fetch('{{ route("captcha.refresh") }}')
        .then(res => res.json())
        .then(data => {
            document.querySelector('.captcha-img').innerHTML = data.captcha;
            document.getElementById('feedback_captcha').value = '';
        });
});
</script>
@endpush