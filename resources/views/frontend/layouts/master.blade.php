<!doctype html>
<html lang="en-US">
	<head>
		@include('frontend.layouts.headcss')
		@stack('styles')
	</head>
    <body>
		<main id="page" class="page_wapper hfeed site">
			@include('frontend.layouts.header-menu')
			@yield('main-content')
			@include('frontend.layouts.footer')
		</main>
		@include('frontend.layouts.modal')
		@include('frontend.layouts.footerjs')
		@stack('scripts')
	</body>
</html>