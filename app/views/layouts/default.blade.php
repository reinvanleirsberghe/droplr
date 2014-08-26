@include('layouts.partials.header')
@include('layouts.partials.nav')

<div class="container">
	@include('flash::message')

	@yield('content')
</div>

@include('layouts.partials.footer')