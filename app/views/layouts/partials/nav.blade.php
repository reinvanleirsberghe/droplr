<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home') }}">Brand</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if ($currentUser)
				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{{ $currentUser->firstname }} <span class="caret"></span>
					</a>

					<ul class="dropdown-menu" role="menu">
						<li>{{ link_to_route('user_drops_path', trans('account.my_drops')) }}</li>
						<li>{{ link_to_route('user_account_path', trans('account.my_account')) }}</li>
						<li class="divider"></li>
						<li>{{ link_to_route('logout_path', trans('main.logout')) }}</li>
					</ul>
				</li>
				@else
				<li>{{ link_to_route('login_path', trans('main.login')) }}</li>
				<li>{{ link_to_route('registration_path', trans('main.signup')) }}</li>
				@endif
			</ul>
		</div>
	</div>
</nav>